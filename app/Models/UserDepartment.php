<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserDepartment extends Model
{
    // use SoftDeletes;

    protected $with = ['department', 'civilian'];

    public function department(): HasOne
    {
        return $this->hasOne(Department::class, 'id', 'department_id');
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function civilian(): BelongsTo
    {
        return $this->belongsTo(Civilian::class, 'id', 'user_department_id');
    }
}
