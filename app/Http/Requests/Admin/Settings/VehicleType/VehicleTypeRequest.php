<?php

namespace App\Http\Requests\Admin\Settings\VehicleType;

use Illuminate\Foundation\Http\FormRequest;

class VehicleTypeRequest extends FormRequest
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
            'type' => 'required',
            'make' => 'required',
            'model' => 'required',
            'price' => 'nullable|numeric',
            'is_emergency_vehicle' => 'required|boolean',
            'spawn_code' => 'nullable|string',
            'notes' => 'nullable|string',
        ];
    }
}
