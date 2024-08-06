<?php

use App\Models\App;
use App\Models\Gopay;
use App\Models\Paiement;
use App\Models\Taux;
use Illuminate\Support\Facades\DB;
use Google\Client;

$xApiKey = "d2V1aUlBT2JkdGZDV282Ty9wK3pzdz09";

define('API_BASE', 'https://gopay.gooomart.com/api/v2');
define('API_HEADEARS',  [
    "Accept: application/json",
    "Content-Type: application/json",
    "x-api-key: $xApiKey"
]);

function gopay_init_payment($amount, $devise, $telephone, $myref)
{
    $_api_headers = API_HEADEARS;
    $telephone = (float) $telephone;
    $data = array(
        "telephone" => "+$telephone",
        "amount" => $amount,
        "devise" => $devise,
        "myref" => $myref,
    );

    $data = json_encode($data);
    $gateway = API_BASE . "/payment/init";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $gateway);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $_api_headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 300);
    $response = curl_exec($ch);
    $rep['success'] = false;
    if (curl_errno($ch)) {
        $rep['message'] = "Erreur, veuillez reessayer.";
    } else {
        $jsonRes = json_decode($response);
        $rep['success'] = @$jsonRes->success;
        $rep['message'] = @$jsonRes->message;
        $rep['data'] = @$jsonRes->data;
    }
    curl_close($ch);
    return (object) $rep;
}

function completeTrans()
{
    $pendingPayments = Gopay::where(['issaved' => '0', 'isfailed' => '0'])->get();
    foreach ($pendingPayments as $trans) {
        $paydata = json_decode($trans->paydata);
        $myref = $trans->myref;
        $t = transaction_status($myref);
        $status = @$t->status;
        if ($status === 'success') {
            saveData($paydata, $trans);
        } else if ($status === 'failed') {
            $trans->update(['isfailed' => 1]);
        }
    }
}

function transaction_status($myref)
{
    $_api_headers = API_HEADEARS;

    $gateway = API_BASE . "/payment/check/" . $myref;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $gateway);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $_api_headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 300);
    $response = curl_exec($ch);

    $status = null;
    if (!curl_errno($ch)) {
        curl_close($ch);
        $status = @json_decode($response)->transaction;
    }
    return $status;
}


function saveData($paydata, $trans)
{
    try {
        DB::transaction(function () use ($paydata, $trans) {
            $d = (array) $paydata;
            $d['ref'] = $trans->ref;
            $d['date'] =  now('Africa/Lubumbashi');
            Paiement::create($d);
            $montant = $paydata->montant;
            $devise = $paydata->devise;
            $taux = Taux::first();

            if ($devise == 'USD') {
                $val = $montant;
            } else {
                $val = $montant * $taux->cdf_usd;
            }

            $app = App::where('id', $paydata->app_id)->first();
            $solde = $app->soldes()->first();
            if (!$solde) {
                $solde = $app->soldes()->create(['solde_usd' => 0]);
            }
            $solde->increment('solde_usd', $val);
            $trans->update(['issaved' => 1]);
        });
    } catch (\Throwable $th) {
        // throw $th;
    }
}


function makeRand($prefix = '', $max = 5)
{
    $max = (int) $max;
    if (!$max or $max <= 0) {
        return 0;
    }

    $num = '';
    while ($max > 0) {
        $max--;
        $num .= rand(1, 9);
    }
    return "$prefix$num-" . time();
}

function uid()
{
    return request()->header('uid');
}

function userapp()
{
    $uid = request()->header('uid');
    return App::where('uid', $uid)->first();
}


function canmessage()
{
    $app = userapp();
    $chat = $app->chats()->first();
    if ($chat) {
        $n = $chat->messages()->where('fromuser', 0)->whereNull('file')->count();
        $sold = $app->soldes()->first()->solde_usd;
        if ($n > 5 && $sold <= 0) {
            abort(403, 'Balance error for SMS');
        }
        $n = $chat->messages()->where('fromuser', 0)->whereNotNull('file')->count();
        $sold = $app->soldes()->first()->solde_usd;
        if ($n > 1 && $sold <= 0) {
            abort(403, 'Balance error for FILE');
        }
    }
}

