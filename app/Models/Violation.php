<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Violation extends Model
{
    protected $fillable = [
        'student_id',
        'rule_id',
        'reported_by',
        'verified_by',
        'notes',
        'status',
        'evidence',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIPS
    |--------------------------------------------------------------------------
    */

    // siswa pelanggar
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    // aturan yang dilanggar
    public function rule()
    {
        return $this->belongsTo(Rule::class);
    }

    // pelapor
    public function reporter()
    {
        return $this->belongsTo(User::class, 'reported_by');
    }

    // verifier
    public function verifier()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    // sanksi
    public function sanction()
    {
        return $this->hasOne(Sanction::class);
    }
}