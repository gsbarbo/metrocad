<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CallCivilian extends Model
{
    use SoftDeletes;

    protected $with = ['civilian'];

    public function civilian()
    {
        return $this->hasOne(Civilian::class, 'id', 'civilian_id')->without(['licenses', 'medical_records', 'vehicles', 'weapons'])->withTrashed();
    }
}
