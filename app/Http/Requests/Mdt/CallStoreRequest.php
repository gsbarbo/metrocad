<?php

namespace App\Http\Requests\Mdt;

use App\Enum\CallNatures;
use App\Enum\CallResource;
use App\Enum\CallStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CallStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'postal' => ['required', 'numeric'],
            'street' => ['required'],
            'city' => ['required'],
            'resource' => ['required', Rule::enum(CallResource::class)],
            'nature' => ['required', Rule::enum(CallNatures::class)],
            'source' => ['required', 'string'],
            'priority' => ['required', 'integer'],
            'status' => ['required', Rule::enum(CallStatus::class)],
            'narrative' => ['required', 'max:2000'],
            'linked_civilians' => 'nullable|array',
            'linked_civilians_types' => 'nullable|array',
            'linked_vehicles' => 'nullable|array',
            'linked_vehicles_types' => 'nullable|array',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
