<?php

namespace App\Enum;

enum DepartmentType: int
{
    case LawEnforcement = 1;
    case Dispatch = 2;
    case Civilian = 3;
    case FireEMS = 4;
    case OtherInGame = 5;
    case OtherOutGame = 6;

    public static function options(): array
    {
        return array_combine(
            array_column(self::cases(), 'value'),
            array_map(fn (self $case) => $case->label(), self::cases())
        );
    }

    public function label(): string
    {
        return match ($this) {
            self::LawEnforcement => 'Law Enforcement',
            self::Dispatch => 'Dispatch',
            self::Civilian => 'Civilian',
            self::FireEMS => 'Fire/EMS',
            self::OtherInGame => 'Other (In-Game)',
            self::OtherOutGame => 'Other (Out-of-Game)'
        };
    }
}
