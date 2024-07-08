<?php

namespace App\Http\Middleware;

use App\Models\Forfait;
use App\Models\Taux;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

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
            $forf = Forfait::create(['cout' => 0.008]);
        }
        $taux = Taux::first();
        if (!$taux) {
            $taux = Taux::create(['cdf_usd' => 0.00037, 'usd_cdf' => 2690]);
        }
        completeTrans();
        Artisan::call('sendpush');
        return $next($request);
    }
}
