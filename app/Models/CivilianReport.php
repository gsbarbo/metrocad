<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CivilianReport extends Model
{
    use SoftDeletes;

    protected $table = 'civilian_report';

    protected $casts = [
        'arrested' => 'boolean',
        'cited' => 'boolean',
    ];

    public function report()
    {
        return $this->belongsTo(Report::class);
    }

    public function civilian()
    {
        return $this->belongsTo(Civilian::class);
    }
}
