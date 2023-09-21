<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InsurerEmailsManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function showForm()
    {
        return view('admin.insurerAndEmailsManagement.index');
    }
}
