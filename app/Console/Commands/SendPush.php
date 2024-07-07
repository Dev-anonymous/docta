<?php

namespace App\Console\Commands;

use App\Models\Pushnotification;
use Illuminate\Console\Command;

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
        $pend = Pushnotification::all();
        foreach ($pend as $push) {
            if ($push->retry > 10) {
                $push->delete();
            } else {
                $data = json_decode($push->data);
                $ok = false;
                try {
                    $ok = sendMessage($data->token, $data->title, $data->message);
                } catch (\Throwable $th) {
                    // dd($th);
                }
                if ($ok) {
                    $push->delete();
                } else {
                    $push->increment('retry');
                }
            }
        }
        return Command::SUCCESS;
    }
}
