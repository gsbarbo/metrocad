<?php

namespace App\Enum;

use App\Interface\BaseEnumInterface;
use App\Traits\BaseEnumTrait;

enum ReportStatus: string implements BaseEnumInterface
{
    use BaseEnumTrait;

    case DRAFT = 'draft';
    case PENDING = 'pending_review';
    case COMPLETED = 'completed';
    case REJECTED = 'rejected';

}
