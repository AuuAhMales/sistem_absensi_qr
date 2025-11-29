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
            $table->foreignId('pengguna_id')
                  ->constrained('users')
                  ->onDelete('cascade');
    
            $table->foreignId('qr_token_id')
                  ->constrained('qr_token');
    
            $table->date('tanggal');
            $table->time('jam_absen');
            $table->enum('status', ['hadir']);
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
