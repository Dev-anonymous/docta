<?php

namespace App\Console\Commands;

use App\Models\App;
use App\Models\Pushnotification;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class SendPush extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sendpush';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        DB::transaction(function () {
            $pend = Pushnotification::lockForUpdate()->get();
            foreach ($pend as $push) {
                if ($push->retry > 1000) {
                    $push->delete();
                } else {
                    $data = json_decode($push->data);
                    $ok = false;
                    try {
                        $ob = null;
                        $to = $data->to;
                        $payload = (object) @$data->payload;
                        if (@$to[0] == 'user') {
                            $ob = User::where('id', @$to[1])->first();
                        }
                        if (@$to[0] == 'app') {
                            $ob = App::where('id', @$to[1])->first();
                        }
                        if ($ob) {
                            $ok = sendMessage(@$ob->fcmtoken, $data->title, $data->message, $payload);
                            if ($ok === 0) {
                                $payload = (object) ['type' => 'bigmessage'];
                                $ok = sendMessage(@$ob->fcmtoken, $data->title, $data->message, $payload);
                            }
                        }
                    } catch (\Throwable $th) {
                        // dd($th);
                    }
                    if ($ok === true) {
                        $push->delete();
                    } else {
                        $push->increment('retry');
                    }
                }
            }
        });

        return Command::SUCCESS;
    }
}
