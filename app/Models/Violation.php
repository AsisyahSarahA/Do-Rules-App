<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Violation extends Model
{
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function rule()
    {
        return $this->belongsTo(Rule::class);
    }

    public function sanction()
    {
        return $this->hasOne(Sanction::class);
    }
}
