<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Zego;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ZegocloudController extends Controller
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
     * @param  \App\Models\Zego  $zego
     * @return \Illuminate\Http\Response
     */
    public function show(Zego $zego)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Zego  $zego
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Zego $zego)
    {
        $validator = Validator::make(request()->all(), [
            'appid' => 'required|numeric',
            'appsign' => 'required|string',
        ]);

        if ($validator->fails()) {
            $m = implode(" ", $validator->errors()->all());
            return response([
                'message' => $m
            ]);
        }

        $data = $validator->validated();
        $zego->update($data);

        return response([
            'success' => true,
            'message' => "Données mises à jour avec succès."
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Zego  $zego
     * @return \Illuminate\Http\Response
     */
    public function destroy(Zego $zego)
    {
        //
    }
}
