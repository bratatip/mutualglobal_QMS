<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\Auth\LoginService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function showLogin()
    {
        // folder name changes
        return view('authentication.login-signup');
    }

    public function doLogin(Request $request, LoginService $loginService)
    {
        return $loginService->doLogin($request);
    }

    public function logOut(Request $request)
    {
        Session::flush();

        Auth::logout();

        return redirect('/');
    }
}
