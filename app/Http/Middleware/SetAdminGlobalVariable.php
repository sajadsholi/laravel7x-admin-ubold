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

        $global->language = Language::latest('is_default')->latest('priority')->with('media')->get();

        // set cookie
        if (!$request->hasCookie('assetPath')) {
            $this->setMyCookie('assetPath', "asset-dark");
        }
        if (!$request->hasCookie('mode')) {
            $this->setMyCookie('mode', 'dark');
        }
        if (!$request->hasCookie('pagin')) {
            $this->setMyCookie('pagin', 15);
        }
        if (!$request->hasCookie('dir')) {
            $this->setMyCookie('dir', $global->language->where('is_default', 1)->first()->direction);
        }
        if (!$request->hasCookie('adminLang')) {
            $this->setMyCookie('adminLang', $global->language->where('is_default', 1)->first()->language);
        }
        if (!$request->hasCookie('lang')) {
            $this->setMyCookie('lang', $global->language->where('is_default', 1)->first()->language);
        }

        $global->assetPath = asset('asset') . "/admin/" . $request->cookie('assetPath') . '-' . $request->cookie('dir');
        $global->mode = $request->cookie('mode');
        $global->pagin = $request->cookie('pagin');
        $global->dir = $request->cookie('dir');
        $global->adminLang = $request->cookie('adminLang');
        $global->lang = $request->cookie('lang');

        config(['app.locale' => $global->adminLang]);

        config(['translatable.locales' => $global->language->pluck('language')->toArray()]);
        config(['translatable.locale' => $global->lang]);
        config(['translatable.fallback_locale' => $global->language->where('is_default', 1)->first()->language]);

        $global->defaultAvatar = asset('asset') . '/defaultAvatar.png';
        $global->defaultLogo = asset('asset') . '/defaultLogo.png';
        $global->noImage = asset('asset') . '/noImage.png';
    }


    private function setMyCookie($name, $value, $min = 525600)
    {
        return Cookie::queue(Cookie::make($name, $value, $min));
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
