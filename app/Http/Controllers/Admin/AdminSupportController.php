<?php

namespace App\Http\Controllers\Admin;

use App\Exports\Admin\Export;
use App\Helpers\Permission;
use App\Http\Controllers\Controller;
use App\Model\Notification;
use App\Model\Support;
use App\Model\Support_status;
use App\Model\Token;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class AdminSupportController extends Controller
{


    public function index(Request $request)
    {
        abort_if(!Permission::can('support'), 403);

        $support = Support::ticketId($request->query('ticket_id'))
            ->fromDate($request->query('from_date'))
            ->toDate($request->query('to_date'))
            ->userId($request->query('user_id'))
            ->subject($request->query('subject'))
            ->statusId($request->query('status_id'))
            ->with('status')
            ->with('user')
            ->orderBy('status_id', 'ASC')
            ->latest()
            ->paginate(config('global')->adminPagin)
            ->appends([
                'ticket_id' => $request->query('ticket_id'),
                'from_date' => $request->query('from_date'),
                'to_date' => $request->query('to_date'),
                'user_id' => $request->query('user_id'),
                'subject' => $request->query('subject'),
                'status_id' => $request->query('status_id')
            ]);

        if ($request->query('download')) {
            if ($request->query('download') == 'xlsx') {
                return Excel::download(new Export($support, 'admin.export.support'), 'supports.xlsx');
            }
            if ($request->query('download') == 'csv') {
                return Excel::download(new Export($support, 'admin.export.support'), 'supports.csv');
            }
            if ($request->query('download') == 'pdf') {
                return view('admin.export.support', [
                    'data' => $support
                ]);
            }
            abort(403);
        }


        return view('admin.support.index', [
            'sum' => DB::select("SELECT ss.* , MAX(ticketNumber) AS ticketNumber FROM support_statuses ss LEFT JOIN(SELECT status_id , COUNT(id) AS ticketNumber FROM supports GROUP BY status_id ) s ON s.status_id = ss.id GROUP BY ss.id "),
            'status' => Support_status::all(),
            'support' => $support,
            'breadcrumb' => [
                [
                    'name' => __('support.singular'),
                    'link' => 'javascript:void();',
                    'isLatest' => 0
                ],
                [
                    'name' => __('common.archive'),
                    'link' => route('admin.support.index'),
                    'isLatest' => 1
                ],
            ],
        ]);
    }

    public function show(Support $support)
    {
        abort_if(!Permission::can('support'), 403);

        return view('admin.support.show', [
            'support' => $support,
            'breadcrumb' => [
                [
                    'name' => __('support.singular'),
                    'link' => 'javascript:void();',
                    'isLatest' => 0
                ],
                [
                    'name' => __('common.archive'),
                    'link' => route('admin.support.index'),
                    'isLatest' => 0
                ],
                [
                    'name' => __('common.detail') . ' - #' . $support->id,
                    'link' => route('admin.support.show', $support),
                    'isLatest' => 1
                ],
            ],
            'script' => [
                'js/adminSupportResponse.js',
                '/libs/moment/moment.min.js',
                '/libs/jquery-scrollto/jquery.scrollTo.min.js',
                request()->cookie('assetPath') . '-' . config('global')->adminDirection . '/js/pages/jquery.chat.js',
            ]
        ]);
    }

    public function response(Request $request, Support $support)
    {
        abort_if(!Permission::can('support'), 403);

        $request->validate([
            'response' => 'required'
        ]);

        $support->update([
            'status_id' => 2
        ]);

        $support->support_details()->create([
            'admin_id' => auth()->guard('admin')->id(),
            'message' => $request->response
        ]);


        $notif = [];
        $getToken = Token::where('tokenable_type', 'App\Model\User')
            ->where('tokenable_id', $support->user_id)
            ->with('tokenable')
            ->get()
            ->groupBy('device_id');


        if ($getToken->count()) {

            foreach ($getToken as $firstItem) {
                $token = [];
                foreach ($firstItem as $secondItem) {
                    $token[] = $secondItem->token;
                    $receiver = $secondItem->tokenable->fullname;
                    $device_id = $secondItem->device_id;
                    $notificationable_type = $secondItem->tokenable_type;
                    $notificationable_id = $secondItem->tokenable_id;
                }
                if (empty($token)) {
                    continue;
                }
                $notif[] = [
                    'title' => __('common.support'),
                    'message' => $request->response,
                    'token' => json_encode($token),
                    'template' => json_encode([
                        'title' => __('common.support'),
                        'msg' => (strlen($request->response) > 20) ? mb_substr($request->response, 0, 20) . '...' : $request->response,
                        'key' => 'support'
                    ]),
                    'type' => 'support',
                    'receiver' => $receiver,
                    'notificationable_type' => $notificationable_type,
                    'notificationable_id' => $notificationable_id,
                    'device_id' => $device_id,
                    'created_at' => date('Y-m-d H:i:s')
                ];
            }
            if (!empty($token)) {
                Notification::insert($notif);
            }
        }
    }

    public function close(Support $support)
    {
        abort_if(!Permission::can('support'), 403);

        if ($support->status_id == 1 || $support->status_id == 4) {
            abort(403);
        }

        $support->update(['status_id' => 4]);

        return back()->with('success', 1);
    }
}
