<?php

namespace App\Enum\Civilian;

enum RaceSelection:
{
    case RACES = [
        'white' => 'White',
        'african_american' => 'African American',
        'latino' => 'Latino',
        'asian' => 'Asian',
        'american_indian' => 'American Indian',
        'pacific_islander' => 'Native Hawaiian or Other Pacific Islander',
        'other' => 'Other',
    ];

    public static function getRace($race)
    {
        return self::RACES[$race];
    }
}
