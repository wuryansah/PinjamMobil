<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdminAssignRequest extends FormRequest
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
        $action = $this->input('action');

        if ($action === 'reject') {
            return [
                'notes' => ['required', 'string'],
                'action' => ['required', Rule::in(['approve', 'reject'])],
            ];
        }

        return [
            'vehicle_id' => ['required', 'exists:vehicles,id'],
            'driver_id' => ['nullable', 'exists:users,id'],
            'notes' => ['nullable', 'string'],
            'action' => ['required', Rule::in(['approve', 'reject'])],
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
            'driver_id.exists' => 'Selected driver does not exist.',
            'action.required' => 'Action is required.',
            'action.in' => 'Action must be either approve or reject.',
        ];
    }
}
