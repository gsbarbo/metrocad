<?php

namespace App\Models;

use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable as AuditingAuditable;
use OwenIt\Auditing\Contracts\Auditable;

class License extends Model implements Auditable
{
    use AuditingAuditable, CascadeSoftDeletes, SoftDeletes;

    protected $guarded = [];

    protected $cascadeDeletes = [];

    protected $casts = [
        'expires_at' => 'date',
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
}
