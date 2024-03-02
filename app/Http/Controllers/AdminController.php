<?php

namespace App\Http\Controllers;

use App\Models\App;
use App\Models\Solde;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        $docta = User::where('user_role', 'docta')->count();
        $client = App::count();
        $clientactif = App::count();

        return view('pages.admin.index', compact('docta', 'client', 'clientactif'));
    }

    public function clients()
    {
        $app = App::orderBy('id', 'desc')->get();
        $solde = Solde::sum('solde_usd');
        $solde = number_format($solde, 2, '.', ' ');
        return view('pages.admin.clients', compact('solde', 'app'));
    }

    public function docta()
    {
        return view('pages.admin.docta');
    }

    public function conseils()
    {
        return view('pages.admin.conseils');
    }
}
