<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParentModel extends Model
{
    protected $table = 'parents';

    protected $fillable = [
        'student_id',
        'name_parent',
        'phone',
        'address'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
