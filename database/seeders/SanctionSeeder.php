<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sanction;
use App\Models\Violation;

class SanctionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil pelanggaran yang berstatus pending/terverifikasi untuk dipasangkan sanksi
        $violations = Violation::take(3)->get();

        $mockActions = [
            'Membersihkan kaca jendela kelas dan membuang sampah.',
            'Membaca kitab suci di perpustakaan selama 30 menit.',
            'Merapikan barisan sepatu siswa di depan koridor masjid sekolah.'
        ];

        foreach ($violations as $index => $violation) {
            Sanction::create([
                'violation_id' => $violation->id,
                'action'       => $mockActions[$index] ?? 'Melakukan bakti sosial lingkungan sekolah.',
                'status'       => 'pending',
                'evidence_path'=> null,
                'notes'        => null,
            ]);
        }
    }
}
