<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{

    protected $fillable = [
        'name',
        'nip',
        'phone',
        'email',
        'status'
    ];

    public function classes()
    {
        return $this->hasMany(ClassRoom::class, 'wali_kelas_id');
    }
}
