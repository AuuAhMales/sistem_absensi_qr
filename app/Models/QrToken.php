<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QrToken extends Model
{
    use HasFactory;

    protected $table = 'qr_token';

    protected $fillable = [
        'pengguna_id',
        'token',
        'status_aktif',
        'waktu_kedaluwarsa',
    ];

    protected $casts = [
        'waktu_kedaluwarsa' => 'datetime',
        'status_aktif' => 'boolean',
    ];
}
