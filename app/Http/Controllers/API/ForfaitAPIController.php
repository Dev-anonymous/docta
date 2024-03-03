<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Forfait;
use Illuminate\Http\Request;
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
    public function show(Forfait $forfait)
    {

    }

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
            'cout' => 'required|numeric|min:0.001',
        ]);

        if ($validator->fails()) {
            $m = implode(" ", $validator->errors()->all());
            return response([
                'message' => $m
            ]);
        }

        $data = $validator->validated();
        $forfait->update($data);

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
