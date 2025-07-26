<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Firearm extends Model
{
    use SoftDeletes;

    protected $casts = [
    ];

    public function civilian()
    {
        return $this->belongsTo(Civilian::class);
    }
}
