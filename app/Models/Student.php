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
        return $this->belongsTo(ParentModel::class, 'parent_id')->withDefault();
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
