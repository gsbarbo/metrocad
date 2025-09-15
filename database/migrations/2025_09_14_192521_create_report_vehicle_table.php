<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('report_vehicle', function (Blueprint $table) {
            $table->id();
            $table->foreignId('report_id')->constrained()->cascadeOnDelete();
            $table->foreignId('vehicle_id')->constrained()->cascadeOnDelete();
            $table->string('type')->nullable();
            $table->boolean('is_impounded')->default(false);
            $table->boolean('is_towed')->default(false);
            $table->timestamps();

            $table->unique(['report_id', 'vehicle_id']); // prevent duplicates
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('report_vehicle');
    }
};
