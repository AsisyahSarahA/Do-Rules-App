<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
    protected $fillable = [
        'name',
        'point',
        'level',
    ];

    // relasi ke pelanggaran
    public function violations()
    {
        return $this->hasMany(Violation::class);
    }
    

    // konstanta level
    const LEVEL_RINGAN = 'ringan';
    const LEVEL_SEDANG = 'sedang';
    const LEVEL_BERAT = 'berat';
}