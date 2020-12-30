<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Permission;
use App\Http\Controllers\Controller;
use App\Model\Country;
use Illuminate\Http\Request;

class AdminCountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!Permission::can('addLocation') && !Permission::can('editLocation') && !Permission::can('deleteLocation')) {
            abort(403);
        }
        return view('admin.location.country.index', [
            'country' => Country::name($request->name)
                ->orderBy('is_active', 'DESC')
                ->orderBy('priority', 'DESC')
                ->orderBy('name', 'ASC')
                ->with('media')
                ->paginate(config('global')->adminPagin)
                ->appends([
                    'name' => $request->name
                ]),
            'breadcrumb' => [
                [
                    'name' => __('common.definition'),
                    'link' => 'Javascript:void(0)',
                    'isLatest' => 0
                ],
                [
                    'name' => __('country.singular'),
                    'link' => route('admin.country.index'),
                    'isLatest' => 1
                ]
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
        abort_if(!Permission::can('addLocation'), 403);

        $data = $request->validate([
            'name' => 'required',
            'code' => 'nullable',
            'phone_code' => 'nullable|numeric',
        ]);

        $request->validate([
            'image' => 'required'
        ]);

        $data['priority'] = (int) Country::max('priority') + 10;

        $country = Country::create($data);

        $country->addMedia($request->image);

        return back()->with('success', 1);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function show(Country $country)
    {
        abort_if(!Permission::can('editLocation'), 403);

        return view('admin.location.country.show', [
            'country' => $country,
            'breadcrumb' => [
                [
                    'name' => __('common.definition'),
                    'link' => 'Javascript:void(0)',
                    'isLatest' => 0
                ],
                [
                    'name' => __('common.archive') . " " . __('country.singular'),
                    'link' => route('admin.country.index'),
                    'isLatest' => 0
                ],
                [
                    'name' => __('common.edit') . " " . $country->name,
                    'link' => route('admin.country.show', $country),
                    'isLatest' => 1
                ],
            ]
        ]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Country $country)
    {
        abort_if(!Permission::can('editLocation'), 403);

        $data = $request->validate([
            'name' => 'required',
            'code' => 'nullable',
            'phone_code' => 'nullable|numeric',
        ]);

        $request->validate([
            'image' => 'required'
        ]);

        $country->update($data);

        $country->updateMedia($request->image);

        return back()->with('success', 1);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function destroy(Country $country)
    {
        abort_if(!Permission::can('deleteLocation'), 403);

        $country->delete();
    }
}
