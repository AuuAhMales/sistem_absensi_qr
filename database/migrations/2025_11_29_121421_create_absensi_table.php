<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('absensi', function (Blueprint $table) {
            $table->id();
        
            $table->foreignId('pengguna_id')->constrained('users');
            $table->foreignId('siswa_id')->constrained('siswa');
            $table->foreignId('qr_token_id')->constrained('qr_token');
        
            $table->dateTime('waktu_absen');
            $table->string('status');
        
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensi');
    }
};
