<?php

namespace App\Models;

use App\Enums\Civilian\VehicleStatus;
use Database\Factories\VehicleFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vehicle extends Model
{
    /** @use HasFactory<VehicleFactory> */
    use HasFactory;

    protected $fillable = [
        'civilian_id',
        'license_plate',
        'make',
        'model',
        'color',
        'year',
        'vin',
        'status',
        'is_insured',
        'is_registered',
    ];

    protected $casts = [
        'status' => VehicleStatus::class,
        'is_insured' => 'boolean',
        'is_registered' => 'boolean',
        'year' => 'integer',
    ];

    protected static function booted(): void
    {
        parent::booted();

        static::creating(function (Vehicle $model) {
            $model->vin = static::generateVin();
        });
    }

    public function civilian(): BelongsTo
    {
        return $this->belongsTo(Civilian::class);
    }

    private static function generateVin(): string
    {
        $vinChars = 'ABCDEFGHJKLMNPRSTUVWXYZ0123456789';
        $wmiPrefixes = ['1HG', '2T3', '3VW', '1FA', '1G1', '2G1', '4T1', '5NP', '1N4', '2C3'];

        // WMI: 3 chars
        $vin = $wmiPrefixes[array_rand($wmiPrefixes)];

        // VDS: 5 chars
        for ($i = 0; $i < 5; $i++) {
            $vin .= $vinChars[random_int(0, strlen($vinChars) - 1)];
        }

        // Check digit: 0-9 (simplified)
        $vin .= random_int(0, 9);

        // Model year code: 1 char
        $yearCodes = 'ABCDEFGHJKLMNPRSTUVWXYZ123456789';
        $vin .= $yearCodes[random_int(0, strlen($yearCodes) - 1)];

        // Plant code: 1 char
        $plantCodes = 'ABCDEFGHJKLMNPRSTUVWXYZ';
        $vin .= $plantCodes[random_int(0, strlen($plantCodes) - 1)];

        // Sequential: 6 digits
        $vin .= str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        return $vin; // 3+5+1+1+1+6 = 17 chars
    }
}
