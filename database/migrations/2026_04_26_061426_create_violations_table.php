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
        Schema::create('violations', function (Blueprint $table) {
            $table->id();

            // Foreign Keys / Relasi
            $table->foreignId('student_id')->constrained();
            $table->foreignId('rule_id')->constrained();
            $table->foreignId('reported_by')->constrained('users');
            $table->foreignId('verified_by')->nullable()->constrained('users')->nullOnDelete();

            // Data Pelanggaran
            $table->text('notes')->nullable();
            $table->string('evidence')->nullable(); // Kolom bukti langsung di sini

            // Status & Jejak Waktu
            $table->enum('status', ['pending', 'diverifikasi', 'ditolak'])->default('pending');
            $table->timestamp('verified_at')->nullable(); // Kolom waktu verifikasi langsung di sini
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('violations');
    }
};
