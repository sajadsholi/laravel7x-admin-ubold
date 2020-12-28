<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Permission;
use App\Http\Controllers\Controller;
use App\Model\Admin;
use App\Model\Device;
use App\Model\Notification;
use App\Model\Token;
use App\Model\User;
use Illuminate\Http\Request;

class AdminNotificationController extends Controller
{

    public function index(Request $request)
    {
        abort_if(!Permission::can('notification'), 403);

        return view('admin.notification.index', [
            'notification' => Notification::latest()
                ->fromDate($request->from_date)
                ->toDate($request->to_date)
                ->receiver($request->receiver)
                ->title($request->title)
                ->message($request->message)
                ->type($request->type)
                ->deviceId($request->device_id)
                ->with('device')
                ->paginate(config('global')->adminPagin)
                ->appends([
                    'from_date' => $request->from_date,
                    'to_date' => $request->to_date,
                    'receiver' => $request->receiver,
                    'title' => $request->title,
                    'message' => $request->message,
                    'type' => $request->type,
                    'device_id' => $request->device_id
                ]),
            'types' => Notification::select('type')->groupBy('type')->get(),
            'devices' => Device::all(),
            'breadcrumb' => [
                [
                    'name' => __('notification.singular'),
                    'link' => 'javascript:void();',
                    'isLatest' => 0
                ],
                [
                    'name' => __('common.archive'),
                    'link' => route('admin.notification.index'),
                    'isLatest' => 1
                ],
            ],
            'script' => ['js/adminNotificationArchive.js']
        ]);
    }

    public function store(Request $request)
    {
        abort_if(!Permission::can('notification'), 403);
        $request->validate([
            'userRange' => 'required|numeric',
            'user_id' => 'required_if:userRange,2',
            'title' => 'required|max:255',
            'message' => 'required'
        ]);

        if ($request->userRange == 1) {

            $notif['title'] = $request->title;
            $notif['message'] = $request->message;
            $notif['template'] = json_encode([
                'title' => $request->title,
                'msg' => (strlen($request->message) > 200) ? mb_substr($request->message, 0, 200) . '...' : $request->message,
                'key' => 'message'
            ]);
            $notif['type'] = 'notification';
            $notif['isAll'] = 1;
            $notif['current_id'] = 0;
            $notif['last_id'] = User::latest('id')->firstOrFail()->id;
            $notif['notificationable_type'] = 'App\Model\User';
            $notif['created_at'] = date('Y-m-d H:i:s');

            $devices = Token::select('device_id')
                ->where('tokenable_type', 'App\Model\User')
                ->groupBy('device_id')
                ->get();

            if (!$devices->count()) {
                return back()->with('info', __('notification.alert.notificationNoToken'));
            }

            $insert = [];
            foreach ($devices as $item) {
                $insert[] = array_merge($notif, ['device_id' => $item->device_id]);
            }

            Notification::insert($insert);

            return back()->with('success', 1);


            // 

        } else if ($request->userRange == 2) {

            $notif = [];
            $id_order = implode(",", $request->user_id);
            $getToken = Token::where('tokenable_type', 'App\Model\User')
                ->whereIn('tokenable_id', $request->user_id)
                ->with('tokenable')
                ->orderByRaw("FIELD(tokenable_id,  $id_order)")
                ->get()
                ->groupBy('device_id');

            if (!$getToken->count()) {
                return back()->with('info', __('notification.alert.notificationNoToken'));
            }

            foreach ($request->user_id as $row) {
                foreach ($getToken as $firstItem) {
                    $token = [];
                    foreach ($firstItem as $secondItem) {
                        if ($row == $secondItem->tokenable_id) {
                            $token[] = $secondItem->token;
                            $receiver = $secondItem->tokenable->fullname;
                            $device_id = $secondItem->device_id;
                            $notificationable_type = $secondItem->tokenable_type;
                            $notificationable_id = $secondItem->tokenable_id;
                        }
                    }
                    if (empty($token)) {
                        continue;
                    }
                    $notif[] = [
                        'title' => $request->title,
                        'message' => $request->message,
                        'token' => json_encode($token),
                        'template' => json_encode([
                            'title' => $request->title,
                            'msg' => (strlen($request->message) > 200) ? mb_substr($request->message, 0, 200) . '...' : $request->message,
                            'key' => 'message'
                        ]),
                        'type' => 'notification',
                        'receiver' => $receiver,
                        'notificationable_type' => $notificationable_type,
                        'notificationable_id' => $notificationable_id,
                        'device_id' => $device_id,
                        'created_at' => date('Y-m-d H:i:s')
                    ];
                }
            }

            Notification::insert($notif);
            return back()->with('success', 1);
        }
    }

    public function destroy(Notification $notification)
    {
        abort_if(!Permission::can('notification'), 403);
        $notification->delete();
    }

    // save push token
    public function savePushToken(Request $request)
    {
        $data = $request->validate([
            'token' => 'required'
        ]);

        $data['admin_id'] = auth()->guard('admin')->id();
        $data['device_id'] = 5;

        $check = Admin::tokens()->where('token', $data['token'])->first();

        if (empty($check)) {
            Admin::tokens()->create($data);
        } else {
            $check->update(['tokenable_id' => $data['admin_id']]);
        }
        return response('ok');
    }

    // remove push token after log out
    public function removePushToken(Request $request)
    {
        $request->validate([
            'token' => 'required'
        ]);
        Token::where('token', $request['token'])->delete();
        return response('ok');
    }

    public function testAdmin()
    {
        $getToken = Token::where('device_id', 5)->get()->groupBy('tokenable_id');

        if (!$getToken->count()) {
            return back()->with('info', __('notification.alert.notificationNoToken'));
        }
        foreach ($getToken as $item) {
            $token = [];
            foreach ($item as $secondItem) {
                $token[] = $secondItem->token;
            }
            $notif[] = [
                'title' => 'This is a title test',
                'message' => 'This is a message test',
                'token' => json_encode($token),
                'template' => json_encode([
                    'title' => 'It is a title test',
                    'msg' => 'It is is a message test',
                    'key' => 'test',
                    'link' => route('admin.dashboard.index'),
                ]),
                'type' => 'test admin notification',
                'receiver' => $secondItem->tokenable->fullname,
                'device_id' => 5,
                'notificationable_type' => $secondItem->tokenable_type,
                'notificationable_id' => $secondItem->tokenable_id,
                'created_at' => now()
            ];
        }

        Notification::insert($notif);
        return redirect()->route('admin.notification.index')->with('success', 1);
    }
}
