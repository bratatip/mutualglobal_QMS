<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Services\Auth\RegistrationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class EmployeeController extends Controller
{

    public function createEmployee()
    {
        $roles = Role::get()->all();
        return view('admin.employee.create', compact('roles'));
    }

    public function storeEmployee(Request $request, RegistrationService $registration)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'role_id' => 'required|string',
                'email' => 'required|email|unique:users,email',
                'phone' => 'nullable|numeric',
            ]);

            $role = $validatedData['role_id'];

            $registration->register($validatedData, $role);

            return back()->with('success', 'User  Created Successfully !');

            // return response()->json(['message' => 'Employee registration successful'], 200);
        } catch (ValidationException $e) {
            throw $e;
            // return response()->json(['errors' => $e->errors()], 400);
        } catch (\Exception $e) {
            throw $e;
            // return response()->json(['message' => 'An error occurred during registration'], 500);
        }
    }
}
