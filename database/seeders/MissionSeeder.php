<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('missions')->insert([
            [
                'title' => 'Kerjakan 10 tugas',
                'description' => 'Jangan malas',
                'quantity' => 10,
                'coins' => 100,
                'urgency_status' => NULL,
                'created_at' => '2023-12-27 16:57:25',
                'updated_at' => '2023-12-27 16:57:25',
            ],
            [
                'title' => 'Kerjakan 2 tugas dengan urgency kecil',
                'description' => 'Jangan malas',
                'quantity' => 2,
                'coins' => 100,
                'urgency_status' => 3,
                'created_at' => '2023-12-27 17:00:49',
                'updated_at' => '2023-12-27 22:14:13',
            ],
            [
                'title' => 'Kerjakan 12 tugas dengan urgency tinggi',
                'description' => 'Jangan malas',
                'quantity' => 12,
                'coins' => 400,
                'urgency_status' => 1,
                'created_at' => '2023-12-27 17:02:27',
                'updated_at' => '2023-12-27 17:02:27',
            ],
        ]);
    }
}
