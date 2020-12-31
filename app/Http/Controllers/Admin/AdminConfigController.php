<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\Helpers\Timezone;

class AdminConfigController extends Controller
{

    public function index(Request $request)
    {
        $request->validate([
            'adminMode' => 'nullable|numeric|boolean',
            'adminPagin' => 'required|numeric',
            'lockout_time' => 'required|numeric|min:0',
            'language' => 'required',
        ]);

        // change the adminMode
        if (empty($request->adminMode)) {
            $this->setMyCookie('adminMode', 'light');
            $this->setMyCookie('adminAssetPathKey', str_replace('dark', 'light', $request->cookie('adminAssetPathKey')));
        } else {
            $this->setMyCookie('adminMode', 'dark');
            $this->setMyCookie('adminAssetPathKey', str_replace('light', 'dark', $request->cookie('adminAssetPathKey')));
        }


        // change amount of pagination limit
        $this->setMyCookie('adminPagin', $request->adminPagin);

        // update the lockout time
        auth()->guard('admin')->user()->update(
            [
                'lockout_time' => $request->lockout_time
            ]
        );

        // change admin language
        if ($lang = collect(config('global')->language)->where('language', $request->language)->first()) {
            $this->setMyCookie('adminResourceLocale', $lang->language);
            $this->setMyCookie('adminDirection', $lang->direction);
        }


        return back()->with('success', 1);
    }

    public function language(Request $request)
    {
        $request->validate([
            'lang' => 'required',
        ]);

        if (collect(config('global')->language)->where('language', $request->lang)->first()) {

            $this->setMyCookie('adminDataLocale', $request->lang);

            // 
        } else {
            abort(404);
        }
    }


    public function timezone(Request $request)
    {
        $request->validate([
            'timezone' => 'required'
        ]);

        if (!in_array($request->timezone, DateTimeZone::listIdentifiers())) {
            return response([
                'msg' => 'invalid timezone format'
            ], 400);
        }

        Timezone::set($request->timezone);
    }

    private function setMyCookie($name, $value, $min = 525600)
    {
        return Cookie::queue(Cookie::make($name, $value, $min));
    }
}
