<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Models\QrToken;

class QrController extends Controller
{
    public function generate()
    {
        // nonaktifkan QR lama (opsional, tapi rapi)
        QrToken::where('pengguna_id', auth()->id())
            ->where('status_aktif', true)
            ->update(['status_aktif' => false]);

        $qr = QrToken::create([
            'pengguna_id' => auth()->id(),
            'token' => (string) Str::uuid(),
            'status_aktif' => true,
            'waktu_kedaluwarsa' => now()->addMinutes(10),
        ]);

        return response()->json([
            'token' => $qr->token,
            'expired_at' => $qr->waktu_kedaluwarsa,
        ]);
    }
}
