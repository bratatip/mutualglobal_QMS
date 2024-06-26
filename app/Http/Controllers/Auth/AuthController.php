<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Services\Auth\LoginService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    protected $loginService;

    public function __construct(LoginService $loginService)
    {
        $this->loginService = $loginService;
    }

    public function showLogin()
    {
        Auth::logout();
        return view('authentication.login-signup');
    }

    public function doLogin(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        $remember = $request->filled('remember');

        $result = $this->loginService->attemptLogin($credentials, $remember);

        if ($result['success']) {
            return redirect()->intended($result['route']);
        } else {
            return back()->with('error', $result['message']);
        }
    }

    public function logOut(Request $request)
    {
        Session::flush();

        Auth::logout();

        $request->session()->invalidate();
        return redirect('/');
    }
}
