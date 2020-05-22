<?php

namespace Matthv\Skeletor\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){

		if (Auth::guard(config('skeletor.middleware_auth'))->check()){
			return $next($request);
		}

		return redirect()->route('skeletor.auth.login')->with('error', 'Désolé, vous n\'avez pas les autorisations requises pour accéder à cette page. Merci de vous authentifier');
    }
}
