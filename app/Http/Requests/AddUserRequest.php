<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AddUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'role_id' => [
                'required',
                'string',
                Rule::exists('roles', 'id')->where(function ($query) {
                    // Check if role exists
                    $query->where('id', request('role_id'));
                }),
            ],
            'manager_id' => [
                'required',
                'string',
                Rule::exists('users', 'uuid')->where(function ($query) {
                    // Check if manager_id exists in the users table
                    $query->where('uuid', request('manager_id'));
                }),
            ],
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|numeric|digits:10',
        ];
    }
}
