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
        if ($n > 5 && $sold == 0) {
            abort(403, 'Balance error for SMS');
        }
        $n = $chat->messages()->where('fromuser', 0)->whereNotNull('file')->count();
        $sold = $app->soldes()->first()->solde_usd;
        if ($n > 1 && $sold == 0) {
            abort(403, 'Balance error for FILE');
        }
    }
}

function fcmtoken()
{
    $credentialsFilePath =  [
        "type" => "service_account",
        "project_id" => "docta-b2844",
        "private_key_id" => "6c0659e961317447ab54ed71d4735a0f81327c30",
        "private_key" => "-----BEGIN PRIVATE KEY-----\nMIIEvQIBADANBgkqhkiG9w0BAQEFAASCBKcwggSjAgEAAoIBAQDFX395x7G7fio7\nZcHHAkiFjHOWOKfSX4EDbqN+wcgvwAsRJ68DTsnpMQeU7PbacpEFoGyeZlMiV0A3\nufoFJSy/y2phiaS9vJzUrVWzrIsZ8g5yyY8KoHZ2RWdtyc3oRhIomcSDZCQz4Fo/\nYdxAFmYH39lTMoDMsDdXaaeQmTQPu+F4dYyffCxUPm1e0xQIj50Pgv3b5ouGd7oS\nEok9Wj1lDLWYCwXDFbvy131IcJF7H40HSKyoaUwYohMVTZqXE8L+s7od9NhZHpvP\n9FZQiGWxF3zuK6CGJuLYKT+QV6gU5po2uf4LW0a4kIoUuWfLjoOgBsee2pxTDJKJ\n/E5NvaEFAgMBAAECggEABd3nxzAyPKnlWEAXIk9MV8jL8FPLk3txmOghno46KEb6\n0MqPdn6KjkBvycHdOM+hU5g2VeM+bbTV51W1JjtytVpTY80qVPKZQwqt9xZygg6m\nK9pQQqyMtx65WX57w/+Tb2GhZOv+nQxd57a9y/7+cqQHXo8d6nCRYeQufE6u11EO\nsSEGjKfXnAMm6yK6ciKSTv+5+bIDeunYogMCTHiw9nBHJkCWG9TUWOkmqI3g/ffs\njZ99ZiqAv+oN35+2YMlYVC6iH07J3jtdjj6RhbRnXqu/pjRcv4n93oMSgwkNw8GU\nw6YwsK3Yh+U+RmRaKya+O9SWbqMsR79l/Smnv8WeNwKBgQD0QXXPQwDjwUnvSBEh\nH+RUS1JSp4tMJFJ05mQAp+8jJSpkABc4R3MGhgPP7iBmxchcB0eXjm23ZH/oChjh\nOKljg9aEp7yeyt+ybH5Hxpt48Q8CnamhVbSs9F6QKlYKhbETtN6ivoqvGXcilM1s\ne7pBcjcCs5aJvYBLc16grJBI4wKBgQDO3PWxPXmbIps2tzcx9DlOLnoPHjFgc15x\ngxMiHPyk1jfdSB37jdZNJX3es1zOPEp8PDFsyN6z9i4CM7a0u6VL7M3hj/HLIwLc\nph9VOZr1ATaKMUJZFrktp3OdERj3sn/JJbDwSeAMrcgPIOaV9nF+qcHzcFoFqF/9\nVe5IVZLa9wKBgGevUf9Fhh8oceYtRXg2PYq63ptPnAYadRZCprjQkObuY+xHTZQK\nYH2obf3aK870rnTCclWXlGOBOfqaLq2Mi/s+f9WYDq2pmQP4ojJ90ImqaqDFpLhj\n1WqF4Y55KkUVM3IWGVwkXmKuALChUgJ3Ez2s6kUvTvvxgYCF3Ol/10/ZAoGAMCkt\nYnhniYDDFjgNt6medd9IN6DV6hiyEkdr+vM4tr/Q/cm+gUSCci+aYHDt2G4dAVOa\nRjN19fwItiaIEQfm8ghN3of+yUZ7cheTD+p7czM3GXFiew9ZSZHEzvqeD30VVyVZ\nTnhEm28SNsN4K83WmqC3MRAlRU/wGTEaaujRaf0CgYEAhGobKd51GGnSeORmrmqU\nfgHzF0F0HSjQ7mQHJ0A7Uoo+rF6v32FQaGta22CzNwE1dgcWL7yUm+aEC5YResME\nmd5VRM2rz5+iulto2KRQN0s9+WiDNSLDDC4r9uYKP8szPRTycnxzKD7Pp/AqnLTJ\nkm61xNsz1ubKhKKc6QKPy5M=\n-----END PRIVATE KEY-----\n",
        "client_email" => "firebase-adminsdk-57kb0@docta-b2844.iam.gserviceaccount.com",
        "client_id" => "115396384437441200121",
        "auth_uri" => "https://accounts.google.com/o/oauth2/auth",
        "token_uri" => "https://oauth2.googleapis.com/token",
        "auth_provider_x509_cert_url" => "https://www.googleapis.com/oauth2/v1/certs",
        "client_x509_cert_url" => "https://www.googleapis.com/robot/v1/metadata/x509/firebase-adminsdk-57kb0%40docta-b2844.iam.gserviceaccount.com",
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
