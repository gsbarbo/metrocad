<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penal_codes', function (Blueprint $table) {
            $table->id();
            $table->string('title_number');
            $table->string('section_number');
            $table->string('code');
            $table->text('code_title');
            $table->text('code_description');
            $table->string('type');
            $table->string('category');
            $table->boolean('is_active');
            $table->integer('fine')->nullable();
            $table->integer('bail')->nullable();
            $table->integer('in_game_jail_time')->nullable();
            $table->integer('cad_jail_time')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penal_codes');
    }
};
