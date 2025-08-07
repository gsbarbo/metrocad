<?php

namespace App\Rules\Civilian;

use App\Models\Vehicle;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class UniqueVehiclePlateRule implements ValidationRule
{
    protected array $data = [];

    public function setData(array $data): static
    {
        $this->data = $data;

        return $this;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! get_setting('allow_same_plate_vehicles', 0)) {
            $result = Vehicle::where('plate', $this->data['plate'])->get();

            if ($result->count() != 0) {
                $fail('The plate name must be unique. This plate is already taken.');
            }
        }
    }
}
