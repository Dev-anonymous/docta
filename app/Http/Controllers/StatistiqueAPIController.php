<?php

namespace App\Http\Controllers;

use App\Models\App;
use App\Models\Chat;
use App\Models\Download;
use App\Models\Message;
use App\Models\User;
use App\Models\Visite;
use Illuminate\Http\Request;

class StatistiqueAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $docta = User::where('user_role', 'docta')->count();
        $clients = App::count();
        $min_date = now('Africa/Lubumbashi')->subDays(8)->format("Y-m-d H:i:s");
        $clientactifs = App::whereDate('last_login', '>=', $min_date)->count();

        $docta_id = request('docta_id');

        $visites = [];
        $telechargement = [];

        foreach (range(1, 12) as $m) {
            $visites[] =   Visite::whereMonth('date', $m)->sum('nb');
            $telechargement[] =   Download::whereMonth('date', $m)->sum('nb');
        }

        $visitejournaliere =  Visite::whereDate('date', now())->sum('nb');
        $visitehier =  Visite::whereDate('date', now()->subDay())->sum('nb');
        $visitehebdomadaire =  Visite::whereDate('date', '>=', date('Y-m-d', strtotime('monday this week')))->whereDate('date', '<=', date('Y-m-d', strtotime('sunday this week')))->sum('nb');

        $telechargementjournaliere =  Download::whereDate('date', now())->sum('nb');
        $telechargementhier =  Download::whereDate('date', now()->subDay())->sum('nb');
        $telechargementhebdomadaire =  Download::whereDate('date', '>=', date('Y-m-d', strtotime('monday this week')))->whereDate('date', '<=', date('Y-m-d', strtotime('sunday this week')))->sum('nb');

        $messagejournaliere =  Message::whereDate('date', now());
        $messagehier =  Message::whereDate('date', now()->subDay());
        $messagehebdomadaire =  Message::whereDate('date', '>=', date('Y-m-d', strtotime('monday this week')))->whereDate('date', '<=', date('Y-m-d', strtotime('sunday this week')));

        $docta = '';
        if ($docta_id) {
            $messagejournaliere = $messagejournaliere->whereIn('chat_id', Chat::where('users_id', $docta_id)->pluck('id')->all());
            $messagehier = $messagehier->whereIn('chat_id', Chat::where('users_id', $docta_id)->pluck('id')->all());
            $messagehebdomadaire = $messagehebdomadaire->whereIn('chat_id', Chat::where('users_id', $docta_id)->pluck('id')->all());
            $docta = @User::find($docta_id)->name;
            $docta = ucwords(($docta));
        }
        $messagejournaliere = $messagejournaliere->count();
        $messagehier = $messagehier->count();
        $messagehebdomadaire = $messagehebdomadaire->count();


        return response([
            'docta' => $docta,
            'clients' => $clients,
            'clientactifs' => $clientactifs,
            'visites' => $visites,
            'visitehier' => $visitehier,
            'visitejournaliere' => $visitejournaliere,
            'visitehebdomadaire' => $visitehebdomadaire,
            'telechargement' => $telechargement,
            'telechargementhier' => $telechargementhier,
            'telechargementjournaliere' => $telechargementjournaliere,
            'telechargementhebdomadaire' => $telechargementhebdomadaire,
            'messagehier' => $messagehier,
            'messagejournaliere' => $messagejournaliere,
            'messagehebdomadaire' => $messagehebdomadaire,
            'docta' => $docta,
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
