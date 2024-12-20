<?php

namespace App\Http\Controllers;

use App\Models\Forfait;
use Illuminate\Http\Request;

class DoctaController extends Controller
{
    function index()
    {
        $user = auth()->user();
        $actif = $user->profils()->first()?->actif;
        $mustpay = 1 != $actif and 'externe' == $user->type;
        $montant = Forfait::first()?->compte;
        return view('pages.docta.index', compact('mustpay', 'montant'));
    }
}
