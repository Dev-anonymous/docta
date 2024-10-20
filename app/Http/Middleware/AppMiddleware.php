<?php

namespace App\Http\Middleware;

use App\Mail\AppMail;
use App\Models\App;
use App\Models\Duplicated;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
        $devicename = $request->header('Device-name');
        $appversion = $request->header('App-version');
        $uid = $request->header('uid');

        if (strpos($uid, 'BROWSER-') !== false) {
            $devicename = request()->userAgent();
        }

        $app = App::where('uid', $uid)->first();
        if ($app) {
            if ($app->deviceid != $deviceid and $deviceid) {
                $send = false;
                try {
                    Duplicated::create(['uid' => $uid, 'deviceid' => $deviceid, 'date' => now('Africa/Lubumbashi')]);
                    $send = true;
                } catch (\Throwable $th) {
                }

                if ($send) {
                    try {
                        $m['user'] = "DeviceID : $deviceid | Uid : $uid";
                        $m['msg'] = "Duplicated\n\n\nApp DeviceID : {$app->deviceid} != Request DeviceID : $deviceid\n\n\n";
                        $m['subject'] = "[DUPLICATED] ";
                        Mail::to('contact@docta-tam.com')->send(new AppMail((object)$m));
                    } catch (\Throwable $th) {
                    }
                }
                abort(403, 'duplicated');
            }
            if ($deviceid) {
                $app->update(['deviceid' => $deviceid]);
            }
        } else {
            $app = App::where('deviceid', $deviceid)->first();
            if ($app) {
                if ($app->uid != $uid and $uid) {
                    $send = false;
                    try {
                        Duplicated::create(['uid' => $uid, 'deviceid' => $deviceid, 'date' => now('Africa/Lubumbashi')]);
                        $send = true;
                    } catch (\Throwable $th) {
                    }

                    if ($send) {
                        try {
                            $m['user'] = "DeviceID : $deviceid | Uid : $uid";
                            $m['msg'] = "Duplicated\n\n\nApp Uid : {$app->uid} != Request Uid : $uid\n\n\n";
                            $m['subject'] = "[DUPLICATED]";
                            Mail::to('contact@docta-tam.com')->send(new AppMail((object)$m));
                        } catch (\Throwable $th) {
                        }
                    }
                    abort(403, 'duplicated');
                }
                if ($uid) {
                    $app->update(['uid' => $uid]);
                }
            } else {
                if (request()->wantsJson()) {
                    return response(["message" => "Nah"], 403);
                }
                abort(403);
            }
        }
        $now = now('Africa/Lubumbashi');
        $app->update(['last_login' => $now, 'devicename' => ucfirst($devicename), 'appversion' => $appversion]);

        abort_if($app->blocked == 1, 403, "App Version not valid");

        return $next($request);
    }
}
