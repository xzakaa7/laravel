<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class darurat extends Model
{
    use HasFactory;

    protected $table = 'darurat';

    protected $fillable = [
        'pengguna_id',
        'nama_pelapor',
        'kategori',
        'keterangan',
        'lokasi',
        'foto',
        'status',
    ];

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class);
    }
}