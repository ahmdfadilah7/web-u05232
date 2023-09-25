<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnalisisKriteria extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_kriteria_1',
        'kode_kriteria_2',
        'nilai',
        'bobot',
        'jumlah',
    ];
}
