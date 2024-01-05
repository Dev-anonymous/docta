<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\App;
use App\Models\Chat;
use App\Models\Message;
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
}
