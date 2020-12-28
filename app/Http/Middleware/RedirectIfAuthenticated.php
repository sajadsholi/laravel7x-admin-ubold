<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {

        if ($request->is('admin*') && $guard == 'admin' && Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard.index');
        }

        if (!$request->is('admin*') && $guard == 'web' && Auth::guard('web')->check()) {
            // return redirect()->route('web.profile.index');
        }

        return $next($request);
    }
}
