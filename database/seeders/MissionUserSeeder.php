<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MissionUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('mission_users')->truncate();

        // Buat array untuk hubungan antara user dan mission
        $data = [
            ['mission_id' => 1, 'user_id' => 1],
            ['mission_id' => 2, 'user_id' => 1],
            ['mission_id' => 3, 'user_id' => 1],

            ['mission_id' => 1, 'user_id' => 2],
            ['mission_id' => 2, 'user_id' => 2],
            ['mission_id' => 3, 'user_id' => 2],
        ];

        // Masukkan data ke dalam tabel mission_user
        DB::table('mission_users')->insert($data);
    }
}

