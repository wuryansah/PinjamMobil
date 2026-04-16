<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompleteTripRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'end_km' => 'required|numeric|min:0',
            'fuel_used' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'end_km.required' => 'Ending kilometer is required.',
            'end_km.numeric' => 'Ending kilometer must be a number.',
            'end_km.min' => 'Ending kilometer must be a positive number.',
            'fuel_used.numeric' => 'Fuel used must be a number.',
            'fuel_used.min' => 'Fuel used must be a positive number.',
        ];
    }
}
