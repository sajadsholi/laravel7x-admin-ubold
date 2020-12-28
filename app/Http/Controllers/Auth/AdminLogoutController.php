<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLogoutController extends Controller
{
    public function index()
    {
        $admin = Auth::guard('admin')->user();

        Auth::guard('admin')->logout();
        // log
        activity()->by($admin)->log('Logout');

        return redirect(route('admin.login'));
    }
}
