<?php

namespace App\Http\Controllers;

use App\Models\Profil;
use App\Models\Site;
use App\Models\Slide;
use App\Models\User;
use Illuminate\Http\Request;

class WEBController extends Controller
{
    function index()
    {
        // return view('pages.web.a');
        $slides = Slide::orderBy('id', 'desc')->get();
        return view('pages.web.index', compact('slides',));
    }
    function politique()
    {
        $text = @Site::where('type', 'politique')->first()->text;
        $title = 'Politique de confidentialité';
        return view('pages.web.site', compact('text', 'title'));
    }

    function terme()
    {
        $text = @Site::where('type', 'terme')->first()->text;
        $title = 'Termes et conditions d\'utilisation ';
        return view('pages.web.site', compact('text', 'title'));
    }

    function mention()
    {
        $text = @Site::where('type', 'mention')->first()->text;
        $title = 'Mentions légales';
        return view('pages.web.site', compact('text', 'title'));
    }

    function terme00()
    {
        $show = request('show');

        if ($show == 'politique') {
            $title = 'Politique de confidentialité';
        } elseif ($show == 'mention') {
            $title = 'Mentions légales';
        } else {
            $show = 'terme';
            $title = 'Termes et conditions d\'utilisation ';
        }

        $text = @Site::where('type', $show)->first()->text;
        return view('pages.web.site-embeded', compact('text', 'title'));
    }
}
