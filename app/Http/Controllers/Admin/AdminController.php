<?php

namespace App\Http\Controllers\Admin;

use App\Exports\Admin\Export;
use App\Http\Controllers\Controller;
use App\Model\Admin;
use App\Model\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        abort_if(auth()->guard('admin')->id() != 1, 403);

        $admin = Admin::name($request->query('name'))
            ->roleId($request->query('role_id'))
            ->isActive($request->query('is_active'))
            ->latest('id')
            ->with('role')
            ->paginate(config('global')->adminPagin)
            ->appends([
                'name' => $request->query('name'),
                'role_id' => $request->query('role_id'),
                'is_active' => $request->query('is_active')
            ]);


        if ($request->query('download')) {
            if ($request->query('download') == 'xlsx') {
                return Excel::download(new Export($admin, 'admin.export.admin'), 'admins.xlsx');
            }
            if ($request->query('download') == 'csv') {
                return Excel::download(new Export($admin, 'admin.export.admin'), 'admins.csv');
            }
            if ($request->query('download') == 'pdf') {
                return view('admin.export.admin', [
                    'data' => $admin
                ]);
            }
            abort(403);
        }

        return view('admin.management.index', [
            'admin' => $admin,
            'roles' => Role::all(),
            'breadcrumb' => [
                [
                    'name' => __('common.admin'),
                    'link' => 'javascript:void(0);',
                    'isLatest' => 0
                ],
                [
                    'name' => __('common.archive'),
                    'link' => route('admin.management.index'),
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

        return view('admin.management.create', [
            'roles' => Role::all(),
            'breadcrumb' => [
                [
                    'name' => __('common.admin'),
                    'link' => 'javascript:void(0);',
                    'isLatest' => 0
                ],
                [
                    'name' => __('common.createAdmin'),
                    'link' => route('admin.management.create'),
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

        $data = $request->validate([
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'contact_number' => 'nullable|numeric',
            'username' => 'required|max:255|unique:admins,username',
            'role_id' => 'required|numeric|exists:roles,id',
            'password' => 'required|max:255|min:8|confirmed',
        ]);

        $data['password'] = Hash::make($data['password']);

        $admin = Admin::create($data);
        if (!empty($request->image)) {
            $admin->addMedia($request->image);
        }

        return redirect(route('admin.management.index'))->with('success', 1);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (auth()->guard('admin')->id() != 1 && auth()->guard('admin')->id() != $id) {
            abort(403);
        }

        if (auth()->guard('admin')->id() == 1) {
            $breadcrumb = [
                [
                    'name' => __('common.admin'),
                    'link' => 'javascript:void(0);',
                    'isLatest' => 0
                ],
                [
                    'name' => __('common.archive'),
                    'link' => route('admin.management.index'),
                    'isLatest' => 0
                ],
                [
                    'name' => __('common.editAdmin'),
                    'link' => route('admin.management.edit', ['management' => $id]),
                    'isLatest' => 1
                ],
            ];
        } else {
            $breadcrumb = [];
        }

        return view('admin.management.edit', [
            'admin' => Admin::findOrFail($id),
            'roles' => Role::all(),
            'breadcrumb' => $breadcrumb
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (auth()->guard('admin')->id() != 1 && auth()->guard('admin')->id() != $id) {
            abort(403);
        }

        $admin = Admin::findOrFail($id);

        $data = $request->validate([
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'contact_number' => 'nullable|numeric',
            'username' => "required|max:255|unique:admins,username,$admin->id,id",
            'password' => 'nullable|max:255|min:8|confirmed',
        ]);
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        if ($admin->id != 1 && auth()->guard('admin')->id() == 1) {
            $data = array_merge($data, $request->validate([
                'role_id' => 'required|numeric|exists:roles,id'
            ]));
        }

        $admin->update($data);
        $admin->updateMedia($request->image);

        return back()->with('success', 1);
    }

    public function changeIsActive(Request $request)
    {
        abort_if(auth()->guard('admin')->id() != 1, 403);

        $request->validate([
            'value' => 'required|numeric|boolean',
            'pk' => 'required|numeric'
        ]);

        abort_if($request->pk == 1, 403);

        Admin::findOrFail($request->pk)->update([
            'is_active' => $request->value
        ]);
    }
}
