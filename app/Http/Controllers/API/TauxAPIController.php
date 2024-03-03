<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Taux;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TauxAPIController extends Controller
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
     * @param  \App\Models\Taux  $taux
     * @return \Illuminate\Http\Response
     */
    public function show(Taux $taux)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Taux  $taux
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Taux $taux)
    {
        $validator = Validator::make(request()->all(), [
            'cdf_usd' => 'required|numeric|min:0.000001',
            'usd_cdf' => 'required|numeric|min:0.000001',
        ]);

        if ($validator->fails()) {
            $m = implode(" ", $validator->errors()->all());
            return response([
                'message' => $m
            ]);
        }

        $data = $validator->validated();
        $taux->update($data);

        return response([
            'success' => true,
            'message' => "Taux mis à jour avec succès."
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Taux  $taux
     * @return \Illuminate\Http\Response
     */
    public function destroy(Taux $taux)
    {
        //
    }
}
