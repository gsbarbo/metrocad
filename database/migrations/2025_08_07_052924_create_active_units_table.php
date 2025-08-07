<?php

use App\Models\Civilian;
use App\Models\User;
use App\Models\UserDepartment;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('active_units', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained('users');
            $table->foreignIdFor(UserDepartment::class)->constrained('user_departments');
            $table->foreignIdFor(Civilian::class)->constrained('civilians');
            $table->integer('department_type_id');

            $table->boolean('is_panic')->default(false);

            $table->text('description')->nullable();
            $table->text('location')->nullable();
            $table->text('status')->nullable();
            $table->text('alpr')->nullable();
            $table->string('subdivision')->nullable();

            $table->timestamp('on_duty_at')->nullable();
            $table->timestamp('off_duty_at')->nullable();
            $table->integer('off_duty_type_id')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('active_units');
    }
};
