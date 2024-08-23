<?php

namespace App\Http\Controllers;

use App\Models\App;
use App\Models\Download;
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

        $visites = [];
        $telechargement = [];

        foreach (range(1, 12) as $m) {
            $visites[] = (int)  Visite::whereMonth('date', $m)->groupBy('ip')->sum('nb');
            $telechargement[] = (int)  Download::whereMonth('date', $m)->groupBy('ip')->sum('nb');
        }

        return response([
            'docta' => $docta,
            'clients' => $clients,
            'clientactifs' => $clientactifs,
            'visites' => $visites,
            'telechargement' => $telechargement,
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
