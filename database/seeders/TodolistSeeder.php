<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TodolistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('todolists')->insert([
            'title' => 'Meeting Pagi',
            'date' => '2023-12-27',
            'time' => '09:00:00',
            'urgency_status' => 1,
            'description' => 'Pertemuan dengan tim untuk review proyek.',
            'progress_status' => false,
            'location' => 'Ruang Rapat A',
            'user_id' => 1,  // Gantikan dengan ID user yang valid
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('todolists')->insert([
            'title' => 'Pekerjaan Laporan',
            'date' => '2023-12-28',
            'time' => '14:00:00',
            'urgency_status' => 2,
            'description' => 'Menyelesaikan laporan bulanan.',
            'progress_status' => false,
            'location' => 'Kantor Pusat',
            'user_id' => 1,  // Gantikan dengan ID user yang valid
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('todolists')->insert([
            'title' => 'Pelatihan Karyawan',
            'date' => '2023-12-29',
            'time' => '10:30:00',
            'urgency_status' => 3,
            'description' => 'Mengadakan pelatihan untuk karyawan baru.',
            'progress_status' => false,
            'location' => 'Aula Utama',
            'user_id' => 1,  // Gantikan dengan ID user yang valid
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
