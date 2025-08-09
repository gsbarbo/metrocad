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
        // TODO: Add 10 codes for each status
        // TODO: Add color codes for each status
        return array_column(self::cases(), 'value', 'name');
    }
}
