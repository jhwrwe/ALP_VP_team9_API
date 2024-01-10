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
                'title' => 'Kerjakan 1 Tugas',
                'description' => 'Semua Macam Tugas Bisa Masuk!',
                'quantity' => 1,
                'coins' => 100,
                'urgency_status' => NULL,
            ],
            [
                'title' => 'Kerjakan 2 tugas dengan urgency kecil',
                'description' => 'Santai Saja',
                'quantity' => 2,
                'coins' => 100,
                'urgency_status' => 3,
            ],
            [
                'title' => 'Kerjakan 1 Tugas Penting',
                'description' => 'GAS',
                'quantity' => 1,
                'coins' => 200,
                'urgency_status' => 1,
            ],
        ]);
    }
}
