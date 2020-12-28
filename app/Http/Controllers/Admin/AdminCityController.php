<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Permission;
use App\Http\Controllers\Controller;
use App\Model\City;
use App\Model\Region;
use Illuminate\Http\Request;

class AdminCityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Region $region)
    {
        if (!Permission::can('addLocation') && !Permission::can('editLocation') && !Permission::can('deleteLocation')) {
            abort(403);
        }
        return view('admin.location.city.index', [
            'region' => $region,
            'city' => $region->cities()
                ->name($request->name)
                ->orderBy('isActive', 'DESC')
                ->orderBy('priority', 'DESC')
                ->orderBy('name', 'ASC')
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
                    'name' => __('country.singular') . " - " . $region->country->name,
                    'link' => route('admin.region.index', $region->country_id),
                    'isLatest' => 1
                ],
                [
                    'name' => __('region.singular') . " - " . $region->name,
                    'link' => route('admin.city.index', $region),
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
    public function store(Request $request, Region $region)
    {

        abort_if(!Permission::can('addLocation'), 403);

        $data = $request->validate([
            'name' => 'required|max:255'
        ]);
        $data['priority'] = (int) $region->cities()->max('priority') + 10;
        $region->cities()->create($data);

        return back()->with('success', 1);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(Region $region, City $city)
    {
        abort_if(!Permission::can('editLocation'), 403);

        return view('admin.location.city.show', [
            'region' => $region,
            'city' => $city,
            'breadcrumb' => [
                [
                    'name' => __('common.definition'),
                    'link' => 'Javascript:void(0)',
                    'isLatest' => 0
                ],
                [
                    'name' => __('country.singular') . " - " . $region->country->name,
                    'link' => route('admin.region.index', $region->country_id),
                    'isLatest' => 1
                ],
                [
                    'name' => __('region.singular') . " - " . $region->name,
                    'link' => route('admin.city.index', $region),
                    'isLatest' => 0
                ],
                [
                    'name' => __('common.edit') . " " . $city->name,
                    'link' => route('admin.city.show', ['region' => $region, 'city' => $city]),
                    'isLatest' => 1
                ],
            ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Region $region, City $city)
    {
        abort_if(!Permission::can('editLocation'), 403);

        $city->update(
            $request->validate([
                'name' => 'required|max:255'
            ])
        );
        return back()->with('success', 1);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(Region $region, City $city)
    {
        abort_if(!Permission::can('deleteLocation'), 403);
        $city->delete();
    }
}
