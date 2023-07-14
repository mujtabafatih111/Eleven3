<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProviderRegisterRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            
            'first_name' => 'string|required',
            'last_name' => 'string|required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'phone' => 'required',
            // 'country' => 'string|required',
            // 'gender' => 'required',
            // 'state' => 'string|required',
            // 'city' => 'string|required',
            // 'state_issued_id_number' => 'integer|required',
            // 'professional_license_numbers' => 'integer|required',
            // 'professional_associations' => 'string|required',
            // 'category_id' => 'required',
            // 'remote_service_offerings' => 'string|required',
            // 'on_demand_service_offerings' => 'required',
            'user_role' => 'required'
        ];
    }
}
