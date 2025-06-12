<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class news extends Model
{
    use HasFactory;

    protected $table = 'news';

    protected $fillable = [
        'judul',
        'isi',
        'penulis',
        'image',
    ];

    public $timestamps = true;
    const UPDATED_AT = null; // hanya created_at yang digunakan


    
}

