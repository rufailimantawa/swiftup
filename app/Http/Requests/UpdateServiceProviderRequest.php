<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateServiceProviderRequest extends FormRequest
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
            'name' => [
                'string',
                'min:3',
                'max:50',
                Rule::unique('services_providers')->ignore($this->provider->id)
            ],
            'url' => [
                'url',
                Rule::unique('services_providers')->ignore($this->provider->id)
            ],
            'api_url' => [
                'url',
                Rule::unique('services_providers')->ignore($this->provider->id)
            ],
            'status' => 'boolean'
        ];
    }
}
