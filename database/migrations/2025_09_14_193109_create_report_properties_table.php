<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('report_properties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('report_id')->constrained()->cascadeOnDelete();
            $table->string('name');         // Property name, e.g., "Drugs"
            $table->string('status')->nullable(); // Lost, Stolen, Impounded, Collected as Evidence
            $table->text('reason')->nullable();   // Reason for police custody
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('report_properties');
    }
};
