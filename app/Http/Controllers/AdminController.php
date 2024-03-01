<?php

namespace App\Http\Controllers;

use App\Models\App;
use App\Models\Solde;

class AdminController extends Controller
{
    public function index()
    {
        return view('pages.admin.index');
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
