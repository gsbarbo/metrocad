<?php

namespace App\Http\Requests\Workbench;

use Illuminate\Foundation\Http\FormRequest;

class OfficerUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'badge_number' => ['required', 'string', 'max:255'],
            'rank' => ['required', 'string', 'max:255'],
            'user_department_id' => ['nullable', 'integer'],
            'image_url' => ['url', 'nullable'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
