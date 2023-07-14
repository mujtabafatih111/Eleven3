<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentBookingRequest extends FormRequest
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
            'practitioner_id' => 'required|integer',
            'appointment_date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'duration' => 'required|string',
            'reason' => 'required|string',
            'notes' => 'required|string',
        ];
    }
}
