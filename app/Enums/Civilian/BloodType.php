<?php

namespace App\Enums\Civilian;

use App\Traits\BaseEnumTrait;

enum BloodType: string
{
    use BaseEnumTrait;

    case APositive = 'a+';
    case ANegative = 'a-';
    case BPositive = 'b+';
    case BNegative = 'b-';
    case ABPositive = 'ab+';
    case ABNegative = 'ab-';
    case OPositive = 'o+';
    case ONegative = 'o-';
    case Unknown = 'unknown';

    public function label(): string
    {
        return match ($this) {
            self::APositive => 'A+',
            self::ANegative => 'A-',
            self::BPositive => 'B+',
            self::BNegative => 'B-',
            self::ABPositive => 'AB+',
            self::ABNegative => 'AB-',
            self::OPositive => 'O+',
            self::ONegative => 'O-',
            self::Unknown => 'Unknown',
        };
    }
}
