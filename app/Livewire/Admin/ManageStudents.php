<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Student;
use App\Models\User;
use App\Models\ClassRoom;
use App\Models\ParentModel;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;

#[Layout('layouts.app')]
class ManageStudents extends Component
{
    use WithPagination;

    // Tambahkan properti $email
    public $name, $nis, $email, $class_id, $parent_id, $studentId;
    public $search = '';
    public $isEdit = false;
    public $showForm = false;

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function save()
    {
        // Cari ID user jika dalam mode edit untuk pengecekan unique email
        $userId = $this->studentId ? Student::find($this->studentId)?->user_id : null;

        $this->validate([
            'name' => 'required',
            'nis' => 'required|unique:students,nis,' . $this->studentId,
            'email' => 'required|email|unique:users,email,' . $userId, // Validasi email unik di tabel users
            'class_id' => 'required',
        ]);

        if ($this->studentId) {
            // LOGIKA UPDATE DATA
            $student = Student::findOrFail($this->studentId);

            // Update akun User-nya terlebih dahulu
            if ($student->user) {
                $student->user->update([
                    'name' => $this->name,
                    'email' => $this->email,
                ]);
            }

            // Update data Siswa
            $student->update([
                'name' => $this->name,
                'nis' => $this->nis,
                'class_id' => $this->class_id,
                'parent_id' => $this->parent_id,
            ]);
        } else {
            // LOGIKA BUAT BARU
            // 1. Buat akun di tabel users. Password otomatis diisi NIS.
            $user = User::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => Hash::make($this->nis),
                'role' => 'siswa', // <-- Sesuaikan dengan string role siswa di aplikasimu (misal: 'siswa' atau 'student')
            ]);

            // 2. Hubungkan ID user baru ke data siswa
            Student::create([
                'user_id' => $user->id,
                'name' => $this->name,
                'nis' => $this->nis,
                'class_id' => $this->class_id,
                'parent_id' => $this->parent_id,
                'total_points' => 0
            ]);
        }

        $this->resetForm();
        $this->showForm = false;
        $this->dispatch('success', message: 'Data siswa dan akun login berhasil disimpan!');
    }

    public function edit($id)
    {
        $student = Student::with('user')->findOrFail($id);

        $this->studentId = $student->id;
        $this->name = $student->name;
        $this->nis = $student->nis;
        $this->email = $student->user?->email; // Ambil data email dari tabel user
        $this->class_id = $student->class_id;
        $this->parent_id = $student->parent_id;

        $this->isEdit = true;
        $this->showForm = true;
    }

    public function delete($id)
    {
        $this->dispatch('confirmDelete', id: $id);
    }

    #[On('deleteConfirmed')]
    public function deleteConfirmed($id)
    {
        $student = Student::find($id);
        if ($student) {
            // Hapus user terlebih dahulu (otomatis menghapus siswa karena cascade onDelete)
            if ($student->user) {
                $student->user->delete();
            } else {
                $student->delete();
            }
        }
        $this->dispatch('success', message: 'Data siswa dan akun berhasil dihapus!');
    }

    public function resetForm()
    {
        $this->reset(['name', 'nis', 'email', 'class_id', 'parent_id', 'studentId']);
        $this->isEdit = false;
    }

    public function render()
    {
        $students = Student::with(['classroom', 'parent', 'user'])
            ->when($this->search, function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('nis', 'like', '%' . $this->search . '%');
            })
            ->latest()
            ->paginate(10);

        $classes = ClassRoom::all();
        $parents = ParentModel::all();

        return view('livewire.admin.manage-students', [
            'students' => $students,
            'classes' => $classes,
            'parents' => $parents
        ]);
    }
}
