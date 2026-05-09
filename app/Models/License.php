<?php

namespace App\Models;

use App\Enums\Civilian\LicenseStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class License extends Model
{
    use SoftDeletes;

    protected $cascadeDeletes = [];

    protected $casts = [
        'expires_at' => 'date',
        'status' => LicenseStatus::class,
    ];

    protected $with = ['license_type'];

    public function civilian()
    {
        return $this->belongsTo(Civilian::class);
    }

    public function license_type()
    {
        return $this->belongsTo(LicenseType::class);
    }

    public function getIsExpiredAttribute(): bool
    {
        if ($this->expires_at < date('Y-m-d')) {
            return true;
        }

        return false;
    }
}
