<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;

class PasswordExpired
{

    public function handle($request, Closure $next)
    {
        $user = $request->user();
        $password_changed_at = new Carbon(($user->password_changed_at) ? $user->password_changed_at : $user->created_at);

        
    #    if (Carbon::now()->diffInDays($password_changed_at) >= config('auth.password_expires_days')) {
        if (Carbon::now()->diffInDays($password_changed_at) >= 60|| $user->password_changed_at = NULL ) {
            return redirect()->route('password.expired');
        }
    #    echo "the diff is ".Carbon::now()->diffInDays($password_changed_at); 
        return $next($request);
    }
}