function fcmtoken()
{
    $credentialsFilePath =  [
        "type" => "service_account",
        "project_id" => "docta-2907c",
        "private_key_id" => "2042942bdbb5cf2e47a0f77bda9c2a1fe1e008ba",
        "private_key" => "-----BEGIN PRIVATE KEY-----\nMIIEvwIBADANBgkqhkiG9w0BAQEFAASCBKkwggSlAgEAAoIBAQCl4BRL1YV7qLas\nWT8onnL3xsXKmtvtA9J5okjchiLnsoC4Sf5992ew/SHW/RfE+1S3he4ZoaVyNtNb\nXIvpJlqqzI0MCGWUbDUmUOtQxjTQXyMwGxPFYmJHMq+6Tcte5iQG3ANNw40E9vV3\nSPetsqnkdRokEYmdhSoBku+JnYYDwVz9ej8k4ziUYPBPu3Vc7yeQlFC2YDxw3SyG\n2C7gn0+3JG80YNW/7DTfrD848baOECjMy9t6i585Of+TFqKazTjC1YxDBqr9GCRm\ndbXVXppJkkVdahQUdilSn3lww9n/HvAVg+AF5RUkAVipSN+tVoUo4vvcinIQtaJW\nI3c7WDntAgMBAAECggEAAiO5yfX0cCaPn07SDxFmz5Czdxbi71O1S0xZ6ZOcBPu7\nHVAXBZjuBXe+ZVTZEaQMRlxmjdNqnDveI2I2NnOq3Q52Y0lYcL7/OyygBxKyFl35\nHjhl243r++8eGnvBESBMJqp/1b5H+2Bpb3h0JBFsj5MocH6pamwP9qU74b0zv/32\ne8E3KO/Iiy13C8bnCutOT7skA6aW9WGaiTuv8vJRsR3mN7coFBa6/+fr0e22fRU6\nMbRfYW+p+sjTbAf/V2qzwfuJwHkhSal50BhYA5kSSpP2Roow2dNS8qcxsI6VBK7z\nVfeRyypjhZe585YxsWRUrmU7SW3gKuYG9Uk3zdboIQKBgQDqH9UaQ5UJ0Q+Fddw3\nL1r73/8hAZQl1sHiFgk5tYLNijHWi7pSLGCt6NIqCn5lrSFwSBbWkzQWaLhO2s0t\nONhZyv3bXJUlOjAuEtn2gckWvngLW2wR5FIlGexcc/Z+5/NlB8fdHrkRGML25Zbh\nAwQtVV04hmqHV8dR9NK9gollywKBgQC1X8FVfXyS0Ajew+GeiO4+9ZgXCZx1gBgV\n5aL9qGfSsyDUVXVQhi1RRRv7limzXPsNowVylt/JfHooYnTagaP1xstBDFWIJWaB\nj4Xo7x3TMf20ADxgQ9+K5BBIq/Z3+1F+Qid9ohHDcaELKJj58fyEOYE3OYH0/IGJ\nhZpJwUYoJwKBgQCFajJjzxNFDs9LfEhLYj70vUaDpoSns2O01F3Zdufc/N09p047\nuXI2aDArKOOySSB+/XWWPTg3dOFifijhlj0jnhtfP7j2B9ygxLlUUc0nms6JmkVR\nRMzSu50HakWTN9ZpQi/Qf8tyRKwFSfvaqX9d3gFLTr2x9oFs4JieyZ5GVQKBgQCv\nu96sQZDRAwaFKM/TdqM4l2dMcwCIjJtJpB0fnusxqGPXuBGZ+tev1cE+LAmtgxqw\n5NJja7HbHGOT+4lzKYc+nOXU2emJp4tBX1mFDyIbvmUt4cieEUVn4n+wmgWNzRDx\nv5FZ1g1WDCPYlvZZvtBHIRyE8JBtWbb9E1khu0WJowKBgQC+AWnv0PsDPWHSFMjm\nBIQMHSzx6thZX1GDYJ0P9rVDsGTbTO+eTWjwdoPl069z2amx8JG/15KcwjuuSjsp\npr0Slk0OYEhwHeeWoc3IY1JNi/7UxDaMJ/9H47aV3dCXr1EIfOSwDJYfGqgYvqan\nA8p7tQlS72dZpCdRl11wkgCNIw==\n-----END PRIVATE KEY-----\n",
        "client_email" => "firebase-adminsdk-evcpg@docta-2907c.iam.gserviceaccount.com",
        "client_id" => "114909768922999544957",
        "auth_uri" => "https://accounts.google.com/o/oauth2/auth",
        "token_uri" => "https://oauth2.googleapis.com/token",
        "auth_provider_x509_cert_url" => "https://www.googleapis.com/oauth2/v1/certs",
        "client_x509_cert_url" => "https://www.googleapis.com/robot/v1/metadata/x509/firebase-adminsdk-evcpg%40docta-2907c.iam.gserviceaccount.com",
        "universe_domain" => "googleapis.com"
    ];

    $client = new Google_Client();
    $client->setAuthConfig($credentialsFilePath);
    $client->addScope('https://www.googleapis.com/auth/firebase.messaging');
    $client->refreshTokenWithAssertion();
    $token = $client->getAccessToken();
    return $token['access_token'];
}
function sendMessage($token, $title, $body)
{
    if (!$token) {
        return false;
    }
    $apiurl = 'https://fcm.googleapis.com/v1/projects/docta-b2844/messages:send';
    $headers = [
        'Authorization: Bearer ' . fcmtoken(),
        'Content-Type: application/json'
    ];

    $message = [
        'message' => [
            'token' => $token,
            'notification' => [
                'title' => $title,
                'body' => $body,
            ],
        ],
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $apiurl);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($message));
    $result = curl_exec($ch);

    $ok = false;
    if ($result === FALSE) {
        // die('Curl failed: ' . curl_error($ch));
    }
    curl_close($ch);
    try {
        $result = json_decode($result);
        $ok = (bool) @$result->name;
    } catch (\Throwable $th) {
        // throw $th;
    }
    // dd($result, $ok);
    return $ok;
}
