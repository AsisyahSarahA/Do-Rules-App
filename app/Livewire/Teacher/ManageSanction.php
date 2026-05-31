<?php

namespace App\Livewire\Teacher;

use Livewire\Component;
use App\Models\Sanction;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ManageSanction extends Component
{
    public $selectedSanctionId;
    public $capturedImage; // Menampung string Base64 dari kamera
    public $notes;
    public $isModalOpen = false;

    // Pendengar event jika ada pembaruan dari sisi Javascript browser
    protected $listeners = ['photoCaptured' => 'setCapturedImage'];

    public function setCapturedImage($base64Data)
    {
        $this->capturedImage = $base64Data;
    }

    public function openSanctionModal($id)
    {
        $this->selectedSanctionId = $id;
        $this->capturedImage = null;
        $this->notes = '';
        $this->isModalOpen = true;
    }

    public function closeSanctionModal()
    {
        $this->isModalOpen = false;
    }

    public function submitEvidence()
    {
        $this->validate([
            'capturedImage' => 'required',
            'notes' => 'nullable|string|max:500',
        ], [
            'capturedImage.required' => 'Anda wajib mengambil foto bukti sanksi melalui kamera!',
        ]);

        // PERBAIKAN: Menggunakan Auth::user() agar seragam dan tidak memicu error/warning di IDE
        $user = Auth::user();

        $sanction = Sanction::findOrFail($this->selectedSanctionId);

        // Proses konversi Base64 menjadi file Gambar asli (.jpg)
        $imageTypeAndData = explode(',', $this->capturedImage);
        $imageData = base64_decode($imageTypeAndData[1]);

        $fileName = 'sanction_' . time() . '_' . $this->selectedSanctionId . '.jpg';

        // Menggunakan ID dari Facade Auth yang sudah divalidasi
        $filePath = 'walikelas/' . $user->id . '/sanctions/' . $fileName;

        // Simpan file ke folder storage/app/public/walikelas/{id}/sanctions/
        Storage::disk('public')->put($filePath, $imageData);

        // Perbarui data sanksi di database
        $sanction->update([
            'evidence_path' => $filePath,
            'status' => 'completed',
            'notes' => $this->notes,
            'completed_at' => now(),
        ]);

        $this->isModalOpen = false;
        session()->flash('message', 'Bukti sanksi berhasil diverifikasi secara real-time!');
    }

    public function render()
    {
        $user = Auth::user();

        // Mengambil sanksi murid yang terikat dengan kelas milik Wali Kelas aktif
        $sanctions = Sanction::with(['violation.student.classroom'])
            ->whereHas('violation.student.classroom', function ($query) use ($user) {
                $query->where('wali_kelas_id', $user->id);
            })
            ->latest()
            ->get();

        return view('livewire.teacher.manage-sanction', [
            'sanctions' => $sanctions
        ]);
    }
}
