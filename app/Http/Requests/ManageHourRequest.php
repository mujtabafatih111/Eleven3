<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ManageHourRequest extends FormRequest
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
            'hour_start' => 'required',
            'hour_end' => 'required',
            'category_id' => 'required_with:specific_service_hour_start,specific_service_hour_end|integer|nullable',
            'sub_category_id' => 'required_with:specific_service_hour_start,specific_service_hour_end|integer|nullable',
            'specific_service_hour_start' => 'required_with:category_id|required_with:sub_category_id|nullable',
            'specific_service_hour_end'   => 'required_with:category_id|required_with:sub_category_id|nullable'
        ];
    }

    public function messages()
    {
        return [

            'hour_start.required' => 'Hour of availability start time is required.',
            'hour_end.required' => 'Hour of availability end time is required.',
            'specific_service_hour_start.require' =>'Specific service hour start time is required.',
            'specific_service_hour_end.required' => 'Specific service hour end time is required.'
        ];
    }
}
