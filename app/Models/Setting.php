<?php

namespace App\Models;

use App\Enums\SettingType;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $casts = [
        'type' => SettingType::class,
    ];
}
