<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InsurerEmailsManagementController extends Controller
{
    public function showForm(){
        return view('admin.insurerAndEmailsManagement.index');
    }
}
