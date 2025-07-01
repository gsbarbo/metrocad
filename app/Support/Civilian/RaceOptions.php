<?php

namespace App\Support\Civilian;

class RaceOptions
{
    public static function getList(): array
    {
        return [
            'american_indian_alaska_native' => 'American Indian or Alaska Native',
            'asian' => 'Asian',
            'black_african_american' => 'Black or African American',
            'hispanic_latino' => 'Hispanic or Latino',
            'native_hawaiian_pacific' => 'Native Hawaiian or Other Pacific Islander',
            'white' => 'White',
            'other' => 'Other',
        ];
    }

    public static function getRace(string $race): string
    {
        return self::getList()[$race];
    }
}
