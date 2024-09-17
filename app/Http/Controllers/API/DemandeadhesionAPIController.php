<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Mail\AppMail;
use App\Models\Demandeadhesion;
use App\Models\Profil;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class DemandeadhesionAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tab = [];

        foreach (Demandeadhesion::orderBy('id', 'desc')->get() as $el) {
            $o = (object) $el->toArray();
            $o->categorie = $el->categorie->categorie;
            $data = json_decode($el->data);
            $data->age = (new Carbon($data->datenaissance))->diffInYears() . ' ans';
            $o->data = $data;
            $o->date = nnow($el->date);
            $tab[] = $o;
        }
        return $tab;
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
            'email' => 'required|email|unique:users',
            'phone' => 'required|min:10|max:10|unique:users',
            'adresse' => 'required',
            'datenaissance' => 'required|date|before:' . now()->subYears(18),
            'source' => 'required',
            'carteidentite' => 'required|array',
            'carteidentite.*' => 'mimes:pdf|max:1200',
            'image' => 'required|mimes:png,jpeg,jpg|max:500',
            'permistravail' => 'required',
            'travail' => 'required',
            'travailenligne' => 'required',
            'files' => 'required|array',
            'files.*' => 'mimes:pdf|max:1200',
            'langues' => 'required|array',
            'disponibilite' => 'required',
            'forces' => 'required',
            'categorie_id' => 'required|exists:categorie,id',

        ], [
            'permistravail.required' => "Veuillez repondre à la question : Disposez vous d'un permis de travail en RDC ?",
            'travail.required' => "Veuillez repondre à la question : Travaillez vous ?",
            'disponibilite.required' => "Veuillez repondre à la question : Etes-vous disposé à être disponible ... ?",
            'datenaissance.before' => "Date de naissance non valide. vous devez avoir plus de 18 ans."
        ]);

        if ($validator->fails()) {
            $m = implode(" ", $validator->errors()->all());
            return response([
                'message' => $m
            ]);
        }

        $data = $validator->validated();

        $fi = [];
        foreach (request('files') as $file) {
            $fi[] = $file->store('docs', 'public');
        }

        $data['files'] = $fi;
        $fi = [];
        foreach (request('carteidentite') as $file) {
            $fi[] = $file->store('docs', 'public');
        }
        $data['carteidentite'] = $fi;

        $path = request('image')->store('profil', 'public');
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode(file_get_contents(("storage/$path")));
        $data['image'] = $base64;
        File::delete("storage/$path");

        DB::beginTransaction();
        Demandeadhesion::create([
            'valide' => 0,
            'date' => nnow(),
            'categorie_id' => request('categorie_id'),
            'data' => json_encode($data),
        ]);
        $success = false;
        try {
            $user = request('name') . ' ' . request('email') . ' ' . request('phone');
            $m['msg'] = "Une nouvelle demande d'adhésion a été soumise \n\n\n$user";
            $m['subject'] = "Demande d'adhésion";
            Mail::to('contact@docta-tam.com')->send(new AppMail((object)$m));
            $success = true;
        } catch (\Throwable $th) {
            //throw $th;
        }
        try {
            $email = request('email');
            $m['msg'] = "Votre profil sera disponible dans au plus 48h, le temps de finir le traitement et vérification du dossier.\nVous recevrez bientôt les termes du contrat  et les documents qui vous permettront de comprendre les règles de travail avec DOCTA pour fournir une bonne expérience à vos clients.";
            $m['subject'] = "Demande d'adhésion Docta";
            $email = trim($email);
            Mail::to($email)->send(new AppMail((object)$m));
        } catch (\Throwable $th) {
        }

        if (!$success) {
            return response([
                'message' => "Oops, please try again."
            ]);
        }

        DB::commit();

        return response([
            'success' => true,
            'message' => "Votre profil sera disponible dans au plus 48h, le temps de finir le traitement et vérification du dossier.\nVous recevrez bientôt les termes du contrat  et les documents qui vous permettront de comprendre les règles de travail avec DOCTA pour fournir une bonne expérience à vos clients."
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Demandeadhesion  $demandeadhesion
     * @return \Illuminate\Http\Response
     */
    public function show(Demandeadhesion $demandeadhesion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Demandeadhesion  $demandeadhesion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Demandeadhesion $demandeadhesion)
    {
        abort_if($demandeadhesion->valide == 1, 403);

        $pass  = request('pass');

        DB::beginTransaction();

        $data = json_decode($demandeadhesion->data);

        $path = 'profil/' . time() . rand(1000, 90000);
        $data2 = explode(',', $data->image);

        $exe = explode('/', $data2[0])[1];
        $exe = explode(';', $exe)[0];
        $path = "$path.$exe";
        $ifp = fopen("storage/$path", 'wb');
        fwrite($ifp, base64_decode($data2[1]));
        fclose($ifp);

        $user =  User::create([
            'name' => $data->name,
            'email' => $data->email,
            'phone' => $data->phone,
            'user_role' => 'docta',
            'type' => 'externe',
            'password' => Hash::make($pass),
        ]);

        $profil = Profil::create([
            'users_id' => $user->id,
            'categorie_id' => $data->categorie_id,
            'actif' => 0,
            'code' => codemedecin($user->name),
            'image' => $path,
        ]);
        $demandeadhesion->update(['valide' => 1]);
        $success = false;

        try {
            $link = route('web.index', ['docta' => $profil->code]);
            $m['msg'] = "Bienvenu chez Docta, votre profil a été approuvé. Votre lien personnel est $link vous pouvez le partarger à vos patients pour qu'ils entrent directement en contact avec vous. Utilisez l'application mobile pour vous connecter au compte.\n\nEmail : $data->email\nMot de passe : $pass\n\n\n Coordialement.";

            $m['subject'] = "Profil Docta approuvé";
            Mail::to($data->email)->send(new AppMail((object)$m));
            $success = true;
        } catch (\Throwable $th) {
        }

        if (!$success) {
            return response([
                'message' => "Veuillez reessayer SVP."
            ]);
        }
        DB::commit();
        return response([
            'success' => true,
            'message' => "Profil validé avec succès. un email a éte envoyé au docteur."
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Demandeadhesion  $demandeadhesion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Demandeadhesion $demandeadhesion)
    {
        $demandeadhesion->delete();
        // File::delete("storage/$path");


        return response([
            'success' => true,
            'message' => "Demande supprimée avec succès."
        ]);
    }
}
