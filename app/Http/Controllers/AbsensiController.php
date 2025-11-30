<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QrToken;
use App\Models\Absensi;
use App\Models\Siswa;
use Carbon\Carbon;

class AbsensiController extends Controller
{
    public function scan(Request $request)
    {
        // 1. Validasi request
        $request->validate([
            'token' => 'required'
        ]);

        // 2. Ambil QR token
        $qr = QrToken::where('token', $request->token)->first();

        if (!$qr) {
            return response()->json([
                'success' => false,
                'message' => 'QR tidak valid'
            ], 404);
        }

        // 3. Cek status aktif
        if (!$qr->status_aktif) {
            return response()->json([
                'success' => false,
                'message' => 'QR sudah tidak aktif'
            ], 400);
        }

        // 4. Cek expired
        if (Carbon::now()->gt($qr->waktu_kedaluwarsa)) {
            return response()->json([
                'success' => false,
                'message' => 'QR sudah kedaluwarsa'
            ], 400);
        }

        $siswa = Siswa::first(); // <-- AMBIL SISWA DEMO


        if (!$siswa) {
            return response()->json([
                'success' => false,
                'message' => 'Data siswa tidak ditemukan'
            ], 404);
        }

        // 6. Cek apakah sudah absen hari ini
        $sudahAbsen = Absensi::where('siswa_id', $siswa->id)
            ->whereDate('waktu_absen', Carbon::today())
            ->exists();

        if ($sudahAbsen) {
            return response()->json([
                'success' => false,
                'message' => 'Kamu sudah absen hari ini'
            ], 400);
        }

        // 7. Simpan absensi
        $absen = Absensi::create([
            'siswa_id'    => $siswa->id,
            'qr_token_id' => $qr->id,
            'waktu_absen' => now(),
            'status'      => 'hadir'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Absensi berhasil',
            'data' => [
                'nama' => 'Siswa Demo',
                'waktu' => $absen->waktu_absen
            ]
        ]);
        
    }
}
