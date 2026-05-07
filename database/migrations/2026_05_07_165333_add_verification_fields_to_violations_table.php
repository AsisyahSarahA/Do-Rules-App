<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('violations', function (Blueprint $table) {

            $table->foreignId('verified_by')
                ->nullable()
                ->after('reported_by')
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamp('verified_at')
                ->nullable()
                ->after('status');

        });
    }

    public function down(): void
    {
        Schema::table('violations', function (Blueprint $table) {

            $table->dropColumn([
                'verified_by',
                'verified_at'
            ]);

        });
    }
};
