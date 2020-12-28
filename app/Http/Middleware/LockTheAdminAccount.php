<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class LockTheAdminAccount
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

        if(env('APP_ENV') == 'local'){
            return $next($request);
        }

        $admin = Auth::guard('admin')->user();

        // If the user does not have this feature enabled, then just return next.
        if (!$admin->hasLockoutTime()) {
            // Check if previous session was set, if so, remove it because we don't need it here.
            if (session('lock-expires-at')) {
                session()->forget('lock-expires-at');
            }

            return $next($request);
        }

        if ($lockExpiresAt = session('lock-expires-at')) {
            if ($lockExpiresAt < now()) {
                return redirect()->route('admin.locked');
            }
        }


        session(['lock-expires-at' => now()->addMinutes($admin->getLockoutTime())]);

        return $next($request);
    }
}
