<?php

namespace App\Enum;

use App\Interface\StatusEnumInterface;

enum LicenseStatus: int implements StatusEnumInterface
{
    case Valid = 1;
    case Expired = 2;
    case Suspended = 3;
    case Revoked = 4;
    case Pending = 5;

    public function name(): string
    {
        return match ($this) {
            self::Valid => 'Valid',
            self::Expired => 'Expired',
            self::Suspended => 'Suspended',
            self::Revoked => 'Revoked',
            self::Pending => 'Pending',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::Valid => 'green',
            self::Expired => 'red',
            self::Suspended => 'red',
            self::Revoked => 'red',
            self::Pending => 'blue',
        };
    }
}
