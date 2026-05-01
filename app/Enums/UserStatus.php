<?php

namespace App\Enums;

use App\Traits\BaseEnumTrait;

enum UserStatus: string
{
    use BaseEnumTrait;

    case Pending = 'pending';
    case Active = 'active';
    case Suspended = 'suspended';
    case Banned = 'banned';
    case Former = 'former_member';
    case Denied = 'denied';

    public function isActive(): bool
    {
        return $this === self::Active;
    }

    public function canLogin(): bool
    {
        return $this === self::Active;
    }
}
