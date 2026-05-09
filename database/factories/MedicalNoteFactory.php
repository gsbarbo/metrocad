<?php

namespace Database\Factories;

use App\Enums\Civilian\MedicalNoteType;
use App\Models\Civilian;
use App\Models\MedicalNote;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<MedicalNote>
 */
class MedicalNoteFactory extends Factory
{
    public function definition(): array
    {
        return [
            'civilian_id' => Civilian::factory(),
            'type' => fake()->randomElement(MedicalNoteType::cases()),
            'details' => fake()->sentence(),
        ];
    }
}
