<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StartTripRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'start_km' => 'required|numeric|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'start_km.required' => 'Starting kilometer is required.',
            'start_km.numeric' => 'Starting kilometer must be a number.',
            'start_km.min' => 'Starting kilometer must be a positive number.',
        ];
    }
}
