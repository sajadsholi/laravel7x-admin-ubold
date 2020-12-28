<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Permission;
use App\Http\Controllers\Controller;
use App\Model\Country;
use App\Model\Region;
use Illuminate\Http\Request;

class AdminRegionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Country $country)
    {
        if (!Permission::can('addLocation') && !Permission::can('editLocation') && !Permission::can('deleteLocation')) {
            abort(403);
        }
        return view('admin.location.region.index', [
            'country' => $country,
            'region' => $country->regions()
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
                    'name' => __('country.singular') . " " . $country->name,
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
    public function store(Request $request, Country $country)
    {
        abort_if(!Permission::can('addLocation'), 403);

        $data = $request->validate([
            'name' => 'required|max:255'
        ]);
        $data['priority'] = (int) $country->regions()->max('priority') + 10;
        $country->regions()->create($data);

        return back()->with('success', 1);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function show(Country $country, Region $region)
    {
        abort_if(!Permission::can('editLocation'), 403);

        return view('admin.location.region.show', [
            'country' => $country,
            'region' => $region,
            'breadcrumb' => [
                [
                    'name' => __('common.definition'),
                    'link' => 'Javascript:void(0)',
                    'isLatest' => 0
                ],
                [
                    'name' => __('country.singular') . " - " . $country->name,
                    'link' => route('admin.region.index', $country),
                    'isLatest' => 0
                ],
                [
                    'name' => __('common.edit') . " " . $region->name,
                    'link' => route('admin.region.show', ['country' => $country, 'region' => $region]),
                    'isLatest' => 1
                ],
            ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Country $country, Region $region)
    {
        abort_if(!Permission::can('editLocation'), 403);

        $region->update(
            $request->validate([
                'name' => 'required|max:255'
            ])
        );
        return back()->with('success', 1);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function destroy(Country $country, Region $region)
    {
        abort_if(!Permission::can('deleteLocation'), 403);

        $region->delete();
    }
}
