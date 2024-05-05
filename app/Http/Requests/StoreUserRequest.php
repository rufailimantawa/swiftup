<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'fullname' => "required|string|min:3|max:50",
            'email' => 'required|email:filter|max:250|unique:users',
            'username' => "required|string|min:3|max:50|unique:users",
            'mobile_number' => "required|phone:NG|min:3|max:50|unique:users",
            'password' => 'required|min:8|confirmed',
            'role' => 'required'            
        ];
    }
}
