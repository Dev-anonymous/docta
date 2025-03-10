<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Categoriemagazine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoriemagAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Categoriemagazine::orderBy('categorie')->get();
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
            'categorie' => 'required|unique:categoriemagazine',
        ]);

        if ($validator->fails()) {
            $m = implode(" ", $validator->errors()->all());
            return response([
                'message' => $m
            ]);
        }

        $data = $validator->validated();
        $data['categorie'] = ucfirst($data['categorie']);

        Categoriemagazine::create($data);

        return response([
            'success' => true,
            'message' => "Catégorie créée avec succès."
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Categoriemagazine  $categoriemagazine
     * @return \Illuminate\Http\Response
     */
    public function show(Categoriemagazine $categoriemagazine)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Categoriemagazine  $categoriemagazine
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Categoriemagazine $categoriemag)
    {
        $validator = Validator::make(request()->all(), [
            'categorie' => 'required|unique:categoriemagazine,id,' . $categoriemag->id,
        ]);

        if ($validator->fails()) {
            $m = implode(" ", $validator->errors()->all());
            return response([
                'message' => $m
            ]);
        }

        $data = $validator->validated();
        $data['categorie'] = ucfirst($data['categorie']);
        $categoriemag->update($data);

        return response([
            'success' => true,
            'message' => "Catégorie mis à jour avec succès."
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Categoriemagazine  $categoriemagazine
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categoriemagazine $categoriemag)
    {
        if ($categoriemag->magazines()->count()) {
            return response([
                'message' => "Veuillez déplacer tous les magazines de cette catégorie avant de la supprimer."
            ]);
        }

        $categoriemag->delete();
        return response([
            'success' => true,
            'message' => "Catégorie supprimée avec succès."
        ]);
    }
}
