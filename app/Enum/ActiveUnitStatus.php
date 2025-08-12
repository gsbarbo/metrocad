<?php

namespace App\Enum;

enum ActiveUnitStatus: string
{
    case Available = 'AVL';
    case AtStation = 'AVL - AT STN';
    case EnRoute = 'ENRUTE';
    case Transporting = 'TRNSP';
    case OnScene = 'ONSCN';
    case EnRouteToStation = 'ENRUTE - STN';

    case Busy = 'BSY';
    case Break = 'BRK';
    case OffDuty = 'OFFDTY';

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
            self::Available => 'Available',
            self::AtStation => 'At Station',
            self::EnRoute => 'En Route',
            self::Transporting => 'Transporting',
            self::OnScene => 'On Scene',
            self::EnRouteToStation => 'En Route to Station',
            self::Busy => 'Busy',
            self::Break => 'Break',
            self::OffDuty => 'Off Duty',
        };
    }
}
