<?php

namespace App\Models;

use App\Enum\CallNatures;
use App\Enum\CallResource;
use App\Enum\CallStatus;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Call extends Model
{
    use SoftDeletes;

    protected $with = ['address'];

    protected $casts = [
        'status' => CallStatus::class,
        'nature' => CallNatures::class,
        'resource' => CallResource::class,
    ];

    public static function boot(): void
    {
        parent::boot();
        static::creating(
            function ($model) {
                $number = Call::where('id', 'like', date('y').'%')->withTrashed()->count() + 1;
                $model->id = date('y').str_pad($number, 5, '0', STR_PAD_LEFT);
            }
        );
    }

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }

    public function call_civilians()
    {
        return $this->hasMany(CallCivilian::class);
    }

    public function call_vehicles()
    {
        return $this->hasMany(CallVehicle::class);
    }

    public function getTimeAttribute(): int
    {
        $updated_at = Carbon::parse($this->updated_at);
        $now = Carbon::now(config('app.timezone'));

        return floor($updated_at->diffInMinutes($now));
    }
}
