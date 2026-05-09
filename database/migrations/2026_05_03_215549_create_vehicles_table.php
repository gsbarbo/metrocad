<?php

use App\Enums\Civilian\VehicleStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('civilian_id')->constrained()->cascadeOnDelete();
            $table->string('license_plate')->unique();
            $table->string('make');
            $table->string('model');
            $table->string('color');
            $table->unsignedSmallInteger('year');
            $table->char('vin', 17)->unique();
            $table->string('status')->default(VehicleStatus::Active->value);
            $table->boolean('is_insured')->default(false);
            $table->boolean('is_registered')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
