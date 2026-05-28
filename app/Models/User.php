<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

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
