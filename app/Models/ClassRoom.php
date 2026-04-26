<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class ClassRoom extends Model
{
    protected $table = 'classes';

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function wali_kelas()
    {
        return $this->belongsTo(User::class, 'wali_kelas_id')->withDefault();
    }
}
