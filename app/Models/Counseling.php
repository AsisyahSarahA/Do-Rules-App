<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Counseling extends Model
{
    protected $fillable = [
        'student_id',
        'notes'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}