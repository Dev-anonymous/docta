<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\App;
use App\Models\Pushnotification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PushnotificationAPIController extends Controller
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
        $validator = Validator::make(request()->all(), [
            'to' => 'required|',
            'pushtitle' => 'required|',
            'pushmessage' => 'required|',
        ]);

        if ($validator->fails()) {
            $m = implode(" ", $validator->errors()->all());
            return response([
                'message' => $m
            ]);
        }

        $data = $validator->validated();
        DB::beginTransaction();
        $to = request('to');
        $title = request('pushtitle');
        $message = request('pushmessage');

        if ('client' == $to) {
            foreach (App::all() as $app) {
                $pushno = json_encode(['to' => ['app', $app->id], 'title' => $title, 'message' => $message]);
                Pushnotification::create([
                    'data' => $pushno
                ]);
            }
        } else {
            foreach (User::where('user_role', 'docta')->get() as $user) {
                $pushno = json_encode(['to' => ['user', $user->id], 'title' => $title, 'message' => $message]);
                Pushnotification::create([
                    'data' => $pushno
                ]);
            }
        }
        DB::commit();

        return response([
            'success' => true,
            'message' => "Pushnotification envoyé."
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pushnotification  $pushnotification
     * @return \Illuminate\Http\Response
     */
    public function show(Pushnotification $pushnotification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pushnotification  $pushnotification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pushnotification $pushnotification)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pushnotification  $pushnotification
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pushnotification $pushnotification)
    {
        //
    }
}
