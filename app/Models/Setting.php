<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_website',
        'google_map',
        'logo',
        'favicon',
        'alamat',
        'email',
        'no_telp',
        'about_us'
    ];
}
