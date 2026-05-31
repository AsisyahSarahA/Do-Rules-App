<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = [
        'user_id', // Tambahkan ini agar bisa menyimpan hubungan ke table user
        'name',
        'nip',
        'phone',
        'email',
        'status'
    ];

    // Relasi balik ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }



    public function classes()
    {
        return $this->hasMany(ClassRoom::class, 'wali_kelas_id', 'user_id');
    }
}
