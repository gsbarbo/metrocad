<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('civilian_report', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Civilian::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\Report::class)->constrained()->cascadeOnDelete();

            $table->string('role')->nullable();
            $table->boolean('arrested')->default(false);
            $table->boolean('cited')->default(false);

            // Prevent duplicates (same civilian on same report twice)
            $table->unique(['civilian_id', 'report_id']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('civilian_report');
    }
};
