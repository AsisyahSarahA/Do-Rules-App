<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sanction extends Model
{
    protected $fillable = [
        'violation_id',
        'action',
        'evidence_path',
        'status',
        'notes',
        'completed_at'
    ];

    // Relasi balik ke Pelanggaran
    public function violation()
    {
        return $this->belongsTo(Violation::class);
    }
}
