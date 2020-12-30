<?php

namespace App\Http\Controllers\Admin;

use App\Exports\Admin\Export;
use App\Helpers\Permission;
use App\Http\Controllers\Controller;
use App\Model\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AdminUserController extends Controller
{
    public function index(Request $request)
    {

        abort_if(!Permission::can('user'), 403);

        $user = User::name($request->query('fullname'))
            ->mobile($request->query('mobile'))
            ->isActive($request->query('is_active'))
            ->fromDate($request->query('from_date'))
            ->toDate($request->query('to_date'))
            ->orderBy('is_active', 'DESC')
            ->orderBy('id', 'DESC')
            ->paginate(config('global')->adminPagin)
            ->appends([
                'fullname' => $request->query('fullname'),
                'mobile' => $request->query('mobile'),
                'is_active' => $request->query('is_active'),
                'from_date' => $request->query('from_date'),
                'to_date' => $request->query('to_date'),
            ]);

        if ($request->query('download')) {
            if ($request->query('download') == 'xlsx') {
                return Excel::download(new Export($user, 'admin.export.user'), 'users.xlsx');
            }
            if ($request->query('download') == 'csv') {
                return Excel::download(new Export($user, 'admin.export.user'), 'users.csv');
            }
            if ($request->query('download') == 'pdf') {
                return view('admin.export.user', [
                    'data' => $user
                ]);
            }
            abort(403);
        }

        return view('admin.user.index', [
            'users' => $user,
            'breadcrumb' => [
                [
                    'name' => __('user.plural'),
                    'link' => 'javascript:void();',
                    'isLatest' => 0
                ],
                [
                    'name' => __('common.archive'),
                    'link' => route('admin.user.index'),
                    'isLatest' => 1
                ],
            ],
        ]);
    }
}
