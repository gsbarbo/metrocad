<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserDepartment extends Model
{
    // use SoftDeletes;

    protected $with = ['department'];

    public function department(): HasOne
    {
        return $this->hasOne(Department::class, 'id', 'department_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function activeUnit(): HasOne
    {
        return $this->hasOne(ActiveUnit::class);
    }

    public function civilian(): BelongsTo
    {
        return $this->belongsTo(Civilian::class, 'id', 'user_department_id');
    }
}
