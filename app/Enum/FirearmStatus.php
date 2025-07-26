<?php

namespace App\Enum;

use App\Interface\StatusEnumInterface;

enum FirearmStatus: int implements StatusEnumInterface
{
    case VALID = 1;
    case STOLEN = 2;
    case FORSALE = 3;
    case IMPOUNDED = 4;
    case PENDING = 5;

    public function name(): string
    {
        return match ($this) {
            self::VALID => 'Valid',
            self::STOLEN => 'Stolen',
            self::FORSALE => 'For Sale',
            self::IMPOUNDED => 'Impounded',
            self::PENDING => 'Pending',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::VALID => 'green',
            self::STOLEN => 'red',
            self::FORSALE => 'green',
            self::IMPOUNDED => 'red',
            self::PENDING => 'blue',
        };
    }
}
