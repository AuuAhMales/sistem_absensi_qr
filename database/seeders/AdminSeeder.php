<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // ambil id peran admin
        $adminRoleId = DB::table('peran')
            ->where('nama_peran', 'admin')
            ->value('id');

        DB::table('users')->insert([
            'name' => 'Administrator',
            'email' => 'admin@absensi.test',
            'password' => Hash::make('admin123'),
            'peran_id' => $adminRoleId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
