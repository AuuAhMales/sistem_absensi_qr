<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Peran;
use App\Models\Guru;
use Illuminate\Support\Facades\Hash;

class GuruSeeder extends Seeder
{
    public function run(): void
    {
        $peranGuru = Peran::where('nama_peran', 'guru')->first();

        $user = User::create([
            'name' => 'Guru Demo',
            'email' => 'guru@absensi.test',
            'password' => Hash::make('password'),
            'peran_id' => $peranGuru->id,
        ]);

        Guru::create([
            'pengguna_id' => $user->id,
            'nip' => '123456789',
        ]);
    }
}
