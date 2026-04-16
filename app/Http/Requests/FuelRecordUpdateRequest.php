<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class FuelRecordUpdateRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'vehicle_id' => ['required', 'exists:vehicles,id'],
            'refuel_date' => ['required', 'date'],
            'kilometer' => ['required', 'numeric', 'min:0'],
            'fuel_amount' => ['required', 'numeric', 'min:0'],
            'fuel_type' => ['nullable', 'string', 'max:50'],
            'price_per_liter' => ['nullable', 'numeric', 'min:0'],
            'fuel_cost' => ['nullable', 'numeric', 'min:0'],
            'location' => ['nullable', 'string', 'max:255'],
            'notes' => ['nullable', 'string'],
            'attachments.*' => ['nullable', 'file', 'image', 'mimes:jpeg,png,jpg,gif,pdf', 'max:5120'],
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
            'vehicle_id.required' => 'Vehicle is required.',
            'vehicle_id.exists' => 'Selected vehicle does not exist.',
            'refuel_date.required' => 'Refuel date is required.',
            'kilometer.required' => 'Kilometer reading is required.',
            'fuel_amount.required' => 'Fuel amount is required.',
            'fuel_amount.min' => 'Fuel amount must be a positive number.',
            'attachments.*.file' => 'Each attachment must be a valid file.',
            'attachments.*.max' => 'Each attachment must not exceed 5MB.',
        ];
    }
}
