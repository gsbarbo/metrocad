<?php

use App\Enum\FirearmStatus;
use App\Models\Civilian;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('firearms', function (Blueprint $table) {
            $table->id();
            $table->string('serial_number');
            $table->string('model');
            $table->string('type')->nullable();
            $table->integer('status')->default(FirearmStatus::Valid);
            $table->foreignIdFor(Civilian::class)->constrained();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('firearms');
    }
};
