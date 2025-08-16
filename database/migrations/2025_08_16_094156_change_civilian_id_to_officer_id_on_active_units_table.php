<?php

use App\Models\Officer;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('active_units', function (Blueprint $table) {
            $table->dropForeign(['civilian_id']);
            $table->dropColumn('civilian_id');
            $table->foreignIdFor(Officer::class)->after('user_department_id')->constrained();
        });
    }

    public function down(): void
    {
        Schema::table('active_units', function (Blueprint $table) {
            //
        });
    }
};
