<?php

namespace App\Http\Middleware;

use App\Models\Visite;
use Closure;
use Illuminate\Http\Request;

class VisiteMIddleWare
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

        $ip = request()->ip();
        $usera = request()->userAgent();
        $date = now('Africa/Lubumbashi');
        $url = request()->path();

        $ex = Visite::where(['ip' => $ip, 'url' => $url])->first();
        if ($ex) {
            $ex->increment('nb');
            $ex->update(['date' => $date]);
        } else {
            Visite::create(['ip' => $ip, 'nb' => 1, 'useragent' => $usera, 'url' => $url, 'date' => $date]);
        }
        return $next($request);
    }
}