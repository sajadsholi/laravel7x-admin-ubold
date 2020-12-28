<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Permission;
use App\Http\Controllers\Controller;
use App\Model\Setting;
use Illuminate\Http\Request;

class AdminSettingsController extends Controller
{

    public function index()
    {

        abort_if(!Permission::can('generalSettings'), 403);

        return view('admin.settings.general.index', [
            'breadcrumb' => [
                [
                    'name' => __('common.settings'),
                    'link' => 'javascript:void();',
                    'isLatest' => 0
                ],
                [
                    'name' => __('common.generalSettings'),
                    'link' => route('admin.settings.index'),
                    'isLatest' => 1
                ],
            ]
        ]);
    }

    public function store(Request $request)
    {
        abort_if(!Permission::can('generalSettings'), 403);

        $request->validate([
            'name' => 'required|max:255',
            'image.path' => 'required'
        ]);

        config('global')->setting->first()->updateMedia($request->image);

        $logo = config('global')->setting->first()->getMedium();

        batch()->update(
            new Setting,
            [
                [
                    'key' => 'logo',
                    'value' => json_encode($logo)
                ],
                [
                    'key' => 'name',
                    'value' => $request->name
                ],
            ],
            'key'
        );

        return back()->with('success', 1);
    }
}
