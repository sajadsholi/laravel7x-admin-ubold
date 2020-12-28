<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Permission;
use App\Http\Controllers\Controller;
use App\Model\Faq;
use Illuminate\Http\Request;

class AdminFaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!Permission::can('addFaq') && !Permission::can('editFaq') && !Permission::can('deleteFaq')) {
            abort(403);
        }

        return view('admin.faq.index', [
            'faqs' => Faq::question($request->query('question'))
                ->latest('priority')
                ->with('translations')
                ->paginate(config('global')->pagin)
                ->appends([
                    'question' => $request->query('question')
                ]),
            'breadcrumb' => [
                [
                    'name' => __('common.settings'),
                    'link' => 'javascript:void();',
                    'isLatest' => 0
                ],
                [
                    'name' => __('faq.singular'),
                    'link' => route('admin.faq.index'),
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
        abort_if(!Permission::can('addFaq'), 403);

        config(['translatable.locale' => config('global')->language->where('is_default', 1)->first()->language]);

        $data = $request->validate([
            'question' => 'required|max:255',
            'answer' => 'required',
        ]);
        $data['priority'] = (int) Faq::max('priority') + 10;
        Faq::create($data);

        return back()->with('success', 1);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function show(Faq $faq)
    {
        abort_if(!Permission::can('editFaq'), 403);

        return view('admin.faq.show', [
            'faq' => $faq,
            'breadcrumb' => [
                [
                    'name' => __('common.settings'),
                    'link' => 'javascript:void();',
                    'isLatest' => 0
                ],
                [
                    'name' => __('faq.singular'),
                    'link' => route('admin.faq.index'),
                    'isLatest' => 0
                ],
                [
                    'name' => __('common.edit') . " " . __('faq.singular'),
                    'link' => route('admin.faq.show', $faq),
                    'isLatest' => 1
                ],
            ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Faq $faq)
    {
        abort_if(!Permission::can('editFaq'), 403);

        $faq->update(
            $request->validate([
                'question' => 'required|max:255',
                'answer' => 'required',
            ])
        );

        return redirect(route('admin.faq.index'))->with('success', 1);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function destroy(Faq $faq)
    {
        abort_if(!Permission::can('deleteFaq'), 403);

        $faq->delete();
    }
}
