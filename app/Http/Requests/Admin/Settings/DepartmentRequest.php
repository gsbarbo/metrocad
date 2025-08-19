<?php

namespace App\Http\Requests\Admin\Settings;

use App\Enum\DepartmentType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DepartmentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'initials' => ['required', 'string', 'max:10'],
            'type' => ['required', 'string', Rule::enum(DepartmentType::class)],
            'image_url' => ['required', 'url', 'max:255'],
            'discord_role_id' => ['nullable', 'integer'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
