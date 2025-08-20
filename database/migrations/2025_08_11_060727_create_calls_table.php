<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('calls', function (Blueprint $table) {
            $table->id();
            $table->string('nature');
            $table->text('narrative');
            $table->integer('priority');
            $table->string('resource');
            $table->string('status');
            $table->integer('postal')->nullable();
            $table->string('street')->nullable();
            $table->string('city')->nullable();

            $table->string('source');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('calls');
    }
};
