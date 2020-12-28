<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Permission_category;
use App\Model\Role;
use Illuminate\Http\Request;

class AdminRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        abort_if(auth()->guard('admin')->id() != 1, 403);

        return view('admin.role.index', [
            'role' => Role::name($request->query('name'))
                ->where('guard', 'admin')
                ->latest()
                ->paginate(config('global')->adminPagin)
                ->appends([
                    'name' => $request->query('name')
                ]),
            'breadcrumb' => [
                [
                    'name' => __('common.admin'),
                    'link' => 'javascript:void();',
                    'isLatest' => 0
                ],
                [
                    'name' => __('common.roles'),
                    'link' => 'javascript:void();',
                    'isLatest' => 0
                ],
                [
                    'name' => __('common.archive'),
                    'link' => route('admin.role.index'),
                    'isLatest' => 1
                ],
            ]
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(auth()->guard('admin')->id() != 1, 403);

        return view('admin.role.create', [
            'permissionCategory' => Permission_category::latest('priority')
                ->with(['permissions' => function ($query) {
                    $query->where('guard', 'admin')
                        ->latest('priority');
                }])->get(),
            'script' => ['js/adminPermission.js'],
            'breadcrumb' => [
                [
                    'name' => __('common.admin'),
                    'link' => 'javascript:void();',
                    'isLatest' => 0
                ],
                [
                    'name' => __('common.roles'),
                    'link' => 'javascript:void();',
                    'isLatest' => 0
                ],
                [
                    'name' => __('common.archive'),
                    'link' => route('admin.role.index'),
                    'isLatest' => 0
                ],
                [
                    'name' => __('common.createRole'),
                    'link' => route('admin.role.create'),
                    'isLatest' => 1
                ],
            ]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort_if(auth()->guard('admin')->id() != 1, 403);

        $request->validate([
            'name' => 'required|max:255|unique:roles,name',
            'permission_id' => 'required|exists:permissions,id'
        ]);

        Role::create([
            'name' => $request->name
        ])->permissions()->sync($request->permission_id);

        return back()->with('success', 1);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        abort_if(auth()->guard('admin')->id() != 1, 403);

        return view('admin.role.edit', [
            'role' => $role,
            'permissions' => $role->permissions()->get(),
            'permissionCategory' => Permission_category::latest('priority')
                ->with(['permissions' => function ($query) {
                    $query->where('guard', 'admin')
                        ->latest('priority');
                }])->get(),
            'script' => ['js/adminPermission.js'],
            'breadcrumb' => [
                [
                    'name' => __('common.admin'),
                    'link' => 'javascript:void();',
                    'isLatest' => 0
                ],
                [
                    'name' => __('common.roles'),
                    'link' => 'javascript:void();',
                    'isLatest' => 0
                ],
                [
                    'name' => __('common.archive'),
                    'link' => route('admin.role.index'),
                    'isLatest' => 0
                ],
                [
                    'name' => __('common.editRole') . " " . $role->name,
                    'link' => route('admin.role.edit', $role),
                    'isLatest' => 1
                ],
            ]

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        abort_if(auth()->guard('admin')->id() != 1, 403);

        $request->validate([
            'name' => "required|max:255|unique:roles,name,$role->id,id",
            'permission_id' => 'required|exists:permissions,id'
        ]);

        $role->update([
            'name' => $request->name
        ]);
        $role->permissions()->sync($request->permission_id);

        return back()->with('success', 1);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        abort_if(auth()->guard('admin')->id() != 1, 403);

        $role->delete();
    }
}
