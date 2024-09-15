<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Profil;
use App\Models\Pushnotification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
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
            $label = 'Déconnecté';
            $actif = "<b style='cursor:pointer' class='badge badge-danger text-white'> <i class='fa fa-wifi'></i> DECONNECTE</b>";

            if ($el->derniere_connexion) {
                $n = $el->derniere_connexion->diffInDays();

                $isco = isconnected($el->derniere_connexion);

                if ($isco->ok) {
                    $label = 'Connecté';
                    $actif =
                        "<b style='cursor:pointer' class='badge badge-success text-white'> <i class='fa fa-wifi'></i> CONNECTE</b>";
                } else {
                    if ($isco->days >= 8) {
                        $label = $isco->label;
                        $actif =
                            "<b style='cursor:pointer' class='badge badge-info'> <i class='fa fa-check-circle'></i> ACTIF</b>";
                    }
                }
                $actif .= "<br><i>$isco->label</i>";
            }
            $o->label = $label;
            $o->actif = $actif;
            $chat = $el->chats();
            $c = $chat->count();
            $ma =  Message::whereIn('chat_id', $chat->pluck('id')->all())->where('fromuser', 1)->count();
            $mr =  Message::whereIn('chat_id', $chat->pluck('id')->all())->where('fromuser', 0)->count();
            $o->conversation = $c;
            $o->messageenvoye = $ma;
            $o->messagerecu = $mr;
            $sold = @$el->profils()->first()?->solde;
            $o->solde = "$ " . @number_format($sold, 3, '.', ' ');
            $o->categorie_id = @$el->profils()->first()->categorie_id;
            $o->bio = @$el->profils()->first()->bio;
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
            'phone' => 'required|min:10|max:10|unique:users',
            'pass' => 'required',
            'type' => 'required|in:interne,externe',
            'categorie_id' => 'required|exists:categorie,id',
            'file' => 'sometimes|mimes:pdf|max:1500',
            'image' => 'sometimes|mimes:png,jpg,jpeg|max:1500',
            'bio' => 'sometimes|max:255',
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
        if (request()->has('file')) {
            $data['file'] = request('file')->store('docs', 'public');
        }
        if (request()->has('image')) {
            $data['image'] = request('image')->store('profil', 'public');
        }

        DB::beginTransaction();
        $user =  User::create($data);
        $data['users_id'] = $user->id;
        $data['code'] = codemedecin($user->name);
        $profil = Profil::create($data);
        DB::commit();

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
    public function show(User $docta)
    {
        $profi = $docta->profils()->first();
        $img = $profi?->image;

        if (!$img) {
            $img = asset('images/doc.jpg');
        } else {
            $img = asset('storage/' . $img);
        }
        $sold = @$docta->profils()->first()?->solde;
        $solde = "$ " . @number_format($sold, 3, '.', ' ');
        $status = '-';
        $validto = $profi?->validto?->format('d-m-Y') ?? '-';
        if ($docta->type == 'interne') {
            $validto = '-';
            $status = '-';
        } else {
            $status = $docta->actif ? '<span class="badge badge-success badge-pill">ACTIF</span>' : '<span class="badge badge-danger badge-pill">INACTIF</span>';
        }

        $do = '';
        if ($profi?->file) {
            $h = asset('storage/' . $profi->file);
            $do = "<a href='$h' target='_blank'><i class='fa fa-file'></i></a>";
        }

        $data['profil'] = [
            'name' => ucwords($docta->name),
            'email' => $docta->email ?? '-',
            'phone' => $docta->phone ?? '',
            'image' => $img,
            'solde' => $solde,
            'type' => $docta->type,
            'categorie' => $profi?->categorie->categorie,
            'finabonnement' => $validto,
            'status' => $status,
            'bio' => $profi->bio ?? '-',
            'dossier' => $do,
            'code' => $profi?->code,
        ];

        $trans = $profi?->transferts()->orderBy('id', 'desc')->get();
        $tt = [];
        foreach ($trans ?? [] as $el) {
            $o = (object) $el->toArray();
            $o->montant = "$ " . @number_format($el->montant, 3, '.', ' ');
            $o->date = $el->date->format('d-m-Y');
            $tt[] = $o;
        }
        $trans = $tt;
        $data['transfert'] = $trans;

        $chat = $docta->chats();
        $c = $chat->count();

        $ma =  Message::whereIn('chat_id', $chat->pluck('id')->all())->where('fromuser', 1)->count();
        $mr =  Message::whereIn('chat_id', $chat->pluck('id')->all())->where('fromuser', 0)->count();

        $data['message'] = [
            'client' => $c,
            'messageenvoye' => $ma,
            'messagerecu' => $mr,
        ];

        return $data;
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
            'phone' => 'required|min:10|max:10|unique:users,phone,' . $docta->id,
            'pass' => 'sometimes',
            'categorie_id' => 'required|exists:categorie,id',
            'file' => 'sometimes|mimes:pdf|max:1500',
            'image' => 'sometimes|mimes:png,jpg,jpeg|max:1500',
            'bio' => 'sometimes|max:255',
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

        DB::beginTransaction();
        $profil = $docta->profils()->first();
        if (request()->has('file')) {
            File::delete('storage/' . $profil->file);
            $data['file'] = request('file')->store('docs', 'public');
        }
        if (request()->has('image')) {
            File::delete('storage/' . $profil->image);
            $data['image'] = request('image')->store('profil', 'public');
        }

        $docta->update($data);
        $profil->update($data);
        DB::commit();

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
