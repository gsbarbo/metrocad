<?php

namespace App\Http\Requests\Admin\Settings;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class RoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Gate::allows('admin:roles:access');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'name' => 'required|string',
            'permissions' => 'required|array',
        ];

        if (get_setting('discord.useRoles')) {
            $rules['discord_role_id'] = 'numeric|required';
        } else {
            $rules['discord_role_id'] = 'numeric|nullable';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'discord_role_id.numeric' => 'You must choose a Discord role.',
            'permissions.required' => 'You must choose at least one permission.',
        ];
    }
}
