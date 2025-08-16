<?php

use App\Models\Officer;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('user_departments', function (Blueprint $table) {
            $table->foreignIdFor(Officer::class)->after('rank')->nullable()->constrained();
        });
    }

    public function down(): void
    {
        Schema::table('user_departments', function (Blueprint $table) {
            $table->dropForeign(['officer_id']);
            $table->dropColumn('officer_id');
        });
    }
};
