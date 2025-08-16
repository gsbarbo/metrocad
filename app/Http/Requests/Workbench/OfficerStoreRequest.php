<?php

namespace App\Http\Requests\Workbench;

use Illuminate\Foundation\Http\FormRequest;

class OfficerStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'badge_number' => ['required', 'string', 'max:255'],
            'rank' => ['required', 'string', 'max:255'],
            'user_department_id' => ['required', 'integer'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
