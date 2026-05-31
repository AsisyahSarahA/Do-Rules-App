<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\ClassRoom;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'password', 'role'];
    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    /**
     * RELASI BARU: Menghubungkan User ke data Siswa
     */
    public function student()
    {
        return $this->hasOne(Student::class);
    }

    public function dutySchedules()
    {
        return $this->hasMany(DutySchedule::class);
    }

    /**
     * Check if the user is assigned as "Guru Piket" today.
     */
    public function isPiketToday(): bool
    {
        return $this->dutySchedules()
            ->whereDate('duty_date', today())
            ->exists();
    }

    /**
     * Cek apakah user adalah Kesiswaan
     */
    public function isKesiswaan(): bool
    {
        return $this->role === 'kesiswaan';
    }

    /**
     * Cek apakah user adalah BK
     */
    public function isBk(): bool
    {
        return $this->role === 'bk';
    }


    /**
     * Cek apakah user adalah Wali Kelas
     * (Memeriksa apakah guru ini punya relasi ke tabel kelas)
     */
    public function isWaliKelas(): bool
    {
        // Asumsi kamu punya tabel/model 'Classroom' dan relasi 'classroom' di model User
        // Jika tidak pakai relasi, bisa disesuaikan nanti
        return $this->classroom()->exists();
    }
    // Tambahkan relasi ini di dalam class User
    public function teacher()
    {
        return $this->hasOne(Teacher::class, 'user_id');
    }

    /**
     * RELASI: Menghubungkan Guru dengan Kelas yang dipimpinnya (Wali Kelas)
     */
    public function classroom()
    {
        // Sesuaikan 'wali_kelas_id' dengan nama kolom foreign key di tabel kelasmu
        return $this->hasOne(ClassRoom::class, 'wali_kelas_id');
    }

    /**
     * Check if user has any of the given roles
     */
    public function hasRole($roles): bool
    {
        if (!is_array($roles)) {
            $roles = explode(',', $roles);
        }

        // 1. Cek jika role asli di database cocok
        if (in_array($this->role, $roles)) {
            return true;
        }

        // 2. Logika Otomatis: Jika user adalah 'guru', dan hari ini piket
        if ($this->role === 'guru' && in_array('piket', $roles)) {
            return $this->isPiketToday();
        }

        return false;
    }
}
