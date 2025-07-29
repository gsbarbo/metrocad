<?php

use App\Enum\CivilianStatus;
use App\Models\Address;
use App\Models\User;
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
        Schema::create('civilians', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained();
            $table->string('first_name');
            $table->string('last_name');
            $table->text('picture')->nullable();
            $table->date('date_of_birth');
            $table->string('gender');
            $table->string('race');
            $table->integer('height');
            $table->integer('weight');
            $table->integer('postal')->nullable();
            $table->string('street')->nullable();
            $table->string('city')->nullable();
            $table->foreignIdFor(Address::class)->nullable();

            $table->string('occupation')->nullable();

            $table->integer('status')->default(CivilianStatus::Alive->value);
            $table->boolean('is_active')->default(0);

            $table->string('phone_number')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('civilians');
    }
};
