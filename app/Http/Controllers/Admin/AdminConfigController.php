<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class AdminConfigController extends Controller
{

    public function index(Request $request)
    {
        $request->validate([
            'mode' => 'nullable|numeric|boolean',
            'pagin' => 'required|numeric',
            'language' => 'required',
        ]);

        // change the mode
        if (empty($request->mode)) {
            $this->setMyCookie('mode', 'light');
            $this->setMyCookie('assetPath', str_replace('dark', 'light', $request->cookie('assetPath')));
        } else {
            $this->setMyCookie('mode', 'dark');
            $this->setMyCookie('assetPath', str_replace('light', 'dark', $request->cookie('assetPath')));
        }


        // change amount of pagination limit
        $this->setMyCookie('pagin', $request->pagin);

        // update the lockout time
        auth()->guard('admin')->user()->update(
            $request->validate([
                'lockout_time' => 'required|numeric|min:0'
            ])
        );

        // change admin language
        if ($lang = config('global')->language->where('language', $request->language)->first()) {
            $this->setMyCookie('adminLang', $lang->language);
            $this->setMyCookie('dir', $lang->direction);
        }


        return back()->with('success', 1);
    }

    public function language(Request $request)
    {
        $request->validate([
            'lang' => 'required',
        ]);

        if (config('global')->language->where('language', $request->lang)->first()) {

            $this->setMyCookie('lang', $request->lang);

            // 
        } else {
            abort(404);
        }
    }

    private function setMyCookie($name, $value, $min = 525600)
    {
        return Cookie::queue(Cookie::make($name, $value, $min));
    }
}
