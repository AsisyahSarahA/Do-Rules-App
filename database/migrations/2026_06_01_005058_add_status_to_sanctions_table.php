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
        Schema::table('sanctions', function (Blueprint $table) {
            // Menyimpan status sanksi, bawaannya adalah 'pending' (Tertunda)
            $table->string('status')->default('pending')->after('violation_id');
        });
    }

    public function down(): void
    {
        Schema::table('sanctions', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
