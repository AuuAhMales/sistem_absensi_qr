<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Guru\QrController;
use App\Http\Controllers\AbsensiController;
use App\Models\User;

// Home
Route::get('/', function () {
    return view('welcome');
});

// ==========================
// DEV LOGIN (sementara)
// ==========================
Route::get('/dev-login/{role}', function ($role) {

    $user = User::whereHas('peran', fn ($q) =>
        $q->where('nama_peran', $role)
    )->first();

    if (!$user) {
        return 'User dengan role ' . $role . ' tidak ditemukan';
    }

    auth()->login($user);
    return 'Login sebagai ' . $role . ' berhasil';
});


// ==========================
// GURU
// ==========================
Route::middleware(['auth', 'role:guru'])->group(function () {
    Route::get('/guru/qr', [QrController::class, 'generate']);
});


// ==========================
// SISWA
// ==========================
Route::middleware(['auth', 'role:siswa'])->group(function () {
    Route::post('/absen/scan', [AbsensiController::class, 'scan']);
});
