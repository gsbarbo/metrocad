<?php

namespace App\Models;

use App\Enums\Civilian\MedicalNoteType;
use Database\Factories\MedicalNoteFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MedicalNote extends Model
{
    /** @use HasFactory<MedicalNoteFactory> */
    use HasFactory;

    protected $fillable = ['civilian_id', 'type', 'details'];

    protected $casts = [
        'type' => MedicalNoteType::class,
    ];

    public function civilian(): BelongsTo
    {
        return $this->belongsTo(Civilian::class);
    }
}
