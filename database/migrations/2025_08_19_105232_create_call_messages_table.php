<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('call_messages', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Call::class)->constrained();
            $table->foreignIdFor(\App\Models\Officer::class)->constrained();
            $table->text('message');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('call_messages');
    }
};
