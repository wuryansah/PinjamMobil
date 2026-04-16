<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class VehicleStoreRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'plate_number' => ['required', 'string', 'unique:vehicles,plate_number'],
            'type' => ['required', Rule::in(['car', 'van', 'truck', 'motorcycle'])],
            'condition' => ['required', Rule::in(['good', 'needs_maintenance', 'unavailable'])],
            'driver_id' => ['nullable', 'exists:users,id'],
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
            'name.required' => 'Vehicle name is required.',
            'plate_number.required' => 'Plate number is required.',
            'plate_number.unique' => 'This plate number is already in use.',
            'type.required' => 'Vehicle type is required.',
            'type.in' => 'Vehicle type must be car, van, truck, or motorcycle.',
            'condition.required' => 'Vehicle condition is required.',
            'condition.in' => 'Condition must be good, needs_maintenance, or unavailable.',
            'driver_id.exists' => 'Selected driver does not exist.',
        ];
    }
}
