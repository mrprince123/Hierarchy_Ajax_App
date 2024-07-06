<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeDetails extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'mobile_number' => 'required',
            'profile_pic' => 'required',
            'parents_name' => 'required',
            'current_address' => 'required',
            'parmanent_address' => 'required',
            'adhar_number' => 'required',
            'date_of_birth' => 'required',
            'gender' => 'required',
            'emergency_contact_no' => 'required',
            'email' => 'required|email|unique:employees',
            'roles_id' => 'required',
            'age' => 'required',
            'highest_qualification' => 'required'
        ];
    }
}
