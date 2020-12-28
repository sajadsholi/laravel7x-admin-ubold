<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\City;
use App\Model\Region;
use App\Model\User;
use Illuminate\Http\Request;

class AdminSearchController extends Controller
{


    public function findUser(Request $request)
    {

        $request->validate([
            'search' => 'required'
        ]);

        $search = $request->search;

        return response(
            User::select('id', 'firstname', 'lastname', 'fullname')
                ->where('firstname', 'LIKE', "%$search%")
                ->orWhere('lastname', 'LIKE', "%$search%")
                ->orWhere('fullname', 'LIKE', "%$search%")
                ->where('isActive', 1)
                ->get()
        );
    }

    public function getRegions(Request $request)
    {
        $request->validate([
            'country_id' => 'required|numeric'
        ]);

        return response(
            Region::where([
                'country_id' => $request->country_id,
                'isActive' => 1
            ])
                ->latest('priority')
                ->orderBy('name', 'ASC')
                ->get()
        );
    }

    public function getCities(Request $request)
    {
        $request->validate([
            'region_id' => 'required|numeric'
        ]);

        return response(
            City::where([
                'region_id' => $request->region_id,
                'isActive' => 1
            ])
                ->latest('priority')
                ->orderBy('name', 'ASC')
                ->get()
        );
    }
}
