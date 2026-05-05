<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sanction extends Model
{
    protected $fillable = [
        'min_point',
        'max_point',
        'action'
    ];

    public function violation()
    {
        return $this->belongsTo(Violation::class);
    }
}
