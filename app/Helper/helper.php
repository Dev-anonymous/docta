<?php

use App\Models\App;
use App\Models\Gopay;
use App\Models\Paiement;
use App\Models\Taux;
use Illuminate\Support\Facades\DB;

$xApiKey = "MFE2R0s0cEZMZVh2Rm8zb0tZNjNMdz09";

define('API_BASE', 'https://gopay.gooomart.com/api/v1');
define('API_HEADEARS',  [
    "Accept: application/json",
    "Content-Type: application/json",
    "x-api-key: $xApiKey"
]);

function gopay_init_payment($amount, $devise, $telephone)
{
    $_api_headers = API_HEADEARS;
    $telephone = (float) $telephone;
    $data = array(
        "telephone" => "+$telephone",
        "amount" => "$amount",
        "devise" => "$devise"
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
        $jsonRes = json_decode($response); // GOPAY API JSON RESPONSE
        // DD($jsonRes);  // UNCOMMENT TO SEE
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
    foreach ($pendingPayments as $e) {
        $paydata = json_decode($e->paydata);
        $ref = $e->ref;
        $t = transaction_status($ref);
        if ($t === true) {
            saveData($paydata, $e);
        } else {
            if ($t === false) {
                $e->update(['isfailed' => 1]);
            }
        }
    }
}

function transaction_status($ref)
{
    $_api_headers = API_HEADEARS;

    $gateway = API_BASE . "/payment/check/" . $ref;
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
            $d['date'] =  now('Africa/Lubumbashi');
            Paiement::create($d);
            $montant = $paydata->montant;
            $devise = $paydata->devise;
            $taux = Taux::first();
            if (!$taux) {
                $taux = Taux::create(['cdf_usd' => 0.00037, 'usd_cdf' => 2690]);
            }

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
        //throw $th;
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
