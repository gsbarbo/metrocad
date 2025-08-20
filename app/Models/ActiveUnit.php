<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class ActiveUnit extends Model
{
    use SoftDeletes;

    protected $with = ['officer', 'user_department', 'user'];

    protected $casts = [
        'status' => \App\Enum\ActiveUnitStatus::class,
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'first_on_duty_at' => 'datetime',
        'off_duty_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function user_department(): BelongsTo
    {
        return $this->belongsTo(UserDepartment::class);
    }

    public function officer(): BelongsTo
    {
        return $this->belongsTo(Officer::class);
    }

    public function activeUnit(): HasOne
    {
        return $this->hasOne(ActiveUnit::class);
    }

    public function getTimeAttribute()
    {
        $lastUpdatedAt = Carbon::parse($this->updated_at);
        $now = Carbon::now(config('app.timezone'));

        return floor($lastUpdatedAt->diffInMinutes($now));
    }

    protected function casts(): array
    {
        return [
            'is_panic' => 'boolean',
            'on_duty_at' => 'timestamp',
            'off_duty_at' => 'timestamp',
        ];
    }
}
