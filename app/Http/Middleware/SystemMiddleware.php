<?php

namespace App\Http\Middleware;

use App\Models\App;
use App\Models\Forfait;
use App\Models\Solde;
use App\Models\Taux;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class SystemMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $forf = Forfait::first();
        if (!$forf) {
            $forf = Forfait::create(['appel' => 0.05, 'sms' => 0.05]);
        }
        $taux = Taux::first();
        if (!$taux) {
            $taux = Taux::create(['cdf_usd' => 0.00037, 'usd_cdf' => 2690]);
        }

        foreach (App::all() as $el) {
            if (!$el->soldes()->first()) {
                $el->soldes()->create(['solde_usd' => 0]);
            }
        }
        assignchat();
        completeTrans();
        Artisan::call('sendpush');
        return $next($request);
    }
}
