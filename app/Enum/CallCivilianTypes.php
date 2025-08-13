<?php

namespace App\Enum;

enum CallCivilianTypes: string
{
    case REPORTER = 'reporter';
    case VICTIM = 'victim';
    case SUSPECT = 'suspect';
    case WITNESS = 'witness';
    case OTHER = 'other';

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
            self::REPORTER => 'Reporter',
            self::VICTIM => 'Victim',
            self::SUSPECT => 'Suspect',
            self::WITNESS => 'Witness',
            self::OTHER => 'Other',
        };
    }
}
