<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ActiveUnit extends Model
{
    use SoftDeletes;

    protected $with = ['civilian', 'user_department', 'user'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function user_department(): BelongsTo
    {
        return $this->belongsTo(UserDepartment::class);
    }

    public function civilian(): BelongsTo
    {
        return $this->belongsTo(Civilian::class);
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
