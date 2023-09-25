<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id',
        'barang_id',
        'pelanggan_id',
        'pembayaran',
        'jasa_kirim',
        'kuantitas',
        'total',
        'tanggal'
    ];
}
