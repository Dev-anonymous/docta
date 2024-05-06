<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Conseilmedical;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ConseilAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Conseilmedical::orderBy('id', 'desc')->get();
        return $data;
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
            'conseil' => 'required|unique:conseilmedical',
        ]);

        if ($validator->fails()) {
            $m = implode(" ", $validator->errors()->all());
            return response([
                'message' => $m
            ]);
        }

        $data = $validator->validated();
        Conseilmedical::create($data);

        return response([
            'success' => true,
            'message' => "Conseil médical créé avec succès."
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Conseilmedical  $conseilmedical
     * @return \Illuminate\Http\Response
     */
    public function show(Conseilmedical $conseil)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Conseilmedical  $conseilmedical
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Conseilmedical $conseil)
    {
        $validator = Validator::make(request()->all(), [
            'conseil' => 'required|unique:conseilmedical',
        ]);

        if ($validator->fails()) {
            $m = implode(" ", $validator->errors()->all());
            return response([
                'message' => $m
            ]);
        }

        $data = $validator->validated();
        $conseil->update($data);

        return response([
            'success' => true,
            'message' => "Conseil médical mis à jour avec succès."
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Conseilmedical  $conseilmedical
     * @return \Illuminate\Http\Response
     */
    public function destroy(Conseilmedical $conseil)
    {
        $conseil->delete();
        return response([
            'success' => true,
            'message' => "Conseil médical supprimé avec succès."
        ]);
    }
}
