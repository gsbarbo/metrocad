<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class CallMessage extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'call_id',
        'officer_id',
        'message',
    ];

    public function call(): BelongsTo
    {
        return $this->belongsTo(Call::class);
    }

    public function officer(): BelongsTo
    {
        return $this->belongsTo(Officer::class);
    }
}
