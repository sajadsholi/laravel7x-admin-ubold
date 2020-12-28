<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Permission;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminCommonController extends Controller
{
    // activate and inactivate
    public function changeIsActive(Request $request)
    {
        $request->validate([
            'can' => 'required',
            'model' => 'required',
            'value' => 'required|numeric|boolean',
            'pk' => 'required|numeric'
        ]);

        abort_if(!Permission::can($request->can), 403);

        $model = "App\Model\\$request->model";
        $model::findOrFail($request->pk)->update([
            'isActive' => $request->value
        ]);
    }

    // priority

    public function changePriority(Request $request)
    {
        $request->validate([
            'can' => 'required',
            'model' => 'required',
            'value' => 'required|numeric|min:0',
            'pk' => 'required|numeric'
        ]);

        abort_if(!Permission::can($request->can), 403);

        $model = "App\Model\\$request->model";
        $model::findOrFail($request->pk)->update([
            'priority' => $request->value
        ]);
    }

    public function checkLinkIsUnique(Request $request)
    {
        $request->validate([
            'link' => 'required',
            'can' => 'required',
            'model' => 'required',
            'action' => 'required',
        ]);

        abort_if(!Permission::can($request->can), 403);

        if ($request->action == 'create') {

            $model = "App\Model\\$request->model";
            $check = $model::where("link", $request->link)->first();
            abort_if(!empty($check), 422);

            // 
        } else if ($request->action == 'edit') {

            $request->validate([
                'id' => 'required|numeric'
            ]);

            $model = "App\Model\\$request->model";
            $check = $model::where([
                ["id", '!=', $request->id],
                ["link", '=', $request->link]
            ])->first();

            abort_if(!empty($check), 422);

            // 
        } else {
            abort(404);
        }
    }

    public function checkMobileIsUnique(Request $request)
    {
        $request->validate([
            'mobile' => 'required',
            'can' => 'required',
            'model' => 'required',
            'action' => 'required',
        ]);

        abort_if(!Permission::can($request->can), 403);

        if ($request->action == 'create') {

            $model = "App\Model\\$request->model";
            $check = $model::where("mobile", $request->mobile)->first();
            abort_if(!empty($check), 422);

            // 
        } else if ($request->action == 'edit') {

            $request->validate([
                'id' => 'required|numeric'
            ]);

            $model = "App\Model\\$request->model";
            $check = $model::where([
                ["id", '!=', $request->id],
                ["mobile", '=', $request->mobile]
            ])->first();

            abort_if(!empty($check), 422);

            // 
        } else {
            abort(404);
        }
    }

    public function checkEmailIsUnique(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'can' => 'required',
            'model' => 'required',
            'action' => 'required',
        ]);

        abort_if(!Permission::can($request->can), 403);

        if ($request->action == 'create') {

            $model = "App\Model\\$request->model";
            $check = $model::where("email", $request->email)->first();
            abort_if(!empty($check), 422);

            // 
        } else if ($request->action == 'edit') {

            $request->validate([
                'id' => 'required|numeric'
            ]);

            $model = "App\Model\\$request->model";
            $check = $model::where([
                ["id", '!=', $request->id],
                ["email", '=', $request->email]
            ])->first();

            abort_if(!empty($check), 422);

            // 
        } else {
            abort(404);
        }
    }
}
