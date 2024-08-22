<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Pushnotification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class DoctaAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $t = User::where('user_role', 'docta')->orderBy('id', 'desc')->get();
        $data = [];

        foreach ($t as $el) {
            $o = (object) $el->toArray();
            $o->derniere_connexion = $el->derniere_connexion?->format('d-m-Y H:i:s') ?? '-';
            $label = 'déconnecté';
            $actif = "<b style='cursor:pointer' class='badge badge-danger text-white'> <i class='fa fa-wifi'></i> DECONNECTE</b>";

            if ($el->derniere_connexion) {
                $n = now()->diffInDays($el->derniere_connexion);
                $l = now()->diffForHumans($el->derniere_connexion);

                if ($n <= 7) {
                    $label = "Dernière connexion : $l";
                    $actif =
                        "<b style='cursor:pointer' class='badge badge-info'> <i class='fa fa-check-circle'></i> ACTIF</b>";
                }

                if (isconnected($el->derniere_connexion)) {
                    $label = 'connecté';
                    $actif =
                        "<b style='cursor:pointer' class='badge badge-success text-white'> <i class='fa fa-wifi'></i> CONNECTE</b>";
                }
            }
            $o->label = $label;
            $o->actif = $actif;
            $data[] = $o;
        }
        return $data;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(request()->all(), [
            'name' => 'required',
            'email' => 'required|unique:users',
            'phone' => 'required|min:10|unique:users',
            'pass' => 'required',
        ]);

        if ($validator->fails()) {
            $m = implode(" ", $validator->errors()->all());
            return response([
                'message' => $m
            ]);
        }

        $data = $validator->validated();
        $data['password'] = Hash::make(request('pass'));
        $data['user_role'] = 'docta';
        User::create($data);

        return response([
            'success' => true,
            'message' => "Compte créé avec succès."
        ]);
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
    public function update(Request $request, User $docta)
    {
        $validator = Validator::make(request()->all(), [
            'name' => 'required',
            'email' => 'required|unique:users,email,' . $docta->id,
            'phone' => 'required|min:10|unique:users,phone,' . $docta->id,
            'pass' => 'sometimes',
        ]);

        if ($validator->fails()) {
            $m = implode(" ", $validator->errors()->all());
            return response([
                'message' => $m
            ]);
        }

        $data = $validator->validated();
        if (request('pass')) {
            $data['password'] = Hash::make(request('pass'));
        }
        $docta->update($data);

        return response([
            'success' => true,
            'message' => "Compte mis à jour avec succès."
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $docta)
    {
        // $oth = User::where('user_role', 'docta')->where('id', '!=', $docta->id)->first();



        DB::beginTransaction();
        $notifuser = [];
        $chat = $docta->chats()->get();
        assignchat($chat, $docta->id);
        $docta->delete();
        DB::commit();

        if (count($chat)) {
            $m =   "Compte supprimé avec succès. Les conversations de ce compte ont été assignées automatiquement aux autres comptes Docta.";
        } else {
            $m =   "Compte supprimé avec succès.";
        }

        return response([
            'success' => true,
            'message' => $m
        ]);
    }
}
