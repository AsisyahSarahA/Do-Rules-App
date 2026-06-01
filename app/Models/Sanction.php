<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\SanctionStatus;
class Sanction extends Model
{
    protected $fillable = [
        'violation_id',
        'status',
        'action',
        'evidence_path',
        'notes',
        'completed_at'
    ];

    protected $casts = [
        'status' => SanctionStatus::class,
    ];

    // Relasi balik ke Pelanggaran
    public function violation()
    {
        return $this->belongsTo(Violation::class);
    }
}
