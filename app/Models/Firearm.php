<?php

namespace App\Models;

use App\Enum\FirearmStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Firearm extends Model
{
    use SoftDeletes;

    protected $casts = [
        'status' => FirearmStatus::class,

    ];

    public function civilian()
    {
        return $this->belongsTo(Civilian::class);
    }
}
