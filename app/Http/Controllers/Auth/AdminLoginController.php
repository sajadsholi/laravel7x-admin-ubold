<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AdminLoginController extends Controller
{

    use ThrottlesLogins;

    public $decayMinutes = 3;

    public function username()
    {
        return 'username';
    }

    // show the login form
    public function index()
    {
        return view('admin.auth.login');
    }


    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|max:255',
            'password' => 'required|max:255'
        ]);

        //check if the user has too many login attempts.
        if ($this->hasTooManyLoginAttempts($request)) {
            //Fire the lockout event.
            $this->fireLockoutEvent($request);

            //redirect the user back after lockout.
            return $this->sendLockoutResponse($request);
        }


        // check the user info
        if (Auth::guard('admin')->attempt(['username' => $request->username, 'password' => $request->password, 'is_active' => 1], $request->get('remember'))) {

            $admin = Auth::guard('admin')->user();
            // log
            activity()->by($admin)->log('Login');

            return redirect()->intended('/admin');
        }

        //keep track of login attempts from the user.
        $this->incrementLoginAttempts($request);

        throw ValidationException::withMessages([
            'loginError' => __('auth.failed'),
        ]);
    }
}
