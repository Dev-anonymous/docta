<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DoctaController extends Controller
{
    function index(){
        return view('pages.docta.index');
    }
}
