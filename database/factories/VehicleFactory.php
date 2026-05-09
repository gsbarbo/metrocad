<?php

namespace Database\Factories;

use App\Enums\Civilian\VehicleStatus;
use App\Models\Civilian;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Vehicle>
 */
class VehicleFactory extends Factory
{
    public function definition(): array
    {
        return [
            'civilian_id' => Civilian::factory(),
            'license_plate' => strtoupper(fake()->bothify('???###')),
            'make' => fake()->randomElement(['Ford', 'Chevrolet', 'Toyota', 'Honda', 'Dodge', 'BMW', 'Mercedes']),
            'model' => fake()->randomElement(['F-150', 'Silverado', 'Camry', 'Civic', 'Charger', '3 Series', 'C-Class']),
            'color' => fake()->colorName(),
            'year' => fake()->numberBetween(2000, 2025),
            'status' => fake()->randomElement(VehicleStatus::cases()),
            'is_insured' => fake()->boolean(),
            'is_registered' => fake()->boolean(),
        ];
    }
}
