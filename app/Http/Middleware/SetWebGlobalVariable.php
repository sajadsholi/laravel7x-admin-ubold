<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\View;
use stdClass;

class SetWebGlobalVariable
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

        $global = new stdClass;

        if ($request->isMethod('get')) {



            if ($request->is('*/profile*')) {
            }

            
        }

        View::share('global', $global);

        $global->dir = 'ltr';

        config(['global' => $global]);

        return $next($request);
    }

    private function setMyCookie($name, $value, $min = 525600)
    {
        return Cookie::queue(Cookie::make($name, $value, $min));
    }
}
