<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Gopay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GoPAYController extends Controller
{
    public function init_payment()
    {
        $validator = Validator::make(
            request()->all(),
            [
                'devise' => 'required|in:CDF,USD',
                'amount' => 'required|numeric',
                'telephone' => 'required'
            ]
        );

        if ($validator->fails()) {
            $m = implode(', ', $validator->errors()->all());
            return response([
                'success' => false,
                'message' => $m
            ]);
        }
        $tel = request()->telephone;
        $tel = "+" . ((int) $tel);

        $ok = preg_match('/(\+24390|\+24399|\+24397|\+24398|\+24380|\+24381|\+24382|\+24383|\+24384|\+24385|\+24389)[0-9]{7}/', $tel);

        if (!$ok) {
            $m = "Le numéro $tel est invalide";
            return response([
                'success' => false,
                'message' => $m
            ]);
        }

        $devise = request()->devise;
        $amount = request()->amount;

        // MINIMUN AMOUNT IN CDF IS 500 CDF
        // MINIMUN AMOUNT IN USD IS 1 USD

        if ($devise == 'CDF' and $amount < 500) {
            return response([
                'success' => false,
                'message' => "Le montant minimum de paiement est de 500 CDF"
            ]);
        } else {
            if ($amount < 1) {
                return response([
                    'success' => false,
                    'message' => 'Le montant minimum de paiement est de 1 USD'
                ]);
            }
        }

        $r =   gopay_init_payment($amount, $devise, $tel);
        $app = userapp();

        $ref = null;
        if ($r->success) {
            Gopay::create([
                'ref' => $r->data->ref,
                'issaved' => 0,
                'isfailed' => 0,
                'paydata' => json_encode([
                    'app_id' => $app->id,
                    'ref' => $r->data->ref,
                    'montant' => $amount,
                    'devise' => $devise,
                    'telephone' => $tel
                ]),
            ]);
            $ref = $r->data->ref;
        }

        return response([
            'success' => $r->success,
            'message' => $r->message,
            'data' => ['ref' => $ref]
        ]);
    }


    public function check_payment()
    {
        $ref = request()->ref;
        $ok =  false;
        $issaved = 0;
        $trans = Gopay::where(['ref' => $ref])->lockForUpdate()->first();

        if (!$trans) {
            return response([
                'success' => false,
                'message' => "Invalid ref"
            ]);
        };

        $t = transaction_status($ref);
        $status = @$t->status;

        if ($status === 'success') {
            $issaved = @Gopay::where(['ref' => $ref])->first()->issaved;
            if ($issaved !== 1) {
                $paydata = json_decode($trans->paydata);
                saveData($paydata, $trans);
                $ok =  true;
                $trans->update(['isfailed' => 0]);
            }
        } else if ($status === 'failed') {
            $trans->update(['isfailed' => 1]);
        }

        if ($ok || $issaved === 1 || @$trans->issaved === 1) {
            return response([
                'success' => true,
                'message' => 'Votre transaction est effectuée.',
                'transaction' => $t
            ]);
        } else {
            $m = "Aucune transation trouvée.";
            return response([
                'success' => false,
                'message' => $m,
                'transaction' => $t
            ]);
        }
    }
}
