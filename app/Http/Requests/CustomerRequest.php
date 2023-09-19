<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\EmailFull;
use Illuminate\Validation\Rule;

class CustomerRequest extends FormRequest
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
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required', 'string', 'email', 'max:255',
                // Rule::unique('customers')->ignore($this->id),
            ],
            'contact_person_phone' => ['required', 'digits:10'],
            'zip_code' => ['required', 'digits:6'],
            'address' => ['required', 'string', 'max:255'],
            'contact_person_name' => ['required', 'string', 'max:255'],
            'pan' => [
                'nullable',
                Rule::unique('customers')->ignore($this->id)
            ],
            'gst' => [
                'nullable',
                Rule::unique('customers')->ignore($this->id),
            ],


        ];
        return $rules;
    }
}
