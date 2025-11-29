<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

use App\Models\Peran;
use App\Models\Guru;
use App\Models\Siswa;
use App\Models\Absensi;

class User extends Authenticatable
{
    use Notifiable;


    protected $fillable = [
        'name',
        'email',
        'password',
        'peran_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // ===== RELASI =====

    public function peran()
    {
        return $this->belongsTo(Peran::class, 'peran_id');
    }

    public function guru()
    {
        return $this->hasOne(Guru::class, 'pengguna_id');
    }

    public function siswa()
    {
        return $this->hasOne(Siswa::class, 'pengguna_id');
    }

    public function absensi()
    {
        return $this->hasMany(Absensi::class, 'pengguna_id');
    }

    public function qrToken()
    {   
    return $this->hasMany(QrToken::class, 'pengguna_id');
    }

}
