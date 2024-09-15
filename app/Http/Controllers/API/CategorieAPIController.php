<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategorieAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Categorie::orderBy('categorie')->get();
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
            'categorie' => 'required|unique:categorie',
            'description' => 'sometimes|max:255',
        ]);

        if ($validator->fails()) {
            $m = implode(" ", $validator->errors()->all());
            return response([
                'message' => $m
            ]);
        }

        $data = $validator->validated();

        Categorie::create($data);

        return response([
            'success' => true,
            'message' => "Catégorie créée avec succès."
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function show(Categorie $categorie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Categorie $categorie)
    {
        $validator = Validator::make(request()->all(), [
            'categorie' => 'required|unique:categorie,id,' . $categorie->id,
            'description' => 'sometimes|max:255',
        ]);

        if ($validator->fails()) {
            $m = implode(" ", $validator->errors()->all());
            return response([
                'message' => $m
            ]);
        }

        $data = $validator->validated();
        $categorie->update($data);

        return response([
            'success' => true,
            'message' => "Catégorie mis à jour avec succès."
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categorie $categorie)
    {
        if ($categorie->profils()->count()) {
            return response([
                'message' => "Veuillez déplacer tous les docteurs dans cette catégorie avant de la supprimer."
            ]);
        }

        $categorie->delete();
        return response([
            'success' => true,
            'message' => "Catégorie supprimée avec succès."
        ]);
    }
}
