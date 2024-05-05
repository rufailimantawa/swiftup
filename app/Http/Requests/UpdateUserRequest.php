<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
            'email' => [
                'required',
                'email:filter',
                'max:250',
                Rule::unique(
                    'users',
                    'email'
                )->ignore($this->user->email, 'email')
            ],
            'username' => [
                "required",
                "string",
                "min:3",
                "max:50",
                Rule::unique(
                    'users',
                    'username'
                )->ignore($this->user->username, 'username')
            ],
            'mobile_number' => [
                "required",
                "phone:NG",
                "min:3",
                "max:50",
                Rule::unique(
                    'users',
                    'mobile_number'
                )->ignore($this->user->mobile_number, 'mobile_number')
            ],
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required'
        ];
    }
}
