<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PeranSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('peran')->insert([
            [
                'nama_peran' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_peran' => 'guru',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_peran' => 'siswa',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
