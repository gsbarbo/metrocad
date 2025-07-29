<?php

namespace App\Enum;

use App\Interface\StatusEnumInterface;

enum FirearmStatus: int implements StatusEnumInterface
{
    case Valid = 1;
    case Stolen = 2;
    case ForSale = 3;
    case Impounded = 4;
    case Pending = 5;

    public function name(): string
    {
        return match ($this) {
            self::Valid => 'Valid',
            self::Stolen => 'Stolen',
            self::ForSale => 'For Sale',
            self::Impounded => 'Impounded',
            self::Pending => 'Pending',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::Valid => 'green',
            self::Stolen => 'red',
            self::ForSale => 'green',
            self::Impounded => 'red',
            self::Pending => 'blue',
        };
    }
}
