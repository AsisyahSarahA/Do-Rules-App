<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    public function classes()
    {
        return $this->hasMany(ClassRoom::class, 'wali_kelas_id');
    }
}
