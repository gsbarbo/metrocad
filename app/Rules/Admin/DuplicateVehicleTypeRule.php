<?php

namespace App\Rules\Admin;

use App\Models\VehicleType;
use Closure;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidationRule;

class DuplicateVehicleTypeRule implements DataAwareRule, ValidationRule
{
    protected $data = [];

    public function setData(array $data): static
    {
        $this->data = $data;

        return $this;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $result = VehicleType::where('make', $this->data['make'])->where('model', $this->data['model'])->get();

        if ($result->count() != 0) {
            $fail('The vehicle make and model must be unique. This name is already taken.');
        }
    }
}
