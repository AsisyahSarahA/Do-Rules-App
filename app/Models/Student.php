<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'user_id', // Tambahkan ini
        'name',
        'nis',
        'class_id',
        'parent_id',
        'total_points'
    ];

    // Relasi ke tabel Users
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function classRoom()
    {
        return $this->belongsTo(ClassRoom::class, 'class_id');
    }

    public function parent()
    {
        return $this->belongsTo(ParentModel::class, 'parent_id');
    }

    public function violations()
    {
        return $this->hasMany(Violation::class);
    }

    public function warningLetters()
    {
        return $this->hasMany(WarningLetter::class);
    }

    public function counselings()
    {
        return $this->hasMany(Counseling::class);
    }
}
