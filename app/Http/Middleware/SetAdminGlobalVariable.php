<?php

namespace App\Http\Middleware;

use App\Model\Language;
use App\Model\Setting;
use App\Model\Support;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\View;
use stdClass;

class SetAdminGlobalVariable
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

        $this->setConfig($global, $request);


        // get data from database
        if (!$request->is('admin/login') && $request->isMethod('get')) {
            // support
            $global->pendingTicket = Support::where('status_id', 1)->latest()->with('user')->get();

            // user avatar
            $global->userAvatar = Auth::guard('admin')->user()->getMedium();
        }


        // get the settings and map them
        $global->setting = Setting::all();
        $global->setting->map(function ($item, $key) use ($global) {

            $global->setting->{$item->key} = $this->isJson($item->value);

            return $item;
        });


        View::share('global', $global);

        config(['global' => $global]);


        return $next($request);
    }


    private function setConfig($global, $request)
    {

        // get languages from database
        $global->language = Language::latest('is_default')
            ->latest('priority')
            ->with('media')
            ->get();

        // set cookies and global variables
        $global->adminPagin = (!$request->hasCookie('adminPagin')) ? $this->setMyCookie('adminPagin', 15) : $request->cookie('adminPagin');
        $global->adminMode = (!$request->hasCookie('adminMode')) ? $this->setMyCookie('adminMode', 'dark') : $request->cookie('adminMode');
        $global->adminDirection = (!$request->hasCookie('adminDirection')) ? $this->setMyCookie('adminDirection', collect($global->language)->where('is_default', 1)->first()->direction) : $request->cookie('adminDirection');
        $global->adminAssetPathKey = (!$request->hasCookie('adminAssetPathKey')) ? $this->setMyCookie('adminAssetPathKey', 'asset-dark') : $request->cookie('adminAssetPathKey');
        $global->assetPath = asset("asset") . "/admin/" . $global->adminAssetPathKey . "-" . $global->adminDirection;
        $global->adminResourceLocale = (!$request->hasCookie('adminResourceLocale')) ? $this->setMyCookie('adminResourceLocale', collect($global->language)->where('is_default', 1)->first()->language) : $request->cookie('adminResourceLocale');
        $global->adminDataLocale = (!$request->hasCookie('adminDataLocale')) ? $this->setMyCookie('adminDataLocale', collect($global->language)->where('is_default', 1)->first()->language) : $request->cookie('adminDataLocale');
        $global->timezone = optional($request->user())->timezone ?? 'UTC';
        $global->defaultAvatar = asset('asset') . '/defaultAvatar.png';
        $global->defaultLogo = asset('asset') . '/defaultLogo.png';
        $global->noImage = asset('asset') . '/noImage.png';

        config(['app.locale' => $global->adminResourceLocale]);
        config(['translatable.locales' => collect($global->language)->pluck('language')->toArray()]);
        config(['translatable.locale' => $global->adminDataLocale]);
        config(['translatable.fallback_locale' => collect($global->language)->where('is_default', 1)->first()->language]);
    }


    private function setMyCookie($name, $value, $min = 525600)
    {
        Cookie::queue(Cookie::make($name, $value, $min));
        return $value;
    }

    private function isJson($value)
    {
        json_decode($value);
        if (json_last_error() == JSON_ERROR_NONE) {
            return json_decode($value);
        }
        return $value;
    }
}
