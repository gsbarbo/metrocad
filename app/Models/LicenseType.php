<?php

namespace App\Models;

use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable as AuditingAuditable;
use OwenIt\Auditing\Contracts\Auditable;

class LicenseType extends Model implements Auditable
{
    use AuditingAuditable, CascadeSoftDeletes;

    protected $cascadeDeletes = []; // licenses,

    protected $guarded = [];
}
