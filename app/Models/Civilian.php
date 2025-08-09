<?php

namespace App\Models;

use App\Enum\CivilianStatus;
use App\Support\Civilian\GenderOptions;
use App\Support\Civilian\HeightOptions;
use App\Support\Civilian\RaceOptions;
use App\Support\Civilian\WeightOptions;
use Carbon\Carbon;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable as AuditingAuditable;
use OwenIt\Auditing\Contracts\Auditable;

class Civilian extends Model implements Auditable
{
    use AuditingAuditable, CascadeSoftDeletes, SoftDeletes;

    public $incrementing = false;

    protected $cascadeDeletes = ['licenses', 'vehicles', 'medical_records', 'firearms'];

    protected $guarded = [];

    protected $casts = [
        'created_at' => 'datetime',
        'deleted_at' => 'datetime',
        'updated_at' => 'datetime',
        'date_of_birth' => 'date',
        'status' => CivilianStatus::class,
    ];

    protected static function booted(): void
    {
        parent::boot();
        static::creating(function ($model) {
            $number = rand(100000000, 999999999);
            $model->id = $number;
            $model->user_id = auth()->user()->id;
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getSNNAttribute()
    {
        return implode('-', str_split($this->id, 3));
    }

    public function getDriversLicenseAttribute()
    {
        foreach ($this->licenses as $license) {
            if ($license->license_type_id === 1) {
                return $license;
            }
        }

        return false;
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

    public function user_department()
    {
        return $this->belongsTo(UserDepartment::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function licenses()
    {
        return $this->hasMany(License::class);
    }

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }

    public function firearms()
    {
        return $this->hasMany(Firearm::class);
    }

    public function medical_records()
    {
        return $this->hasMany(MedicalRecord::class);
    }

    #[Scope]
    protected function ownedByCurrentUser(Builder $query): void
    {
        $query->where('user_id', auth()->user()->id);
    }

    #[Scope]
    protected function ownedBy(Builder $query, int $user_id): void
    {
        $query->where('user_id', $user_id);
    }

    protected function race(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => RaceOptions::getRace($value),
        );
    }

    protected function gender(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => GenderOptions::getGender($value),
        );
    }

    protected function height(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => HeightOptions::getHeight($value),
        );
    }

    protected function weight(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => WeightOptions::getWeight($value),
        );
    }
}
