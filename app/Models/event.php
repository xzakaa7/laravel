<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class event extends Model
{
    use HasFactory;

    protected $table = 'event';

    protected $fillable = [
        'judul',
        'deskripsi',
        'lokasi',
        'waktu',
        'gambar',
    ];
}
