<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DutySchedule extends Model
{
    protected $fillable = ['user_id', 'duty_date'];

    protected $casts = [
        'duty_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
