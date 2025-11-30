<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Peran;
use App\Models\Siswa;
use Illuminate\Support\Facades\Hash;

class SiswaSeeder extends Seeder
{
    public function run(): void
    {
        $peranSiswa = Peran::where('nama_peran', 'siswa')->first();

        $user = User::create([
            'name' => 'Siswa Demo',
            'email' => 'siswa@absensi.test',
            'password' => Hash::make('password'),
            'peran_id' => $peranSiswa->id,
        ]);

        Siswa::create([
            'pengguna_id' => $user->id,
            'nis' => '2025001',
            'kelas' => 'X-RPL-1',
        ]);
    }
}
