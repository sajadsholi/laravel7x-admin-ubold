<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Permission;
use App\Http\Controllers\Controller;
use App\Model\Page;
use Illuminate\Http\Request;

class AdminPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!Permission::can('addPage') && !Permission::can('editPage') && !Permission::can('deletePage')) {
            abort(403);
        }
        return view('admin.page.index', [
            'pages' => Page::latest('priority')
                ->name($request->query('name'))
                ->with('translations')
                ->paginate(config('global')->pagin)
                ->appends([
                    'name' => $request->query('name')
                ]),
            'breadcrumb' => [
                [
                    'name' => __('common.settings'),
                    'link' => 'javascript:void();',
                    'isLatest' => 0
                ],
                [
                    'name' => __('page.singular'),
                    'link' => route('admin.page.index'),
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
        abort_if(!Permission::can('addPage'), 403);

        config(['translatable.locale' => config('global')->language->where('is_default', 1)->first()->language]);

        $data = $request->validate([
            'name' => 'required|max:255',
            'content' => 'required'
        ]);
        $data['priority'] = (int) Page::max('priority') + 10;

        Page::create($data);

        return back()->with('success', 1);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
        abort_if(!Permission::can('editPage'), 403);

        return view('admin.page.show', [
            'page' => $page,
            'breadcrumb' => [
                [
                    'name' => __('common.settings'),
                    'link' => 'javascript:void();',
                    'isLatest' => 0
                ],
                [
                    'name' => __('page.singular'),
                    'link' => route('admin.page.index'),
                    'isLatest' => 0
                ],
                [
                    'name' => __('common.edit') . " " . __('page.singular') . " - " . $page->name,
                    'link' => route('admin.page.show', $page),
                    'isLatest' => 1
                ],
            ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Page $page)
    {
        abort_if(!Permission::can('editPage'), 403);

        $page->update(
            $request->validate([
                'name' => 'required|max:255',
                'content' => 'required'
            ])
        );
        return redirect(route('admin.page.index'))->with('success', 1);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        abort_if(!Permission::can('deletePage'), 403);

        $page->delete();
    }
}
