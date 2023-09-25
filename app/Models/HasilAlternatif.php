<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilAlternatif extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_alternatif',
        'kode_kriteria',
        'nilai_alternatif',
    ];
}
