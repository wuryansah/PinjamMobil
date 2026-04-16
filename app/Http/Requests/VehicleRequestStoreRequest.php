<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class VehicleRequestStoreRequest extends FormRequest
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
            'destination' => ['required', 'string', 'max:255'],
            'purpose' => ['required', 'string'],
            'start_datetime' => ['required', 'date', 'after_or_equal:now'],
            'end_datetime' => ['required', 'date', 'after:start_datetime'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'destination.required' => 'Destination is required.',
            'destination.max' => 'Destination must not exceed 255 characters.',
            'purpose.required' => 'Purpose is required.',
            'start_datetime.required' => 'Start date and time is required.',
            'start_datetime.after_or_equal' => 'Start date must be now or in the future.',
            'end_datetime.required' => 'End date and time is required.',
            'end_datetime.after' => 'End date must be after start date.',
        ];
    }
}
