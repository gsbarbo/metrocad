<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Officer extends Model
{
    use SoftDeletes;

    public function getNameAttribute()
    {
        return $this->first_name.' '.$this->last_name;
    }
}
