<?php

namespace App\Http\Controllers;

use App\Models\Site;
use Illuminate\Http\Request;

class WEBController extends Controller
{
    function index()
    {
        return view('pages.web.index');
    }
    function politique()
    {
        $text = @Site::where('type', 'politique')->first()->text;
        return view('pages.web.politique', compact('text'));
    }

    function terme()
    {
        $text = @Site::where('type', 'terme')->first()->text;
        return view('pages.web.terme', compact('text'));
    }

    function mention()
    {
        $text = @Site::where('type', 'mention')->first()->text;
        return view('pages.web.mention', compact('text'));
    }
}
