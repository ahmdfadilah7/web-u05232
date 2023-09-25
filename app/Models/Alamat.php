<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alamat extends Model
{
    use HasFactory;

    protected $fillable = [
        'pelanggan_id',
        'nama_penerima',
        'no_penerima',
        'alamat'
    ];
}
