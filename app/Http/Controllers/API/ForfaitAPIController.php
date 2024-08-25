<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\App;
use App\Models\Forfait;
use App\Models\Pushnotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ForfaitAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Forfait  $forfait
     * @return \Illuminate\Http\Response
     */
    public function show(Forfait $forfait) {}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Forfait  $forfait
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Forfait $forfait)
    {
        $validator = Validator::make(request()->all(), [
            'appel' => 'required|numeric',
            'sms' => 'required|numeric',
            'sendpush' => 'sometimes',
            'pushtitle' => 'sometimes',
            'pushmessage' => 'sometimes',
        ]);

        if ($validator->fails()) {
            $m = implode(" ", $validator->errors()->all());
            return response([
                'message' => $m
            ]);
        }

        $data = $validator->validated();
        DB::beginTransaction();

        if (request()->has('sendpush')) {
            $sms = $data['sms'];
            $appel = $data['appel'];

            if ($sms != $forfait->sms or $forfait->appel != $appel) {
                $title = request('pushtitle');
                $message = request('pushmessage');

                if ($title and $message) {
                    foreach (App::all() as $app) {
                        $pushno = json_encode(['to' => ['app', $app->id], 'title' => $title, 'message' => $message]);
                        Pushnotification::create([
                            'data' => $pushno
                        ]);
                    }
                }
            }
        }

        $forfait->update($data);
        DB::commit();

        return response([
            'success' => true,
            'message' => "Prix mis à jour avec succès."
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Forfait  $forfait
     * @return \Illuminate\Http\Response
     */
    public function destroy(Forfait $forfait)
    {
        //
    }
}
