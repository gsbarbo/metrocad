<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable as AuditingAuditable;
use OwenIt\Auditing\Contracts\Auditable;

class DiscordChannel extends Model implements Auditable
{
    use AuditingAuditable;

    protected $guarded = [];
}
