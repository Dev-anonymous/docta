<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\App;
use App\Models\Chat;
use App\Models\Conseilmedical;
use App\Models\Errorlog;
use App\Models\Forfait;
use App\Models\Message;
use App\Models\Pushnotification;
use App\Models\Solde;
use App\Models\User;
use App\Models\Zego;
use DateTime;
use Illuminate\Support\Facades\Validator;

class AppController extends Controller
{
    function error()
    {
        $err = request('error');
        $now = now('Africa/Lubumbashi');
        if (is_string($err) and $err) {
            Errorlog::create(['date' => $now, 'data' => $err]);
        }
    }
    public function uid()
    {
        $now = now('Africa/Lubumbashi');
        $deviceid = request('deviceid');
        if (!$deviceid) {
            abort(403);
        }
        $uid = request('uid');
        if (!$uid) {
            $uid =  makeRand("USER-");
            while (1) {
                $t = App::where('uid', $uid)->first();
                if ($t) {
                    $uid =  makeRand("USER-");
                } else {
                    break;
                }
            }
        }
        $app = App::where('deviceid', $deviceid)->first();
        if (!$app) {
            $app = App::create(['deviceid' => $deviceid, 'uid' => $uid, 'date' => $now, 'last_login' => $now]);
        } else {
            $app->update(['last_login' => $now]);
        }

        return response()->json([
            'success' => true,
            'message' => "Welcome $uid",
            'data' => compact('uid')
        ]);
    }

    public function message()
    {
        canmessage();
        $app = userapp();
        $chat = $app->chats()->first();

        $validator = Validator::make(request()->all(), [
            'id' => 'required',
            'message' => 'required',
            'file' => 'sometimes',
            'date' => 'required:date'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->all()
            ]);
        }

        $chat = $app->chats()->first();
        if (!$chat) {
            $chat = Chat::create(['app_id' => $app->id, 'date' => now('Africa/Lubumbashi')]);
        }

        $id = request('id');
        $chat_id = request('chat_id');

        $r = Message::where(['local_id' => $id, 'chat_id' => $chat_id, 'fromuser' => 0])->first();
        if (!$r) {
            $message = request('message');
            $date = request('date');
            $file = request('file');

            $data = compact('message', 'date');

            $data['type'] = $file ? 'file' : 'text';
            $data['file'] = $file;
            $data['appread'] = 1;
            $data['fromuser'] = 0;
            $data['username'] = $app['nom'] ?? $app['uid'];
            $data['chat_id'] = $chat->id;
            $data['local_id'] = $id;
            Message::create($data);

            $user = $chat->user;
            if ($user) {
                $title = $app->nom ? ucfirst($app->nom) : $app->uid;
                $pushno = json_encode(['token' => $user->fcmtoken, 'title' => $title, 'message' => $message]);
                Pushnotification::create([
                    'data' => $pushno
                ]);
            }
        }

        $solde = $app->soldes()->first();
        $forf = Forfait::first();
        $sms = @$forf->sms;
        $newsol = (float) @$solde->solde_usd - (float) $sms;
        if ($newsol < 0) $newsol = 0;
        $solde->update(['solde_usd' => $newsol]);

        $sol = number_format($newsol, 3, '.', ' ');
        $sms = number_format($forf->sms, 3, '.', ' ');
        $appel = number_format($forf->appel, 3, '.', ' ');

        $data = ['solde' => $sol, 'sms' => $sms, 'appel' => $appel];

