<?php

namespace App\Http\Middleware;

use App\Models\App;
use Closure;
use Illuminate\Http\Request;

class AppMiddleware
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
        $deviceid = $request->header('deviceid');
        $uid = $request->header('uid');

        $app = App::where('uid', $uid)->first();
        if ($app) {
            if ($uid) {
                $app->update(['deviceid' => $deviceid]);
            }
        } else {
            // $app = App::where('uid', $uid)->first();
            // if ($app) {
            //     if ($deviceid) {
            //         $app->update(['deviceid' => $deviceid]);
            //     }
            // } else {
            if (request()->wantsJson()) {
                return response(["message" => "Nah"], 403);
            }
            abort(403);
            // }
        }
        $now = now('Africa/Lubumbashi');
        $app->update(['last_login' => $now]);
        return $next($request);
    }
}
