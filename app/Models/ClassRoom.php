<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class ClassRoom extends Model
{
    protected $table = 'classes';

    protected $fillable = [ // ✅ WAJIB
        'name',
        'wali_kelas_id',
        'school_year'
    ];

    // public function students()
    // {
    //     return $this->hasMany(Student::class);
    // }

    // app/Models/ClassRoom.php

    public function students()
    {
        // Tambahkan 'class_id' (atau sesuaikan dengan nama kolom asli di tabel students kamu)
        return $this->hasMany(Student::class, 'class_id');
    }

    public function wali_kelas()
    {
        return $this->belongsTo(User::class, 'wali_kelas_id')->withDefault();
    }
}
