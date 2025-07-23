<?php

namespace App\Enum;

use App\Interface\StatusEnumInterface;

enum LicenseStatuses: int implements StatusEnumInterface
{
    case VALID = 1;

    case EXPIRED = 2;

    case SUSPENDED = 3;

    case REVOKED = 4;

    case PENDING = 5;

    public function name(): string
    {
        return match ($this) {
            self::VALID => 'Valid',
            self::EXPIRED => 'Expired',
            self::SUSPENDED => 'Suspended',
            self::REVOKED => 'Revoked',
            self::PENDING => 'Pending',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::VALID => 'green',
            self::EXPIRED => 'red',
            self::SUSPENDED => 'red',
            self::REVOKED => 'red',
            self::PENDING => 'blue',
        };
    }
}
