<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Permission;
use App\Http\Controllers\Controller;
use App\Model\Contact;
use Illuminate\Http\Request;

class AdminContactController extends Controller
{
    public function index()
    {
        abort_if(!Permission::can('contactUs'), 403);

        return view('admin.contact.index', [
            'contact' =>  Contact::find(1),
            'script' => ['libs/leaflet/leaflet.js', 'js/adminContactUs.js'],
            'style' => ['libs/leaflet/leaflet.css'],
            'breadcrumb' => [
                [
                    'name' => __('common.settings'),
                    'link' => 'javascript:void();',
                    'isLatest' => 0
                ],
                [
                    'name' => __('contactUs.singular'),
                    'link' => route('admin.contact.index'),
                    'isLatest' => 1
                ],
            ]
        ]);
    }

    public function store(Request $request)
    {
        abort_if(!Permission::can('contactUs'), 403);

        $request->validate([
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'instagram' => 'nullable|url',
            'youtube' => 'nullable|url',
            'telegram' => 'nullable|url',
            'whatsapp' => 'nullable|url',
            'lat' => 'required',
            'lng' => 'required',
        ]);

        $sizeContact = sizeof($request['contactTitle']);
        $sizeAddress = sizeof($request['titleAddress']);
        $sizeEmail = sizeof($request['titleEmail']);

        $contactNumber = [];
        $address = [];
        $email = [];

        for ($i = 0; $i < $sizeContact; $i++) {
            if (!empty($request['contactTitle'][$i]) && !empty($request['contactNumber'][$i])) {
                $contactNumber[] = [
                    'title' => $request['contactTitle'][$i],
                    'value' => $request['contactNumber'][$i]
                ];
            }
        }


        for ($i = 0; $i < $sizeAddress; $i++) {
            if (!empty($request['titleAddress'][$i]) && !empty($request['address'][$i])) {
                $address[] = [
                    'title' => $request['titleAddress'][$i],
                    'value' => $request['address'][$i]
                ];
            }
        }

        for ($i = 0; $i < $sizeEmail; $i++) {
            if (!empty($request['titleEmail'][$i]) && !empty($request['email'][$i])) {
                $email[] = [
                    'title' => $request['titleEmail'][$i],
                    'value' => $request['email'][$i]
                ];
            }
        }
        if (empty($contactNumber) || empty($address) || empty($email)) {
            abort(404);
        }
        $data['contact_number'] = json_encode($contactNumber);
        $data['address'] = json_encode($address);
        $data['email'] = json_encode($email);
        $data['facebook'] = $request['facebook'];
        $data['twitter'] = $request['twitter'];
        $data['instagram'] = $request['instagram'];
        $data['youtube'] = $request['youtube'];
        $data['telegram'] = $request['telegram'];
        $data['whatsapp'] = $request['whatsapp'];
        $data['lat'] = $request['lat'];
        $data['lng'] = $request['lng'];

        Contact::updateOrCreate(['id' => 1], $data);

        return back()->with('success', 1);
    }
}
