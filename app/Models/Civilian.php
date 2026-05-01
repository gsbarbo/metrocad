<?php

namespace App\Models;

use App\Enums\Civilian\BloodType;
use App\Enums\Civilian\EyeColor;
use App\Enums\Civilian\Gender;
use App\Enums\Civilian\HairColor;
use App\Enums\Civilian\Race;
use App\Enums\CivilianStatus;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Civilian extends Model
{
    protected $casts = [
        'eye_color' => EyeColor::class,
        'hair_color' => HairColor::class,
        'blood_type' => BloodType::class,
        'race' => Race::class,
        'gender' => Gender::class,
        'status' => CivilianStatus::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected static function booted(): void
    {
        parent::boot();
        static::creating(function ($model) {
            $number = rand(100000000, 999999999);
            $model->id = $number;
            $model->user_id = auth()->user()->id;
        });
    }

    public function getNameAttribute()
    {
        return $this->first_name.' '.$this->last_name;
    }

    public function getAgeAttribute()
    {
        $birthday = $this->date_of_birth;
        $age = Carbon::parse($birthday)->age;

        return $age;
    }

    public function getFullAddressAttribute()
    {
        return $this->postal.' '.$this->street.', '.$this->city;
    }
}
