<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\App;
use App\Models\Chat;
use App\Models\Forfait;
use App\Models\Message;
use App\Models\Solde;
use DateTime;
use Illuminate\Support\Facades\Validator;

class AppController extends Controller
{
    public function uid()
    {
        $uid = request('uid');
        if (!$uid) {
            $uid =  makeRand("USER-");
        }
        $app = App::where('uid', $uid)->first();
        $now = now('Africa/Lubumbashi');
        if (!$app) {
            while (1) {
                $app = App::where('uid', $uid)->first();
                if ($app) {
                    $uid =  makeRand("USER-");
                } else {
                    break;
                }
            }
            App::create(['uid' => $uid, 'date' => $now, 'last_login' => $now]);
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
        $validator = Validator::make(request()->all(), [
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

        $app = userapp();

        $chat = $app->chats()->first();
        if (!$chat) {
            $chat = Chat::create(['app_id' => $app->id, 'date' => now('Africa/Lubumbashi')]);
        }

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
        Message::create($data);

        return response()->json([
            'success' => true,
            'message' => "Saved"
        ]);
    }

    public function getmessage()
    {
        $app = userapp();
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
        return response()->json([
            'success' => true,
            'message' => '',
            'data' => $messages
        ]);
    }

    public function received()
    {
        $data = explode(',', request('data'));
        $data = array_filter($data);
        Message::whereIn('id', $data)->update(['sent' => 1]);
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
        if (!$forf) {
            $forf = Forfait::create(['cout' => 0.008]);
        }

        $sol = number_format($solde->solde_usd, 3, '.', ' ');
        $fac = number_format($forf->cout, 3, '.', ' ');

        $data = ['solde' => $sol, 'facturation' => $fac];
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


    // docta admin
    public function getchat()
    {
        /** @var $user App\Models\Usere **/
        $user = auth()->user();
        $chat = $user->chats()->orderBy('id', 'desc')->with('app');

        $chatClone = clone $chat;
        $chatid = $chatClone->pluck('id')->all();
        $chats = $chat->get();
        // $chats = $chat->where(['sent' => 0])->get();

        $messages = [];
        $d = Message::where(['senttouser' => 0])->whereIn('chat_id', $chatid)->get();
        foreach ($d as $dd) {
            $mm = $dd->toArray();
            $mm['date'] = $dd->date->format('Y-m-d H:i:s');
            $messages[] = $mm;
        }

        return response([
            'success' => true,
            'message' => "",
            'data' => compact('chats', 'messages')
        ]);
    }

    public function received2()
    {
        $data = explode(',', request('data'));
        $data = array_filter($data);
        Message::whereIn('id', $data)->update(['senttouser' => 1]);
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

        $message = request('message');
        $date = request('date');
        $file = request('file');

        $data = compact('message', 'date');
        $data['type'] = $file ? 'file' : 'text';
        $data['file'] = $file;
        $data['appread'] = 1;
        $data['fromuser'] = 1;
        $data['username'] = $user->name;
        $data['chat_id'] = request('chat_id');
        Message::create($data);

        return response()->json([
            'success' => true,
            'message' => "Saved"
        ]);
    }
}
