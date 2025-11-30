<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AbsensiController;

Route::post('/absen/scan', [AbsensiController::class, 'scan']);
