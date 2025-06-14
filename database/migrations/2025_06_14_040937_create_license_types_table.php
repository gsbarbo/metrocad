<?php

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
        Schema::create('license_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('perm_name');
            $table->string('prefix')->nullable();
            $table->integer('length')->nullable();
            $table->string('type')->nullable();
            $table->string('format')->default('#########');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('license_types');
    }
};
