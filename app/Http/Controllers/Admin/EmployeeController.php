<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddUserRequest;
use App\Models\Employee;
use App\Models\Role;
use App\Models\User;
use App\Services\Auth\RegistrationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Yajra\DataTables\Facades\DataTables;

class EmployeeController extends Controller
{

    public function index()
    {
        $employees = User::whereHas('roles', function ($query) {
            $query->whereIn('name', ['admin', 'employee']);
        })->get();

        return view('admin.employee.index', compact('employees'));
    }

    public function tableJson(Request $request)
    {
        sleep(1);

        $data = User::with(['manager:id,name'])
            ->select('id', 'name', 'manager_id', 'email', 'phone')
            ->whereHas('roles', function ($query) {
                $query->whereIn('name', ['admin', 'employee']);
            })
            ->get();


        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('manager_name', function ($row) {
                return $row->manager ? $row->manager->name : 'N/A';
            })
            ->addColumn('action', 'admin.employee.datatables_actions')
            ->make(true);
    }

    public function createEmployee()
    {
        $roles = Role::get()->all();
        $users = User::select('uuid', 'name')
            ->whereHas('roles', function ($query) {
                $query->whereIn('name', ['admin', 'employee']);
            })
            ->get();
        return view('admin.employee.create', compact('roles', 'users'));
    }

    public function storeEmployee(AddUserRequest $request, RegistrationService $registration)
    {
        try {
            $validatedData = $request->validated();

            $roleId = $validatedData['role_id'];
            unset($validatedData['role_id']);

            $registration->register($validatedData, $roleId);

            return back()->with('success', 'User  Created Successfully !');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
