<?php

namespace App\Enums;

enum ViolationStatus: string
{
    case PENDING = 'pending';
    case VERIFIED = 'diverifikasi';
    case PROCESS = 'prosess'; // Sesuai dengan isi migration tabel violations
    case REJECTED = 'ditolak';

    // Mengubah data database menjadi teks Indonesia yang rapi saat dipanggil di Blade
    public function label(): string
    {
        return match ($this) {
            self::PENDING => 'Tunggu Verifikasi',
            self::VERIFIED => 'Diverifikasi',
            self::PROCESS => 'Sedang Diproses', // 👈 WAJIB DITAMBAHKAN
            self::REJECTED => 'Ditolak',
        };
    }

    // Warna badge Tailwind CSS yang minimalis dan modern
    public function color(): string
    {
        return match ($this) {
            self::PENDING => 'bg-orange-50 text-orange-600 border-orange-200/60',
            self::VERIFIED => 'bg-emerald-50 text-emerald-600 border-emerald-200/60',
            self::PROCESS => 'bg-blue-50 text-blue-600 border-blue-200/60',     // 👈 WAJIB DITAMBAHKAN
            self::REJECTED => 'bg-rose-50 text-rose-600 border-rose-200/60',
        };
    }
}