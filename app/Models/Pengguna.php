<?php

namespace App\Models;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pengguna extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'pengguna';

    protected $fillable = ['nama', 'email', 'password', 'no_hp', 'alamat'];

      protected $hidden = [
        'password',
    ];

    // Otomatis hash password saat diset
    public function setPasswordAttribute($value)
{
    // Jika sudah terhash (panjang dan mulai dengan $2y$), jangan hash ulang
    if (strpos($value, '$2y$') === 0 && strlen($value) === 60) {
        $this->attributes['password'] = $value;
    } else {
        $this->attributes['password'] = Hash::make($value);
    }
}

}
