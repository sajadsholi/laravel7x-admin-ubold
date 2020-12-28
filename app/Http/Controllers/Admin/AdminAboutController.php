<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Permission;
use App\Http\Controllers\Controller;
use App\Model\About;
use Illuminate\Http\Request;

class AdminAboutController extends Controller
{

    public function index()
    {
        abort_if(!Permission::can('aboutUs'), 403);

        return view('admin.about.index', [
            'about' => About::with('translations')->find(1),
            'breadcrumb' => [
                [
                    'name' => __('common.settings'),
                    'link' => 'javascript:void();',
                    'isLatest' => 0
                ],
                [
                    'name' => __('aboutUs.singular'),
                    'link' => route('admin.about.index'),
                    'isLatest' => 1
                ],
            ]
        ]);
    }

    public function store(Request $request)
    {
        abort_if(!Permission::can('aboutUs'), 403);

        if (empty(About::first())) {

            config(['translatable.locale' => config('global')->language->where('is_default', 1)->first()->language]);

            // 
        }

        About::updateOrCreate(
            ['id' => 1],
            $request->validate([
                'content' => 'required'
            ])
        );

        return back()->with('success', 1);
    }
}
