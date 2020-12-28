<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Jdf;
use App\Http\Controllers\Controller;
use App\Model\Admin;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class AdminLogsActivity extends Controller
{
    public function index(Request $request)
    {
        abort_if(auth()->guard('admin')->id() != 1, 403);
        $fromDate = NULL;
        $toDate = NULL;

        $data = Activity::latest()
            ->where('causer_type', 'App\Model\Admin')
            ->where(function ($query) use ($request) {
                // admin id
                if (!empty($request->query('admin_id'))) {
                    $query->where('causer_id', $request->query('admin_id'));
                }
                // description
                if (!empty($request->query('description'))) {
                    $query->where('description', $request->query('description'));
                }
                // log name
                if (!empty($request->query('log_name'))) {
                    $query->where('log_name', $request->query('log_name'));
                }
                // from date
                if (!empty($request->query('from_date'))) {

                    $fromDate = (config('app.locale') == 'fa') ? Jdf::jtog($request->query('from_date'), 'Y-m-d H:i:s') : $request->query('from_date');

                    $query->where('created_at', '>=', $fromDate);
                }
                // to date
                if (!empty($request->query('to_date'))) {

                    $toDate = (config('app.locale') == 'fa') ? Jdf::jtog($request->query('to_date'), 'Y-m-d H:i:s') : $request->query('to_date');

                    $query->where('created_at', '<=', $toDate);
                }
            })
            ->paginate(20)
            ->appends([
                'admin_id' => $request->query('admin_id'),
                'description' => $request->query('description'),
                'log_name' => $request->query('log_name'),
                'from_date' => $fromDate,
                'to_date' => $toDate
            ]);

        if (config('app.locale') == 'fa') {
            foreach ($data as $row) {
                $row->created_at = ($row->created_at) ? Jdf::gtoj($row->created_at, 'Y-m-d H:i:s') : NULL;
            }
        }

        return view('admin.logsActivity.index', [
            'logs' =>  $data,
            'admins' => Admin::all(),
            'descriptions' => Activity::selectRaw('description AS name')
                ->where('description', '!=', '')
                ->groupBy('description')
                ->get(),
            'log_names' => Activity::selectRaw('log_name AS name')
                ->where('log_name', '!=', '')
                ->groupBy('log_name')
                ->get(),
        ]);
    }
}
