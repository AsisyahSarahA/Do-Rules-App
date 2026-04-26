<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
     protected $fillable = [
        'name',
        'nis',
        'class_room_id',
        'parent_id',
        'total_points'
    ];
    public function classRoom()
    {
        return $this->belongsTo(ClassRoom::class);
    }

    public function parent()
    {
        return $this->hasOne(ParentModel::class, 'student_id');
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
