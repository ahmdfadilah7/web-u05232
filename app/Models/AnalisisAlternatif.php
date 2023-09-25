<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnalisisAlternatif extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_alternatif_1',
        'kode_alternatif_2',
        'kode_kriteria',
        'nilai',
        'bobot',
        'jumlah',
    ];
}
