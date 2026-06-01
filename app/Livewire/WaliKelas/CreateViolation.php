<?php

namespace App\Livewire\WaliKelas;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Violation;
use App\Models\Student;
use App\Models\Rule;
use Illuminate\Support\Facades\Auth;

class CreateViolation extends Component
{
    use WithFileUploads;

    // Form Properties
    public $student_id = '';
    public $rule_id = '';
    public $notes = '';
    public $evidence;

    // Aturan Validasi Form
    protected $rules = [
        'student_id' => 'required|exists:students,id',
        'rule_id' => 'required|exists:rules,id',
        'notes' => 'nullable|string|max:1000',
        'evidence' => 'nullable|image|max:2048', // Maksimal file foto 2MB
    ];

    // Pesan Error Bahasa Indonesia
    protected $messages = [
        'student_id.required' => 'Nama siswa wajib dipilih.',
        'student_id.exists' => 'Siswa tidak ditemukan di database.',
        'rule_id.required' => 'Jenis pelanggaran wajib dipilih.',
        'rule_id.exists' => 'Peraturan tidak valid.',
        'evidence.image' => 'Bukti laporan harus berupa file gambar.',
        'evidence.max' => 'Ukuran foto terlalu besar, maksimal 2MB.',
    ];

    public function saveViolation()
    {
        $this->validate();

        $evidencePath = null;

        // Proses penyimpanan file gambar (baik upload berkas atau jepretan kamera HP)
        if ($this->evidence) {
            $evidencePath = $this->evidence->store('evidences', 'public');
        }

        // Simpan data pelanggaran baru ke database
        Violation::create([
            'student_id' => $this->student_id,
            'rule_id' => $this->rule_id,
            'reported_by' => Auth::id(), // ID User yang sedang login (Wali Kelas atau Guru)
            'notes' => $this->notes,
            'evidence' => $evidencePath,
            'status' => 'pending', // Menunggu verifikasi oleh Guru Piket / Admin
        ]);

        // Berikan sinyal sukses menggunakan Flash Session
        session()->flash('success', 'Laporan pelanggaran siswa berhasil dikirim dan menunggu verifikasi.');

        // Redirect dinamis berdasarkan role user yang mengakses form ini
        $user = Auth::user();
        
        if ($user->hasRole('wali_kelas')) {
            return redirect()->route('walikelas.riwayat-pelanggaran');
        } elseif ($user->hasRole('guru') || $user->hasRole('piket')) {
            // Jika guru biasa, kembalikan ke halaman form kosong atau riwayat yang ditentukan
            return redirect()->route('teacher.violations');
        }

        return redirect()->route('dashboard');
    }

    public function render()
    {
        return view('livewire.wali-kelas.create-violation', [
            'students' => Student::orderBy('name', 'asc')->get(),
            'rules' => Rule::orderBy('name', 'asc')->get(),
        ])->layout('layouts.app'); // Ganti 'layouts.app' jika Anda menggunakan nama layout komponen yang berbeda
    }
}