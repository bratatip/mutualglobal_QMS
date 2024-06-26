<?php

namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;

class LoginService
{
    public function attemptLogin(array $credentials, bool $remember)
    {
        if (Auth::attempt($credentials, $remember)) {
            $user = Auth::user();

            if ($user->isActive()) {
                session()->regenerate();
                if (!$remember) {
                    Auth::logoutOtherDevices($credentials['password']);
                }

                if ($remember) {
                    Cookie::queue('email', $credentials['email'], 60 * 24 * 30); // 30 days
                    Cookie::queue('password', $credentials['password'], 60 * 24 * 30); // 30 days
                } else {
                    Cookie::queue('email', null, 0.5);
                    Cookie::queue('password', null, 0.5);
                }

                $route = $user->getRoleSlug() === 'admin' ? 'admin/dashboard' : 'employee/dashboard';

                return ['success' => true, 'route' => $route];
            } else {
                Auth::logout();
                return ['success' => false, 'message' => 'Your account has been deactivated!'];
            }
        } else {
            return ['success' => false, 'message' => 'Incorrect email or password.'];
        }
    }
}
