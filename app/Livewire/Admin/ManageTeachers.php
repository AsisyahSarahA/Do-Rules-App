<?php

namespace App\Livewire\Admin; // Perbaikan: Double namespace dihapus

use Livewire\Component;
use App\Models\Teacher;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

#[Layout('layouts.app')]
class ManageTeachers extends Component
{
    use WithPagination;

    public $name, $nip, $phone, $email, $teacherId;
    public $isEdit = false;
    public $showForm = false;
    public $search = '';

    public function updatedSearch()
    {
        $this->resetPage();
    }

    // ================= SAVE (CREATE & UPDATE) =================
    public function save()
    {
        // 1. DEKLARASI: Ambil user_id terlebih dahulu jika modenya adalah Edit
        $userId = null;
        if ($this->isEdit) {
            $currentTeacher = Teacher::find($this->teacherId);
            $userId = $currentTeacher ? $currentTeacher->user_id : null;
        }

        // 2. VALIDASI: Sekarang $userId sudah aman digunakan di sini
        $this->validate([
            'name' => 'required|string|max:255',
            'nip' => 'required|numeric|unique:teachers,nip,' . $this->teacherId,
            'phone' => 'nullable|numeric',
            'email' => 'required|email|unique:users,email,' . $userId,
        ]);

        // 3. PROSES DATABASE
        DB::transaction(function () use ($userId) {
            if ($this->isEdit) {
                // Logika Update
                $teacher = Teacher::findOrFail($this->teacherId);
                $teacher->update([
                    'name' => $this->name,
                    'nip' => $this->nip,
                    'phone' => $this->phone,
                    'email' => $this->email,
                ]);

                if ($teacher->user_id) {
                    User::where('id', $teacher->user_id)->update([
                        'name' => $this->name,
                        'email' => $this->email,
                    ]);
                }
            } else {
                // Logika Create: Pasword otomatis diset dari NIP
                $user = User::create([
                    'name' => $this->name,
                    'email' => $this->email,
                    'password' => Hash::make($this->nip),
                    'role' => 'guru',
                ]);

                // Buat Data Detail di Table Teacher
                Teacher::create([
                    'user_id' => $user->id,
                    'name' => $this->name,
                    'nip' => $this->nip,
                    'phone' => $this->phone,
                    'email' => $this->email,
                    'status' => 'aktif'
                ]);
            }
        });

        $this->dispatch('success', message: $this->isEdit
            ? 'Data guru berhasil diperbarui!'
            : 'Guru & Akun Login berhasil didaftarkan! Password default adalah NIP Guru.');

        $this->resetForm();
    }

    // ================= EDIT =================
    public function edit($id)
    {
        $teacher = Teacher::findOrFail($id);

        $this->teacherId = $teacher->id;
        $this->name = $teacher->name;
        $this->nip = $teacher->nip;
        $this->phone = $teacher->phone;
        $this->email = $teacher->email;

        $this->isEdit = true;
        $this->showForm = true;
    }

    // ================= DELETE =================
    public function delete($id)
    {
        $this->dispatch('confirmDelete', id: $id);
    }

    #[On('deleteConfirmed')]
    public function deleteConfirmed($id)
    {
        $teacher = Teacher::find($id);
        if ($teacher) {
            if ($teacher->user_id) {
                User::find($teacher->user_id)?->delete();
            } else {
                $teacher->delete();
            }
            $this->dispatch('success', message: 'Data guru dan akun berhasil dihapus!');
        }
    }

    // ================= UPDATE ROLE USER =================
    public function setRole($teacherId, $role)
    {
        $teacher = Teacher::findOrFail($teacherId);
        if ($teacher->user_id) {
            User::where('id', $teacher->user_id)->update(['role' => $role]);
            $this->dispatch('success', message: 'Role login guru berhasil diubah!');
        } else {
            $this->dispatch('error', message: 'Guru ini belum memiliki akun login.');
        }
    }

    // ================= RESET =================
    public function resetForm()
    {
        $this->reset(['name', 'nip', 'phone', 'email', 'teacherId']);
        $this->isEdit = false;
        $this->showForm = false;
    }

    // ================= RENDER =================
    public function render()
    {
        $teachers = Teacher::with('user')
            ->when($this->search, function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('nip', 'like', '%' . $this->search . '%')
                  ->orWhere('email', 'like', '%' . $this->search . '%');
            })
            ->latest()
            ->paginate(10);

        return view('livewire.admin.manage-teachers', [
            'teachers' => $teachers
        ]);
    }
}
