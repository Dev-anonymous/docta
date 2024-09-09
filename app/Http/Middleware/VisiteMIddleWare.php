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

        $ua = strtolower($usera);

        if (
            !(strpos($ua, 'www.facebook.com') !== false or strpos($ua, 'googlebot') !== false)
            or strpos($ua, 'dataprovider.com') !== false
        ) {
            $ex = Visite::where(['ip' => $ip, 'url' => $url])->first();
            if ($ex) {
                $ex->increment('nb');
                $ex->update(['date' => $date]);
            } else {
                Visite::create(['ip' => $ip, 'nb' => 1, 'useragent' => $usera, 'url' => $url, 'date' => $date]);
            }
        }
        return $next($request);
    }
}
