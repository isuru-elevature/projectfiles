<?php

namespace App\Http\Middleware;

use Closure,Auth;
use Illuminate\Support\Facades\Log;


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

        Log::info('CheckAdmin middleware called. User role: ' . $user->role);

        if($user->role != 'Admin'){
            Log::info('Non-admin user attempted to access an admin route.');
            abort(401);
        }
        return $next($request);
    }
}
