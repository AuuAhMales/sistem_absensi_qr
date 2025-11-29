<?php

namespace App\Http\Controllers;

use App\Models\QrToken;
use App\Models\Absensi;
use App\Models\Siswa;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    public function scan(Request $request)
    {
        $request->validate([
            'token' => 'required'
        ]);

        $qr = QrToken::where('token', $request->token)
            ->where('status_aktif', true)
            ->where('waktu_kedaluwarsa', '>', now())
            ->first();

        if (! $qr) {
            return response()->json([
                'message' => 'QR tidak valid atau kadaluarsa'
            ], 400);
        }

        $siswa = Siswa::where('pengguna_id', auth()->id())->first();

        if (! $siswa) {
            return response()->json([
                'message' => 'Data siswa tidak ditemukan'
            ], 404);
        }

        Absensi::create([
            'pengguna_id' => $qr->pengguna_id,
            'siswa_id' => $siswa->id,
            'qr_token_id' => $qr->id,
            'waktu_absen' => now(),
            'status' => 'hadir'
        ]);

        return response()->json([
            'message' => 'Absensi berhasil'
        ]);
    }
}
