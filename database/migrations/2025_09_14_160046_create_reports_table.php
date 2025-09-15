<?php

use App\Models\Call;
use App\Models\Officer;
use App\Models\ReportType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(ReportType::class)->constrained('report_types');
            $table->foreignIdFor(Call::class)->constrained('calls');
            $table->foreignIdFor(Officer::class)->constrained('officers');

            $table->text('narrative')->nullable();
            $table->string('status')->default('draft');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
