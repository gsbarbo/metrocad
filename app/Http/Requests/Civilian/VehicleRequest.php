<?php

namespace App\Http\Requests\Civilian;

use App\Enum\VehicleStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class VehicleRequest extends FormRequest
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
            'vehicle_type_id' => ['required', 'numeric'],
            'status' => ['required', 'numeric', Rule::enum(VehicleStatus::class)],
            'color' => ['required', 'string'],
            'plate' => ['required', 'string'],
        ];
    }
}
