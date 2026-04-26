<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WarningLetter extends Model
{
    protected $fillable = [
        'student_id',
        'type'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}