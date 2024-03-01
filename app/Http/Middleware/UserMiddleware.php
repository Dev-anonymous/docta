<?php

namespace App\Http\Middleware;

use App\Models\App;
use Closure;
use Illuminate\Http\Request;

class UserMiddleware
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
        foreach (App::all() as $el) {
            if (!$el->soldes()->first()) {
                $el->soldes()->create(['solde_usd' => 0]);
            }
        }
        return $next($request);
    }
}
