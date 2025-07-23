<?php

namespace App\Http\Requests\Admin\Settings\Values;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
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
            'postal' => ['required', 'numeric'],
            'street' => ['required'],
            'city' => ['required'],
            'name' => ['nullable', 'string'],
            'is_home' => ['required', 'boolean'],
            'is_business' => ['required', 'boolean'],
            'is_ownable' => ['required', 'boolean'],
        ];
    }
}
