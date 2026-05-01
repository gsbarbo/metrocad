<?php

namespace App\Rules\Civilian;

use App\Models\Civilian;
use Closure;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidationRule;

class UniqueCivilianName implements DataAwareRule, ValidationRule
{
    protected array $data = [];

    public function setData(array $data): static
    {
        $this->data = $data;

        return $this;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! setting('civilian.allowDuplicateCivilianNames')) {
            $result = Civilian::query()
                ->where('first_name', $this->data['first_name'])
                ->where('last_name', $this->data['last_name'])
                ->count();

            if ($result != 0) {
                $fail('The civilian name must be unique. This name is already taken.');
            }
        }
    }
}
