<?php

namespace App\Enums\Civilian;

use App\Traits\BaseEnumTrait;

enum LicenseStatus: string
{
    use BaseEnumTrait;

    case Valid = 'valid';
    case Expired = 'expired';
    case Suspended = 'suspended';
    case Revoked = 'revoked';
    case Pending = 'pending';
}
