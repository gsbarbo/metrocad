<?php

namespace App\Models;

use App\Enum\ReportStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Report extends Model
{
    use SoftDeletes;

    protected $with = ['reportType', 'officer', 'call', 'civilians'];

    protected $casts = [
        'status' => ReportStatus::class,
    ];

    public function reportType(): BelongsTo
    {
        return $this->belongsTo(ReportType::class);
    }

    public function call(): BelongsTo
    {
        return $this->belongsTo(Call::class);
    }

    public function officer(): BelongsTo
    {
        return $this->belongsTo(Officer::class);
    }

    public function civilians(): BelongsToMany
    {
        return $this->belongsToMany(Civilian::class, 'civilian_report')
            ->withPivot('role', 'arrested', 'cited')
            ->without(['licenses', 'medical_records', 'vehicles', 'firearms'])
            ->withTimestamps();
    }
}
