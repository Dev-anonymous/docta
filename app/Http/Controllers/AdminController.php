<?php

namespace App\Http\Controllers;

use App\Models\App;
use App\Models\Appversion;
use App\Models\Categorie;
use App\Models\Categoriemagazine;
use App\Models\Contact;
use App\Models\Errorlog;
use App\Models\Forfait;
use App\Models\Site;
use App\Models\Slide;
use App\Models\Solde;
use App\Models\Taux;
use App\Models\User;
use App\Models\Visite;
use App\Models\Zego;

class AdminController extends Controller
{
    public function index()
    {
        $docta = User::where('user_role', 'docta')->orderBy('name')->get();
        return view('pages.admin.index', compact('docta'));
    }

    public function clients()
    {
        return view('pages.admin.clients');
    }

    public function docta()
    {
        $categories = Categorie::orderBy('categorie')->get();
        return view('pages.admin.docta', compact('categories'));
    }
    public function demande()
    {
        return view('pages.admin.demande');
    }
    public function categorie()
    {
        return view('pages.admin.categorie');
    }

    public function conseils()
    {
        return view('pages.admin.conseils');
    }

    public function contact()
    {
        $data = Contact::orderBy('id', 'desc')->get();
        return view('pages.admin.contact', compact('data'));
    }

    public function slides()
    {
        return view('pages.admin.slides');
    }

    public function facturation()
    {
        $data = Forfait::first();
        return view('pages.admin.facturation', compact('data'));
    }

    public function taux()
    {
        $data = Taux::first();
        return view('pages.admin.taux', compact('data'));
    }

    public function zegocloud()
    {
        $data = Zego::first();
        if (!$data) {
            $data = Zego::create(['appid' => 1611714402, 'appsign' => '79ae0359bb4e80dee8b2e1d1cace4013e9155b96b2a609058f6054b20dfe8d87']);
        }
        return view('pages.admin.zego', compact('data'));
    }

    public function site()
    {
        foreach (['terme', 'politique', 'mention'] as $type) {
            if (!Site::where('type', $type)->first()) {
                Site::create(['type' => $type]);
            }
        }

        $terme = Site::where('type', 'terme')->first();
        $politique = Site::where('type', 'politique')->first();
        $mention = Site::where('type', 'mention')->first();
        return view('pages.admin.site', compact('terme', 'politique', 'mention'));
    }

    public function log()
    {
        $action = request('action');
        if ('del' == $action) {
            Errorlog::orderBy('id')->delete();
        }
        $data = Errorlog::orderBy('id', 'desc')->get();
        return view('pages.admin.log', compact('data'));
    }

    public function app()
    {
        $data = Appversion::first();
        return view('pages.admin.app', compact('data'));
    }

    public function categoriemag()
    {
        return view('pages.admin.categoriemag');
    }
    public function magazine()
    {
        $categories = Categoriemagazine::orderBy('categorie')->get();
        return view('pages.admin.magazine', compact('categories'));
    }
}