        return response()->json([
            'success' => true,
            'message' => "Saved",
            'data' => $data,
        ]);
    }

    public function getmessage()
    {
        $app = userapp();
        $fcmtoken = request('fcmtoken');
        if ($fcmtoken) {
            if ($app->fcmtoken != $fcmtoken) {
                $app->update(['fcmtoken' => $fcmtoken]);
            }
        }
        $chat = $app->chats()->first();

        $messages = [];
        if ($chat) {
            $messages = $chat->messages()->where(['fromuser' => 1, 'sent' => 0])->get();
            $tmp = [];
            foreach ($messages as $el) {
                $d['id'] = $el->id;
                $d['date'] = $el->date->format('Y-m-d H:i:s');
                $d['message'] = $el->message;
                $d['username'] = $el->username;
                $d['file'] = $el->file;
                $tmp[] = $d;
            }
            $messages = $tmp;
        }

        $conseil = Conseilmedical::orderBy('id')->get();
        $docta = User::where('user_role', 'docta')->orderBy('derniere_connexion', 'desc')->pluck('id')->all();
        $zego = Zego::first();

        $userread = Message::where(['chat_id' => @$chat->id, 'fromuser' => 0, 'userread' => 0])->first();

        return response()->json([
            'success' => true,
            'message' => '',
            'data' => [
                'message' => $messages,
                'markhasread' => !(bool) $userread,
                'conseils' => $conseil,
                'docta' => $docta,
                'zego' => $zego,
            ]
        ]);
    }

    public function received()
    {
        $data = explode(',', request('data'));
        $data = array_filter($data);
        Message::whereIn('id', $data)->update(['sent' => 1]);

        $m = Message::whereIn('id', $data)->get();
        foreach ($m as $mes) {
            $chat_id = $mes->chat_id;
            Message::where('chat_id', $chat_id)->update(['appread' => 1]);
        }

        return response()->json([
            'success' => true,
            'message' => '',
            'data' => $data
        ]);
    }

    public function solde()
    {
        $app = userapp();
        $solde = $app->soldes()->first();
        if (!$solde) {
            $solde = $app->soldes()->create(['solde_usd' => 0]);
        }

        $forf = Forfait::first();

        $sol = number_format($solde->solde_usd, 3, '.', ' ');
        $sms = number_format($forf->sms, 3, '.', ' ');
        $appel = number_format($forf->appel, 3, '.', ' ');

        $data = ['solde' => $sol, 'sms' => $sms, 'appel' => $appel];
        return response()->json([
            'success' => true,
            'message' => '',
            'data' => $data
        ]);
    }

    public function profil()
    {
        $app = userapp();
        $validator = Validator::make(request()->all(), [
            'telephone' => 'required|max:30|unique:app,telephone,' . $app->id,
            'nom' => 'required|max:30',
            'email' => 'sometimes|email|max:30'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => implode(', ', $validator->errors()->all())
            ]);
        }

        $tel = request('telephone');
        $tel = "+" . ((int) $tel);
        $ok = preg_match('/(\+24390|\+24399|\+24397|\+24398|\+24380|\+24381|\+24382|\+24383|\+24384|\+24385|\+24389)[0-9]{7}/', $tel);

        if (!$ok) {
            $m = "Le numéro $tel est invalide";
            return response([
                'success' => false,
                'message' => $m
            ]);
        }

        $d = $validator->validated();
        $app->update($d);
        return response([
            'success' => true,
            'message' => "Votre profil a été enregistré."
        ]);
    }

    function payhistorique()
    {
        $app = userapp();
        $tab = [];
        foreach ($app->paiements()->orderBy('id', 'desc')->get() as $el) {
            $o = (object)[];
            $o->ref = $el->ref;
            $o->montant = number_format($el->montant, 2, '.', ' ') . " $el->devise";
            $o->date = $el->date->format('d-m-Y H:i:s');
            $o->methode = $el->methode;
            $tab[] = $o;
        }
        return response([
            'success' => true,
            'message' => "",
            'data' => $tab,
        ]);
    }


    // docta admin
    public function getchat()
    {
        $historique = (array) @json_decode(request('historique'));

        foreach ($historique as $uid => $hist) {
            $app = App::where('uid', $uid)->first();
            if ($app) {
                $sec = array_sum($hist);
                $forf = Forfait::first();
                $cout =  $sec * $forf->appel;
                if ($cout) {
                    $soldOb = $app->soldes()->first();
                    $newsolde = (float) ((float) $soldOb->solde_usd - $cout);
                    if ($newsolde < 0) {
                        $newsolde = 0;
                    }
                    $soldOb->update(['solde_usd' => $newsolde]);
                }
            }
        }

        $emptychat = Chat::whereNull('users_id')->get();
        $users = User::where('user_role', 'docta')->pluck('id')->all();
        foreach ($emptychat as $el) {
            $u = $users[array_rand($users)];
            $el->update(['users_id' => $u]);
        }

        /** @var $user App\Models\Usere **/
        $user = auth()->user();

        $fcmtoken = request('fcmtoken');
        if ($fcmtoken) {
            if ($user->fcmtoken != $fcmtoken) {
                $user->update(['fcmtoken' => $fcmtoken]);
            }
        }

        $chat = $user->chats()->orderBy('id', 'desc')->with('app');

        $chatClone = clone $chat;
        $chatid = $chatClone->pluck('id')->all();
        $chats = $chat->where(['sent' => 0])->get();

        $messages = [];
        $d = Message::where(['senttouser' => 0, 'fromuser' => 0])->whereIn('chat_id', $chatid)->get();
        foreach ($d as $dd) {
            $mm = $dd->toArray();
            $mm['date'] = $dd->date->format('Y-m-d H:i:s');
            $messages[] = $mm;
        }

        $apps = App::all();
        $soldes = [];
        foreach ($apps as $el) {
            $sol = (float) @$el->soldes()->first()->solde_usd;
            $uid = $el->uid;
            $soldes[$uid] = round($sol, 3);
        }

        $zego = Zego::first();

        $forf = Forfait::first();
        $coutappel =  $forf->appel;

        $appread = [];
        foreach ($user->chats()->get() as $c) {
            $ap = Message::where(['chat_id' => $c->id, 'fromuser' => 1, 'appread' => 0])->first();
            if (!$ap) {
                $historique = (array) @json_decode(request('historique'));
                $appread[] = $c->id;
            }
        }

        $conseils = Conseilmedical::orderBy('id')->get();

        return response([
            'success' => true,
            'message' => "",
            'data' => compact('chats', 'appread', 'messages', 'zego', 'soldes', 'coutappel', 'conseils')
        ]);
    }

    public function received2()
    {
        $data = explode(',', request('data'));
        $data = array_filter($data);
        Message::whereIn('id', $data)->update(['senttouser' => 1]);

        $m = Message::whereIn('id', $data)->get();
        foreach ($m as $mes) {
            $chat_id = $mes->chat_id;
            Message::where('chat_id', $chat_id)->update(['userread' => 1]);
        }

        return response()->json([
            'success' => true,
            'message' => '',
            'data' => $data
        ]);
    }
    public function chatreceived()
    {
        $data = explode(',', request('data'));
        $data = array_filter($data);
        Chat::whereIn('id', $data)->update(['sent' => 1]);
        return response()->json([
            'success' => true,
            'message' => '',
            'data' => $data
        ]);
    }

    public function postmessage()
    {
        $validator = Validator::make(request()->all(), [
            'chat_id' => 'required|exists:chat,id',
            'id' => 'required',
            'message' => 'required',
            'file' => 'sometimes',
            'date' => 'required:date'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->all()
            ]);
        }

        $user = auth()->user();

        $id = request('id');
        $chat_id = request('chat_id');

        $r = Message::where(['local_id' => $id, 'chat_id' => $chat_id, 'fromuser' => 1])->first();
        if (!$r) {
            $message = request('message');
            $date = request('date');
            $file = request('file');

            $data = compact('message', 'date');

            $data['type'] = $file ? 'file' : 'text';
            $data['file'] = $file;
            $data['appread'] = 0;
            $data['fromuser'] = 1;
            $data['username'] = $user->name;
            $data['chat_id'] = $chat_id;
            $data['local_id'] = $id;
            Message::create($data);

            $chat = Chat::where('id', $chat_id)->first();
            if ($chat) {
                $app = $chat->app;
                if ($app) {
                    $title = 'Docta';
                    $pushno = json_encode(['token' => $app->fcmtoken, 'title' => $title, 'message' => $message]);
                    Pushnotification::create([
                        'data' => $pushno
                    ]);
                }
            }
        }

        return response()->json([
            'success' => true,
            'message' => "Saved"
        ]);
    }
}
