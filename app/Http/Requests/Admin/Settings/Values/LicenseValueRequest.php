<?php

namespace App\Http\Requests\Admin\Settings\Values;

use Illuminate\Foundation\Http\FormRequest;

class LicenseValueRequest extends FormRequest
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
            'name' => 'required',
            'format' => ['required', 'min:5', 'max:25', 'regex:/^[A#]+$/i'],
            'prefix' => 'nullable|string',
        ];
    }
}
