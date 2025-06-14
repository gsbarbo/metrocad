<?php

namespace App\Models;

use App\Enum\Civilian\GenderSelection;
use App\Enum\Civilian\HeightSelection;
use App\Enum\Civilian\RaceSelection;
use App\Enum\Civilian\WeightSelection;
use Carbon\Carbon;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable as AuditingAuditable;
use OwenIt\Auditing\Contracts\Auditable;

class Civilian extends Model implements Auditable
{
    use AuditingAuditable, CascadeSoftDeletes, SoftDeletes;

    public $incrementing = false;

    protected $cascadeDeletes = ['licenses']; // vehicles, licenses, medical, firearms,

    protected $guarded = [];

    protected $casts = [
        'created_at' => 'datetime',
        'deleted_at' => 'datetime',
        'updated_at' => 'datetime',
        'date_of_birth' => 'date',
    ];

    public function getSNNAttribute()
    {
        return implode('-', str_split($this->id, 3));
    }

    public function getStatusNameAttribute()
    {
        switch ($this->status) {
            case 1:
                return 'Alive';
                break;
            case 2:
                return 'Wanted';
                break;
            case 3:
                return 'Jailed';
                break;
            case 4:
                return 'Dead';
                break;
            case 5:
                return 'Hospitalized';
                break;
        }
    }

    public function getNameAttribute()
    {
        return $this->first_name.' '.$this->last_name;
    }

    public function getWeightFormatAttribute()
    {
        return WeightSelection::getWeight($this->weight);
    }

    public function getHeightFormatAttribute()
    {
        return HeightSelection::getHeight($this->height);
    }

    public function getGenderFormatAttribute()
    {
        return GenderSelection::getGender($this->gender);
    }

    public function getRaceFormatAttribute()
    {
        return RaceSelection::getRace($this->race);
    }

    public function getAddressAttribute()
    {
        return $this->postal.' '.$this->street.' '.$this->city;
    }

    public function getAgeAttribute()
    {
        $birthday = $this->date_of_birth;
        $age = Carbon::parse($birthday)->age;

        return $age;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function licenses()
    {
        return $this->hasMany(License::class);
    }
}
