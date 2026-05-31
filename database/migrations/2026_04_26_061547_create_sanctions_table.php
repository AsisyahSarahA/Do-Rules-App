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
        Schema::create('sanctions', function (Blueprint $table) {
            $table->id();
            // Menghubungkan ke tabel violations bawaanmu
            $table->foreignId('violation_id')->constrained()->onDelete('cascade');
            $table->string('action'); // Deskripsi sanksi yang harus dilakukan
            $table->string('evidence_path')->nullable(); // Lokasi foto hasil kamera
            $table->enum('status', ['pending', 'completed'])->default('pending');
            $table->text('notes')->nullable(); // Catatan tambahan dari wali kelas
            $table->timestamp('completed_at')->nullable(); // Waktu penyelesaian sanksi
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sanctions');
    }
};
