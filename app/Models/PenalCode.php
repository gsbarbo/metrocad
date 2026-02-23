<?php

namespace App\Models;

use App\Enum\PenalCodeCategory;
use App\Enum\PenalCodeType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PenalCode extends Model
{
    use SoftDeletes;

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'type' => PenalCodeType::class,
            'category' => PenalCodeCategory::class,
        ];
    }
}
