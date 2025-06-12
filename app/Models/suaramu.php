<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Suaramu extends Model
{
    use HasFactory;
    protected $table = 'suaramu';

    protected $fillable = [
        'pengguna_id',
        'judul',
        'isi_saran',
        'kategori',
    ];

    public function pengguna()
    {
        return $this->belongsTo(pengguna::class);
    }
}
