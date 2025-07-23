<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable as AuditingAuditable;
use OwenIt\Auditing\Contracts\Auditable;

class Address extends Model implements Auditable
{
    use AuditingAuditable, SoftDeletes;

    protected $casts = [
        'created_at' => 'datetime',
    ];

    public function getFullAddressAttribute()
    {
        return $this->postal.' '.$this->street.', '.$this->city;
    }
}
