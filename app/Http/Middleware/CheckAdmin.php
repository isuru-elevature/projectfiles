<?php

namespace App\Http\Middleware;

use Closure,Auth;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        if($user->role != 'Admin'){
            abort(401);
        }
        return $next($request);
    }
}
