<?php

use App\Models\App;
use App\Models\Chat;
use App\Models\Forfait;
use App\Models\Gopay;
use App\Models\Message;
use App\Models\Paiement;
use App\Models\Pushnotification;
use App\Models\Taux;
use App\Models\User;
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
        $forf = Forfait::first();

        $sms = (float) @$forf->sms;
        // $appel = (float) @$forf->appel;

        if ($n > 5 && $sold <= 0 && $sms > 0) {
            abort(403, 'Balance error for SMS');
        }
        $n = $chat->messages()->where('fromuser', 0)->whereNotNull('file')->count();
        $sold = $app->soldes()->first()->solde_usd;
        if ($n > 1 && $sold <= 0 && $sms > 0) {
            abort(403, 'Balance error for FILE');
        }
    }
}

function fcmtoken()
{
    $credentialsFilePath =  [
        "type" => "service_account",
        "project_id" => "docta-2907c",
        "private_key_id" => "a5c0aeb7de7c7a9b47749b9fdc0eccf4334fa521",
        "private_key" => "-----BEGIN PRIVATE KEY-----\nMIIEvgIBADANBgkqhkiG9w0BAQEFAASCBKgwggSkAgEAAoIBAQCz4gWSLTbQIhcj\nSzMZUHucYNJ6pKNjU8YnjLkei3sZ6FaNhaR76AiMHE5Hl1VLXHWYciYFOUkvizSE\nzjRNT8UO4c0vHPqa1szKBYU0wFaL8HaYbPe2HK6vbERVlP/4LXCOd4mv6TiS/++p\nSlWEdJXdDZxtukTyDeHJ/XsK31ePhNN7MLMdCvPWxwBE0D/72rIBKo8fXdAbBQbC\nrqVaPUaxghNoiiJXkJ6JcIw0Xzx8xGKf/o/Q4eIAymuCZ+OxJjck2TjPQ+TCGsPq\nzKcRgR/gEQu2mWwKhiTOFIerJ2j4RbvsxazJLq7cX3r6z+RTUz1GhW9FDr1MCJjq\nkv/k2Ky/AgMBAAECggEANNE5x4kFHinUV2WeNGGgWfNH+gDbhK+1cClutZxI4fuJ\nZnaGLGeeEt3A0l6KCd21HbTumvwOFCqwmgod61Fv0AXXBG1i3BIUAYGLckjDYMWT\nXQAp38weMp38lpBwdEOLWBmbUQ6OsQL7MN8FqyW8VzLG6qUV12jiEjgeZ7vabuYX\n0bIU0TdRbivJh/4SDtns0eZ4QaRIPWcA2l2+sU6MrHEfg4QvKEAdkqQDmqMEND3O\nPd8Pg31uH7c4EuFFN5ouWFwYSBFBxBcsYrydcVKUl03VafE9RVTQu3g3mdCmxpVE\nKWj/warIlXDiM06W7516189Ccwyw3OLXVT98F1OOcQKBgQDrNYCKGQyE9R67Baa1\ndHW+xFOtd1A9jVUvgf4OQD8Twi2iATUYVTwwgF0bQ6E52RrIOgz8yImmUcs8SKdf\n1rwyg/q7+bGYr9VxbSlZnIfpSeE2Sfd7+/PCYbhUycK0+uk7eFiHJ66m16zJK0Bx\nV2co4SIAaK4nTpPmB7uauZkAeQKBgQDDyI5tzeL3TYGWd79daulkKREEDtQ49VTe\nKmX/G6BGt6TZpEQzfz8UerGTu9o3RymyS7EWQ8JOsUD8kHyLxT4vAZtIbfFrb74E\n1taPB+koMZtADiD70q2aR/L0GcHR62an4KKcmHW3vedXaSOiULoJ+bwcaiofU//T\nA1FYHuT49wKBgQDam0RXlcZkAKpKKotyFMamwjP/gmgqfSRSXmAxAJdfltbwvmyJ\nrBagAX4HrAi6CkVxGTse6oe89EKPSft+AMezr6SndwAQKESaAlovNmO/eHIAEikZ\nq+c3n7lB3K/Bo36ITmcBXuldmhC2fCON9C0l+nCurpxGXirp3gAIYz2ICQKBgQCj\n16oCEEO5i/4/qrTV+8uXi5p21+YYSI8eYUL8S+VEaRknHgYJRprGi6siJBoJGp+1\nWwy2wjvQ2Ru2gUAJRCa29dQ6t+9KZrgRmqzyA7/GaEUxROGrfHLV4xJZ31hJUYOW\nSDItdJVHEECS8STmCEK4aGtZKCtaDlTQBT3Ezg32nwKBgGbs4R3mRbfDP1y9PkMX\neAi+4OzLHg0ttSCO2iZ4LrtOeHoNGbGAmvUJTTQafZJJFdS8DkvhJvhcYr//SKJ1\n2gZHgupBs+sDnyYwunwYwlB7LD926lIyBLm3tPWhJAjWvUb5b0vw3LNor0M1kv2B\n3CXq0MCLZsKKiEqXlKNbnAwr\n-----END PRIVATE KEY-----\n",
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
    $apiurl = 'https://fcm.googleapis.com/v1/projects/docta-2907c/messages:send';
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
                // 'icon' => asset('images/icon.png'),
                // 'image' => asset('images/icon.png'),
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
        // dd($result);
        $ok = (bool) @$result->name;
    } catch (\Throwable $th) {
        // throw $th;
    }
    return $ok;
}

function assignchat($chats = [], $skipeuser = 0)
{
    DB::beginTransaction();
    if (!count($chats)) {
        $chats =  Chat::whereNull('users_id')->get();
    }

    $notify = [];
    foreach ($chats as $el) {
        $uchat = [];
        $doc = User::where('user_role', 'docta');
        if ($skipeuser) {
            $doc = $doc->where('id', '!=', $skipeuser);
        }
        $doc = $doc->get();

        foreach ($doc as $do) {
            $uchat[$do->id] = $do->chats()->count();
        }
        asort($uchat);
        if (count($uchat)) {
            $key = array_key_first($uchat);
            $el->update(['users_id' => $key,  'sent' => 0]);
            Message::where('chat_id', $el->id)->update(['senttouser' => 0]);
            $notify[] = $key;
        }
    }

    $notify = array_unique($notify);

    foreach ($notify as $iduser) {
        $user = User::where('id', $iduser)->first();
        $title = 'Nouvelle Conversation';
        $pushno = json_encode(['to' => ['user', $user->id], 'title' => $title, 'message' => "Vous avez des conversations qui vous ont été assignées automatiquement. Veuillez vous reconnecter de l'application."]);
        Pushnotification::create([
            'data' => $pushno
        ]);
        $user->tokens()->delete();
    }
    DB::commit();
}


function isconnected($last_login)
{
    if (!$last_login) return false;
    $n = (time() + 3600 * 2) - strtotime($last_login->format('Y-m-d H:i:s'));
    return ($n / 60) <= 3;
}
