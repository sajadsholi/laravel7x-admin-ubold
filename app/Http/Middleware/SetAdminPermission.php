<?php

namespace App\Http\Middleware;

use App\Model\Permission;
use Closure;
use stdClass;
use Illuminate\Support\Facades\View;

class SetAdminPermission
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

        $can = new stdClass;

        $admin = auth()->guard('admin')->user();

        $permission = Permission::where('guard', 'admin')->get();

        if ($admin->id == 1) {

            // superadmin :: give all permission
            foreach ($permission as $row) {
                $can->{$row->key} = true;
            }
            // super admin

        } else if (empty($admin->role)) {

            // abort 403 :: admin is not superadmin and doesnot have any role
            abort(403);
        } else if ($admin->is_active == 0) {

            // throw out the user from panel
            auth()->guard('admin')->logout();

            return redirect()->route('admin.login')->withErrors(__('common.throwOutAdmin'));
        } else {

            $adminPermission = $admin->role->permissions()->get();
            // give the permission
            foreach ($permission as $row) {
                foreach ($adminPermission as $secondRow) {
                    if ($secondRow->id == $row->id) {
                        $can->{$row->key} = true;
                        break;
                    }
                }
            }
            // give the permission

        }

        View::share('can', $can);

        config(['can' => $can]);

        return $next($request);
    }
}
