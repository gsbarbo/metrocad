<?php

namespace App\Enum;

enum CallStatus: string
{
    case RCVD = 'RCVD';
    case HLD = 'HLD';
    case ENRT = 'ENRT';
    case ARRVD = 'ARRVD';
    case CLR = 'CLR';
    case CLO = 'CLO';
    case CLO_RPT = 'CLO_RPT';
    case CLO_ULC = 'CLO_ULC';
    case CLO_ULA = 'CLO_ULA';
    case CLO_ULS = 'CLO_ULS';
    case CLO_VW = 'CLO_VW';
    case CLO_WW = 'CLO_WW';
    case CLO_CI = 'CLO_CI';
    case CLO_PA = 'CLO_PA';
    case CLO_MO = 'CLO_MO';
    case CLO_OT = 'CLO_OT';
    case CLO_TEST = 'CLO_TEST';

    public static function options(): array
    {
        return array_combine(
            array_map(fn (self $case) => $case->value, self::cases()),
            array_map(fn (self $case) => $case->label(), self::cases())
        );
    }

    public function label(): string
    {
        return match ($this) {
            self::RCVD => 'Call Open',
            self::HLD => 'Call On Hold',
            self::ENRT => 'Units Enroute',
            self::ARRVD => 'Units Arrived Onscene',
            self::CLR => 'Clear; Needs Report',
            self::CLO => 'Close; No Report',
            self::CLO_RPT => 'Report Made',
            self::CLO_ULC => 'Unable To Locate Complainant',
            self::CLO_ULA => 'Unable To Locate Address',
            self::CLO_ULS => 'Unable To Locate Suspect',
            self::CLO_VW => 'Verbal Warning',
            self::CLO_WW => 'Written Warning',
            self::CLO_CI => 'Citation Issued',
            self::CLO_PA => 'Person Arrested',
            self::CLO_MO => 'Made Contact',
            self::CLO_OT => 'Other',
            self::CLO_TEST => 'Test Call Cleared',
        };
    }

    public function code(): string
    {
        return $this->name;
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
