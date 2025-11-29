<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Guru\QrController;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| ROUTE AWAL
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| DEV LOGIN (SEMENTARA)
| HANYA UNTUK DEVELOPMENT
|--------------------------------------------------------------------------
| Contoh:
| /dev-login/admin
| /dev-login/guru
| /dev-login/siswa
*/
Route::get('/dev-login/{role}', function ($role) {

    $user = User::whereHas('peran', function ($q) use ($role) {
        $q->where('nama_peran', $role);
    })->first();

    if (!$user) {
        return 'User dengan role ' . $role . ' tidak ditemukan';
    }

    auth()->login($user);

    return 'Login sebagai ' . $role . ' berhasil';
});

/*
|--------------------------------------------------------------------------
| ROUTE GURU - GENERATE QR
|--------------------------------------------------------------------------
*/
Route::middleware(['role:guru'])->group(function () {
    Route::get('/guru/qr', [QrController::class, 'generate']);

    Route::post('/absen/scan', [\App\Http\Controllers\AbsensiController::class, 'scan']);

});
