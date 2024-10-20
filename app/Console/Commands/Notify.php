<?php

namespace App\Console\Commands;

use App\Mail\AppMail;
use App\Models\App;
use App\Models\Pushnotification;
use App\Models\Update;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;

class Notify extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify';

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
        $apps = App::all();
        //  [];
        // foreach (App::all() as $el) {
        // if (isapp($el)) {
        // $apps[] = $el;
        // }
        // }

        $notify = $mig = [];
        foreach ($apps as $el) {
            $sol = $el->soldes()->first()->solde_usd;
            if ($sol > 0) {
                $mig[] = $el;
            } else {
                $notify[] = $el;
            }
        }

        foreach ($mig as $el) {
            if (!Update::where('app_id', $el->id)->first()) {
                Update::create(['app_id' => $el->id, 'type' => 'migrate', 'data' => json_encode($el)]);
            }
        }

        foreach ($notify as $el) {
            if (!Update::where('app_id', $el->id)->first()) {
                Update::create(['app_id' => $el->id, 'type' => 'notify', 'data' => json_encode($el)]);
            }
        }

        foreach (Update::all() as $el) {
            $app = App::where('id', $el->app_id)->first();
            $sol = $app->soldes()->first()->solde_usd;
            $sol = v($sol, 'USD');
            if ('migrate' == $el->type) {
                $m = "Cher utilisateur de la plateforme Docta, vous devez désinstaller la version actuelle de l'application Docta, ouvrir Play Store et chercher l'application Docta.
                    Téléchargez l'application directement sur Play Store ou allez sur le site officiel https://www.docta-tam.com et cliquez sur le bouton « Télécharger l'APP ».

                    Cliquez sur ce lien pour télécharger directement l'application : https://play.google.com/store/apps/details?id=com.docta.app

                    UNE FOIS L'APPLICATION TÉLÉCHARGÉ :
                    1.	OUVREZ-LA
                    2.	CLIQUEZ SUR LE BUTTON « Compte » EN BAS, A DROITE DE L'APPLICATION
                    3.	PUIS FAITES UNE CAPTURE D'ÉCRAN ET ENVOYEZ-NOUS CETTE IMAGE SUR CET EMAIL
                    NOUS ALLONS PAR LA SUITE MIGRER VOTRE SOLDE DOCTA DE $sol VERS LA NOUVELLE APPLICATION.

                    ";
            } else {
                $m = "Cher utilisateur de la plateforme Docta, vous devez désinstaller la version actuelle de l'application Docta, ouvrir Play Store et chercher l'application Docta.
                    Téléchargez l'application directement sur Play Store ou allez sur le site officiel https://www.docta-tam.com et cliquez sur le bouton « Télécharger l'APP ».

                    Cliquez sur ce lien pour télécharger directement l'application : https://play.google.com/store/apps/details?id=com.docta.app

                    ";
            }

            if ($app) {
                $title = 'Docta Version PlayStore';
                $pushno = json_encode(['to' => ['app', $app->id], 'title' => $title, 'message' => $m]);
                Pushnotification::create([
                    'data' => $pushno
                ]);
            }

            try {
                $msg['msg'] = $m;
                $msg['subject'] = "Nouvelle Mise à jour Docta";
                if ($app->email) {
                    Mail::to($app->email)->send(new AppMail((object)$msg));
                }
            } catch (\Throwable $th) {
            }
        }
        Artisan::call('sendpush');

        return Command::SUCCESS;
    }
}
