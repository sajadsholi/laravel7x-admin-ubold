<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Permission;
use App\Http\Controllers\Controller;
use App\Model\ApplicationSetting;
use App\Model\Device;
use Illuminate\Http\Request;

class AdminApplicationSettingsController extends Controller
{
    public function index()
    {
        abort_if(!Permission::can('applicationSettings'), 403);

        return view('admin.application.settings.index', [
            'devices' => Device::where('has_update', 1)
                ->with('application_setting.translations')
                ->get(),
            'breadcrumb' => [
                [
                    'name' => __('common.settings'),
                    'link' => 'javascript:void();',
                    'isLatest' => 0
                ],
                [
                    'name' => __('applicationSettings.singular'),
                    'link' => route('admin.application.settings.index'),
                    'isLatest' => 1
                ],
            ]
        ]);
    }

    public function store(Request $request)
    {
        abort_if(!Permission::can('applicationSettings'), 403);

        if (empty(ApplicationSetting::where('device_id', $request->device_id)->first())) {
            config(['translatable.locale' => config('global')->language->where('is_default', 1)->first()->language]);
        }

        $data = $request->validate([
            'update_message' => 'required',
            'current_version' => 'required|numeric',
            'update_method' => 'required|numeric|min:1|max:3',
            'link' => 'required|url',
            'direct_link' => 'nullable|url',
            'device_id' => 'required|numeric|exists:devices,id'
        ]);

        ApplicationSetting::updateOrCreate(
            ['device_id' => $request->device_id],
            $data
        );

        return back()->with('success', 1);
    }
}
