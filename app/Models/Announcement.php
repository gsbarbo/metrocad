<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable as AuditingAuditable;
use OwenIt\Auditing\Contracts\Auditable;

class Announcement extends Model implements Auditable
{
    use AuditingAuditable, SoftDeletes;

    public $with = ['department', 'user'];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class)->withTrashed();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
