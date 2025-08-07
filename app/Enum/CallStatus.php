<?php

namespace App\Enum;

enum CallStatus: string
{
    case RCVD = 'Call Open';
    case HLD = 'Call On Hold';
    case ENRT = 'Units Enroute';
    case ARRVD = 'Units Arrived Onscene';
    case CLR = 'Clear; Needs Report';
    case CLO = 'Close; No Report';
    case CLO_RPT = 'Report Made';
    case CLO_ULC = 'Unable To Locate Complainant';
    case CLO_ULA = 'Unable To Locate Address';
    case CLO_ULS = 'Unable To Locate Suspect';
    case CLO_VW = 'Verbal Warning';
    case CLO_WW = 'Written Warning';
    case CLO_CI = 'Citation Issued';
    case CLO_PA = 'Person Arrested';
    case CLO_MO = 'Made Contact';
    case CLO_OT = 'Other';
    case CLO_TEST = 'Test Call Cleared';

    public static function options(): array
    {
        return array_column(self::cases(), 'value', 'name');
    }

    public function color(): string
    {
        return match ($this) {
            self::RCVD => 'text-green-500',
            self::HLD => 'text-gray-500',
            self::ENRT => 'text-yellow-500',
            self::ARRVD => 'text-orange-500',
            self::CLR => 'text-gray-500',
            self::CLO => 'text-red-500',
            self::CLO_RPT => 'text-red-500',
            self::CLO_ULC => 'text-red-500',
            self::CLO_ULA => 'text-red-500',
            self::CLO_ULS => 'text-red-500',
            self::CLO_VW => 'text-red-500',
            self::CLO_WW => 'text-red-500',
            self::CLO_CI => 'text-red-500',
            self::CLO_PA => 'text-red-500',
            self::CLO_MO => 'text-red-500',
            self::CLO_OT => 'text-red-500',
            self::CLO_TEST => 'text-red-500',
        };
    }
}
