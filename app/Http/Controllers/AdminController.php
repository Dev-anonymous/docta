<?php

namespace App\Http\Controllers;

use App\Models\App;
use App\Models\Contact;
use App\Models\Forfait;
use App\Models\Site;
use App\Models\Solde;
use App\Models\Taux;
use App\Models\User;
use App\Models\Zego;

class AdminController extends Controller
{
    public function index()
    {
        $docta = User::where('user_role', 'docta')->count();
        $client = App::count();
        $min_date = now('Africa/Lubumbashi')->subDays(7)->format("Y-m-d H:i:s");
        $clientactif = App::whereDate('last_login', '>=', $min_date)->count();
        return view('pages.admin.index', compact('docta', 'client', 'clientactif'));
    }

    public function clients()
    {
        $app = App::orderBy('last_login', 'desc')->get();
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

    public function contact()
    {
        $data = Contact::orderBy('id', 'desc')->get();
        return view('pages.admin.contact', compact('data'));
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
}
