<?php

namespace App\Enum;

use App\Interface\StatusEnumInterface;

enum VehicleStatus: int implements StatusEnumInterface
{
    case VALID = 1;
    case EXPIRED = 2;
    case STOLEN = 3;
    case IMPOUNDED = 4;
    case BOOTED = 5;
    case FORSALE = 6;
    case PENDING = 7;

    public function name(): string
    {
        return match ($this) {
            self::VALID => 'Valid',
            self::EXPIRED => 'Expired',
            self::STOLEN => 'Stolen',
            self::IMPOUNDED => 'Impounded',
            self::BOOTED => 'Booted',
            self::FORSALE => 'For Sale',
            self::PENDING => 'Pending',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::VALID => 'green',
            self::EXPIRED => 'red',
            self::STOLEN => 'yellow',
            self::IMPOUNDED => 'red',
            self::BOOTED => 'yellow',
            self::FORSALE => 'green',
            self::PENDING => 'blue',
        };
    }
}
