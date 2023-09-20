<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\UuidGeneratorHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function loginUsers()
    {
        // folder name changes
        return view('authentication.login-signup');
    }
}
