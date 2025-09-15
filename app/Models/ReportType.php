<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReportType extends Model
{
    use SoftDeletes;

    protected function casts(): array
    {
        return [
            'is_locked' => 'boolean',
        ];
    }
}
