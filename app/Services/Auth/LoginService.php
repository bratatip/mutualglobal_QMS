<?php

namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;

class LoginService
{
    public function doLogin($data, $remember = null, $adminRequest = false)
    {
        $remember = $data->remember_me ?? false;

        $data = $data->only('email', 'password');
        if (!Auth::attempt($data, $remember)) {
            return back()->with('error', 'Incorrect email or password.');
        }
        /**
         * @var User $user
         */
        $user = Auth::user();
        session()->regenerate();

        if (!$remember) {
            Auth::logoutOtherDevices($data['password']);
        }

        // Set the email and password as cookies if remember me is checked
        if ($remember) {
            cookie('email', $data['email'], 60 * 24 * 30); // 30 days
            cookie('password', $data['password'], 60 * 24 * 30); // 30 days
        } else {
            cookie()->forget('email');
            cookie()->forget('password');
        }

        if ($adminRequest && !$user->hasRole('admin')) {
            Auth::logout();
            return back()->with('error', 'You do not have the required role to access this page.');
        }

        switch ($user->role->name) {
            case 'admin':
                // $redirectTo = '/admin/dashboard';
                // $routeName = 'Admin.dashboard';
                $redirectTo = '/customers';
                $routeName = 'customer.table';
                break;
            case 'employee':
                $redirectTo = '/customers';
                $routeName = 'customer.table';
                break;
            case 'client':
                $redirectTo = '/dummy/dashboard';
                $routeName = '/dummy/client.dashboard';
                break;
            default:
                Auth::logout();
                return back()->with('error', 'You do not have the required role to access this page.');
        }

        return redirect(route($routeName));
    }

}
