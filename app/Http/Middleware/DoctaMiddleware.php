<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoctaMiddleware
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
        $user = auth()->user();
        if ('docta' != $user->user_role) {
            $user->tokens()->delete();
            abort(401, "Docta Only");
        }

        $actif = $user->profils()->first()?->actif;
        abort_if(1 != $actif and 'externe' == $user->type, 403, 'Profil non actif');

        $user->update(['derniere_connexion' => now('Africa/Lubumbashi')]);
        return $next($request);
    }
}
