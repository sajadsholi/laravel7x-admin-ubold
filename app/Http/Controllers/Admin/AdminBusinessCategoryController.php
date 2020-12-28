<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Permission;
use App\Http\Controllers\Controller;
use App\Model\BusinessCategory;
use Illuminate\Http\Request;

class AdminBusinessCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!Permission::can('addBusinessCategory') && !Permission::can('editBusinessCategory') && !Permission::can('deleteBusinessCategory')) {
            abort(403);
        }
        return view('admin.business.category.index', [
            'businessCategories' => BusinessCategory::latest('priority')
                ->name($request->name)
                ->whereNull('parent_id')
                ->with('translations')
                ->paginate(config('global')->pagin)
                ->appends([
                    'name' => $request->name
                ]),
            'breadcrumb' => [
                [
                    'name' => __('common.definition'),
                    'link' => 'Javascript:void(0)',
                    'isLatest' => 0,
                ],
                [
                    'name' => __('common.archive') . " " . __('businessCategory.singular'),
                    'link' => route('admin.businessCategory.index'),
                    'isLatest' => 1,
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
        abort_if(!Permission::can('addBusinessCategory'), 403);

        return view('admin.business.category.create', [
            'breadcrumb' => [
                [
                    'name' => __('common.definition'),
                    'link' => 'Javascript:void(0)',
                    'isLatest' => 0,
                ],
                [
                    'name' => __('common.archive'),
                    'link' => route('admin.businessCategory.index'),
                    'isLatest' => 0,
                ],
                [
                    'name' => __('common.add') . " " . __('businessCategory.singular'),
                    'link' => route('admin.businessCategory.create'),
                    'isLatest' => 1,
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
        abort_if(!Permission::can('addBusinessCategory'), 403);

        $data = $request->validate([
            'name' => 'required|max:255',
            'link' => 'required|max:255|unique:business_category_translations,link',
            'meta_title' => 'required|max:255',
            'meta_keywords' => 'required|array|min:1',
            'meta_description' => 'required',
        ]);

        $request->validate([
            'image.path' => 'required',
        ]);

        config(['translatable.locale' => config('global')->language->where('is_default', 1)->first()->language]);


        $data['priority'] = (int) BusinessCategory::whereNull('parent_id')->max('priority') + 5;
        $data['meta_keywords'] = implode(",", $request->meta_keywords);

        $businessCategory = BusinessCategory::create($data);
        $businessCategory->addMedia($request->image);

        return back()->with('success', 1);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\BusinessCategory  $businessCategory
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, BusinessCategory $businessCategory)
    {
        if (!Permission::can('addBusinessCategory') && !Permission::can('editBusinessCategory') && !Permission::can('deleteBusinessCategory')) {
            abort(403);
        }

        return view('admin.business.category.show', [
            'businessCategory' => $businessCategory,
            'businessSubCategories' => $businessCategory->children()
                ->latest('priority')
                ->name($request->name)
                ->whereNotNull('parent_id')
                ->with('translations')
                ->paginate(config('global')->pagin)
                ->appends([
                    'name' => $request->name
                ]),
            'breadcrumb' => [
                [
                    'name' => __('common.definition'),
                    'link' => 'Javascript:void(0)',
                    'isLatest' => 0,
                ],
                [
                    'name' =>  __('businessCategory.singular') . " - " . $businessCategory->name,
                    'link' => route('admin.businessCategory.index'),
                    'isLatest' => 0,
                ],
                [
                    'name' =>  __('common.archive'),
                    'link' => route('admin.businessCategory.show', $businessCategory),
                    'isLatest' => 0,
                ],
            ]
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\BusinessCategory  $businessCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(BusinessCategory $businessCategory)
    {
        abort_if(!Permission::can('editBusinessCategory'), 403);

        return view('admin.business.category.edit', [
            'businessCategory' => $businessCategory,
            'breadcrumb' => [
                [
                    'name' => __('common.definition'),
                    'link' => 'Javascript:void(0)',
                    'isLatest' => 0,
                ],
                [
                    'name' => __('common.archive'),
                    'link' => (empty($businessCategory->parent_id)) ? route('admin.businessCategory.index') : route('admin.businessCategory.show', ['businessCategory' => $businessCategory->parent_id]),
                    'isLatest' => 0,
                ],
                [
                    'name' => __('common.edit') . " " . __('businessCategory.singular'),
                    'link' => route('admin.businessCategory.edit', $businessCategory),
                    'isLatest' => 1,
                ],
            ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\BusinessCategory  $businessCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BusinessCategory $businessCategory)
    {
        abort_if(!Permission::can('editBusinessCategory'), 403);

        $data = $request->validate([
            'name' => 'required|max:255',
            'link' => "required|max:255|unique:business_category_translations,link,$businessCategory->id,business_category_id",
            'meta_title' => 'required|max:255',
            'meta_keywords' => 'required|array|min:1',
            'meta_description' => 'required',
        ]);

        $request->validate([
            'image.path' => 'required',
        ]);
        $data['meta_keywords'] = implode(",", $request->meta_keywords);

        $businessCategory->update($data);
        $businessCategory->updateMedia($request->image);

        return redirect((empty($businessCategory->parent_id)) ? route('admin.businessCategory.index') : route('admin.businessCategory.show', ['businessCategory' => $businessCategory->parent_id]))->with('success', 1);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\BusinessCategory  $businessCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(BusinessCategory $businessCategory)
    {
        abort_if(!Permission::can('deleteBusinessCategory'), 403);
        $businessCategory->children()->delete();
        $businessCategory->delete();
    }


    public function createSubCategory(BusinessCategory $businessCategory)
    {
        abort_if(!Permission::can('addBusinessCategory'), 403);

        return view('admin.business.category.sub.create', [
            'businessCategory' => $businessCategory,
            'breadcrumb' => [
                [
                    'name' => __('common.definition'),
                    'link' => 'Javascript:void(0)',
                    'isLatest' => 0,
                ],
                [
                    'name' => __('businessCategory.singular'),
                    'link' => route('admin.businessCategory.index'),
                    'isLatest' => 0,
                ],
                [
                    'name' => $businessCategory->name,
                    'link' => route('admin.businessCategory.show', $businessCategory),
                    'isLatest' => 0,
                ],
                [
                    'name' => __('common.add') . " " . __('businessCategory.other.businessSubCategory'),
                    'link' => route('admin.businessCategory.createSubCategory', $businessCategory),
                    'isLatest' => 1,
                ],
            ]
        ]);
    }

    public function storeSubCategory(Request $request, BusinessCategory $businessCategory)
    {
        abort_if(!Permission::can('addBusinessCategory'), 403);

        $data = $request->validate([
            'name' => 'required|max:255',
            'link' => 'required|max:255|unique:business_category_translations,link',
            'meta_title' => 'required|max:255',
            'meta_keywords' => 'required|array|min:1',
            'meta_description' => 'required',
        ]);

        $request->validate([
            'image.path' => 'required',
        ]);

        config(['translatable.locale' => config('global')->language->where('is_default', 1)->first()->language]);

        $data['priority'] = (int) BusinessCategory::whereNotNull('parent_id')->max('priority') + 5;
        $data['meta_keywords'] = implode(",", $request->meta_keywords);

        $sub = $businessCategory->children()->create($data);
        $sub->addMedia($request->image);

        return back()->with('success', 1);
    }
}
