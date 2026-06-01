<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\ViolationStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Violation extends Model
{
    use HasFactory;

    // ⚡ SEKARANG SUDAH AMAN: Semua kolom penting termasuk verified_at sudah didaftarkan
    protected $fillable = [
        'student_id',
        'rule_id',
        'reported_by',
        'verified_by',
        'status',
        'notes',
        'evidence',
        'verified_at', // 👈 Ditambahkan agar waktu verifikasi bisa tersimpan
    ];

    protected $casts = [
        'status' => ViolationStatus::class,
        'verified_at' => 'datetime', // 👈 Ditambahkan agar format tanggal otomatis rapi
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIPS
    |--------------------------------------------------------------------------
    */

    // Siswa pelanggar
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    // Aturan yang dilanggar
    public function rule()
    {
        return $this->belongsTo(Rule::class);
    }

    // Pelapor
    public function reporter()
    {
        return $this->belongsTo(User::class, 'reported_by');
    }

    // Verifier / Yang menyetujui atau menolak
    public function verifier()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    // Sanksi terkait
    public function sanction()
    {
        return $this->hasOne(Sanction::class);
    }
}