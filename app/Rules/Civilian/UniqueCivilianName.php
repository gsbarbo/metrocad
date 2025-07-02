<?php

namespace App\Rules\Civilian;

use App\Models\Civilian;
use Closure;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidationRule;

class UniqueCivilianName implements DataAwareRule, ValidationRule
{
    protected $data = [];

    public function setData(array $data): static
    {
        $this->data = $data;

        return $this;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! get_setting('allow_same_name_civilians', 0)) {
            $result = Civilian::where('first_name', $this->data['first_name'])->where('last_name', $this->data['last_name'])->get();

            if ($result->count() != 0) {
                $fail('The civilian name must be unique. This name is already taken.');
            }
        }
    }
}
