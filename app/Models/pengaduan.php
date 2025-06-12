<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class pengaduan extends Model
{
    use HasFactory;

    protected $table = 'pengaduan';

    protected $fillable = [
        'pengguna_id',
        'judul',
        'deskripsi',
        'foto',
        'lokasi',
        'jenis_pengaduan',
        'status',
    ];

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class);
    }
}
