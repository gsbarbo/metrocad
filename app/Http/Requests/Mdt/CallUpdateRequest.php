<?php

namespace App\Http\Requests\Mdt;

use App\Enum\CallNatures;
use App\Enum\CallResource;
use App\Enum\CallStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CallUpdateRequest extends FormRequest
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
            'resource' => ['required', Rule::enum(CallResource::class)],
            'nature' => ['required', Rule::enum(CallNatures::class)],
            'priority' => ['required', 'integer'],
            'status' => ['required', Rule::enum(CallStatus::class)],
        ];
    }
}
