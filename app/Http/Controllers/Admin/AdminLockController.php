<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminLockController extends Controller
{

    use ThrottlesLogins;

    public $decayMinutes = 3;

    public function username()
    {
        return 'username';
    }

    // lock the account
    public function lock()
    {
        session(['lock-expires-at' => now()->subMinutes(10)]);
        return redirect()->route('admin.locked');
    }

    // show the locked form
    public function locked()
    {
        $route = (!empty(url()->previous())) ? url()->previous() : route('admin.dashboard.index');
        if (!session('lock-expires-at') || session('lock-expires-at') > now()) {
            return redirect($route);
        }
        session(['beforeLocked' => $route]);

        return view('admin.lock.index');
    }

    // unlock the screen
    public function unlock(Request $request)
    {
        $request->validate([
            'password' => 'required'
        ]);

        //check if the user has too many login attempts.
        if ($this->hasTooManyLoginAttempts($request)) {
            //Fire the lockout event.
            $this->fireLockoutEvent($request);

            //redirect the user back after lockout.
            return $this->sendLockoutResponse($request);
        }

        $admin = Auth::guard('admin')->user();

        $check = Hash::check($request->password, $admin->password);

        if (!$check) {

            //keep track of login attempts from the user.
            $this->incrementLoginAttempts($request);

            return redirect()->route('admin.locked')->withErrors([
                __('common.wrongPassword')
            ]);
        }

        session(['lock-expires-at' => now()->addMinutes($admin->getLockoutTime())]);
        $route = (!empty(session('beforeLocked'))) ? session('beforeLocked') : route('admin.dashboard.index');
        return redirect($route);
    }
}
