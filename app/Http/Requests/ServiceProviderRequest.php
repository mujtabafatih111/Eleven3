<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceProviderRequest extends FormRequest
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
            'category_id' => 'integer|required',
            'sub_category_id' => 'required|integer',
            'cost_per_unit_time' => 'integer|required',
        ];
    }

    public function messages()
    {
        return [

            'category_id.required' => 'Category field is required.',
            'sub_category_id.required' => 'Sub category field is required.',
            'cost_per_unit_time.required' => 'Cost per unit time field is required.',
        ];
    }
}
