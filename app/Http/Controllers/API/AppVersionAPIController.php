<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Appversion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AppVersionAPIController extends Controller
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
        $appversion = Appversion::first();

        $validator = Validator::make(request()->all(), [
            'versionadmin' => 'required|regex:/\d+(\.\d)?$/',
            'noteadmin' => 'sometimes',
            'versionclient' => 'required|regex:/\d+(\.\d)?$/',
            'noteclient' => 'sometimes',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => implode(',', $validator->errors()->all()),
                'data' => []
            ]);
        }
        $data = $validator->validate();
        $data['requiredadmin'] = request()->has('requiredadmin');
        $data['requiredclient'] = request()->has('requiredclient');

        if (!$appversion) {
            Appversion::create($data);
        } else {
            $appversion->update($data);
        }
        return response()->json([
            'success' => true,
            'message' => "Données mises à jour.",
            'data' => $data,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Appversion  $appversion
     * @return \Illuminate\Http\Response
     */
    public function show(Appversion $appversion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Appversion  $appversion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Appversion $appversion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Appversion  $appversion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appversion $appversion)
    {
        //
    }
}
