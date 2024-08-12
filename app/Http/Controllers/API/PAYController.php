<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\App;
use App\Models\Gopay;
use App\Models\Maxicash;
use App\Models\Paiement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PAYController extends Controller
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
        $app = userapp();

        $myref = 'myref' . time() . rand(10000, 90000);
        $gopay = Gopay::create([
            'myref' => $myref,
            'issaved' => 0,
            'isfailed' => 0,
            'paydata' => json_encode([
                'app_id' => $app->id,
                'montant' => $amount,
                'devise' => $devise,
                'telephone' => $tel,
                'methode' => 'mobile_money',
            ]),
        ]);
        $r = gopay_init_payment($amount, $devise, $tel, $myref);

        $ref = null;
        if ($r->success) {
            $ref = $r->data->ref;
            $gopay->update(compact('ref'));
        }

        return response([
            'success' => $r->success,
            'message' => $r->message,
            'data' => ['myref' => $myref]
        ]);
    }

    public function check_payment()
    {
        $myref = request()->myref;
        $ok =  false;
        $issaved = 0;
        $trans = Gopay::where(['myref' => $myref])->lockForUpdate()->first();

        if (!$trans) {
            return response([
                'success' => false,
                'message' => "Invalid ref"
            ]);
        };

        $t = transaction_status($myref);
        $status = @$t->status;

        if ($status === 'success') {
            $issaved = @Gopay::where(['myref' => $myref])->first()->issaved;
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

    function cardpayment()
    {
        $validator = Validator::make(
            request()->all(),
            [
                'amount' => 'required|numeric|min:0.5',
            ]
        );

        if ($validator->fails()) {
            $m = implode(', ', $validator->errors()->all());
            return response([
                'success' => false,
                'message' => $m
            ]);
        }

        $amount = request('amount');
        $ref = uniqid('REF-', true);

        $data['payurl'] = 'https://api-testbed.maxicashapp.com/PayEntryPost';
        $data['PayType'] = 'MaxiCash';
        $data['Amount'] = $amount * 100;
        $data['Currency'] = 'MaxiDollar';
        $data['Language'] = 'Fr';
        $data['Reference'] = $ref;
        $data['accepturl'] = route('pay.callback', ['_action' => 'accept']);
        $data['cancelurl'] = route('pay.callback', ['_action' => 'cancel']);
        $data['declineurl'] = route('pay.callback', ['_action' => 'decline']);
        $data['MerchantID'] = '45ca4c2a7ef944278042c59b2fd37dde';
        $data['MerchantPassword'] = '890690861ca04a8fb6751ebd489511e5';

        $app = userapp();
        $tmp = $data;
        $tmp['paydata'] =   [
            'app_id' => $app->id,
            'ref' => $ref,
            'montant' => $amount,
            'devise' => 'USD',
            'methode' => 'online_banking',
        ];

        Maxicash::create([
            'saved' => 0,
            'failed' => 0,
            'ref' => $ref,
            'paydata' => json_encode($tmp),
            'date' => now('Africa/Lubumbashi')
        ]);

        return response([
            'success' => true,
            'message' => '',
            'data' => $data
        ]);
    }

    function pay_cb()
    {
        $action = request('_action');
        $status = request('status');
        $ref = request('reference');

        $success = $action == 'accept';
        $cancel = $action == 'cancel';
        $decline = $action == 'decline';

        $tref = $ref ?? '';
        $montant = '';

        if ($action == 'accept') {
            $pay = Maxicash::where(compact('ref'))->first();
            if ($pay) {
                $montant = number_format((json_decode($pay->paydata)->Amount / 100) ?? 0, 2, '.', ' ') . ' USD';
                if ('success' == $status) {
                    $paydata = json_decode($pay->paydata);
                    if ($pay->saved === 0 and $pay->failed === 0) {
                        $pd = (array) $paydata->paydata;
                        $pd['date'] =  now('Africa/Lubumbashi');
                        try {
                            DB::transaction(function () use ($pd, $pay) {
                                Paiement::create($pd);
                                $app = App::where('id', $pd['app_id'])->first();
                                $solde = $app->soldes()->first();
                                if (!$solde) {
                                    $solde = $app->soldes()->create(['solde_usd' => 0]);
                                }
                                $val = $pd['montant'];
                                $solde->increment('solde_usd', $val);
                                $pay->update(['saved' => 1]);
                            });
                        } catch (\Throwable $th) {
                            //throw $th;
                        }
                    }
                }
            }
        } else if ($action == 'cancel' or $action == 'decline') {
            $pay = Maxicash::where(compact('ref'))->first();
            if ($pay) {
                $montant = number_format((json_decode($pay->paydata)->Amount / 100) ?? 0, 2, '.', ' ') . ' USD';
                $pay->update(['failed' => 1]);
            }
        } else {
        }
        return view('pages.web.pay-callback', compact('success', 'cancel', 'decline', 'tref', 'montant'));
    }
}
