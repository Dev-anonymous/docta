<?php

namespace App\Http\Controllers;

use App\Models\App;
use App\Models\Solde;
use App\Models\User;
use Illuminate\Http\Request;

class ClientAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $app = App::orderBy('last_login', 'desc')->get();
        $tab = [];

        foreach ($app as $el) {
            $actif = '';
            $label = '';
            if ($el->last_login) {
                $n = now('Africa/Lubumbashi')->diffInDays($el->last_login);
                $l = now('Africa/Lubumbashi')->diffForHumans($el->last_login);

                if ($n <= 7) {
                    $label = "Dernière connexion : $l";
                    $actif =
                        "<b style='cursor:pointer' class='badge badge-info'> <i class='fa fa-check-circle'></i> ACTIF</b>";
                }

                if (isconnected($el->last_login)) {
                    $label = 'Utilisateur connecté';
                    $actif =
                        "<b style='cursor:pointer' class='badge badge-success text-white'> <i class='fa fa-check-circle'></i> CONNECTE</b>";
                }
            }

            $o = (object) $el->toArray();
            $o->solde = "$ ". number_format($el->soldes()->first()->solde_usd, 2, '.', ' ');
            $o->nom = $el->nom ?? '';
            $o->email = $el->email ?? '';
            $o->telephone = $el->telephone ?? '';
            $o->last_login = $el->last_login?->format('d-m-Y H:i:s');
            $o->date = $el->date?->format('d-m-Y H:i:s');
            $o->actif = $actif;
            $o->label = $label;
            $tab[] = $o;
        }

        $solde = Solde::sum('solde_usd');
        $solde = number_format($solde, 2, '.', ' ');

        return response()->json([
            'success' => true,
            'data' => ['clients' => $tab, 'solde' => "$ $solde"]
        ]);
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
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}