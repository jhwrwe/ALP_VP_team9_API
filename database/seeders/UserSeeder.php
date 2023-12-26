<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'fullname' => 'Admin User',
            'phone_number' => 1234567890,
            'username' => 'admin',
            'coins' => 100,
            'role_id' => 1,  // 1 untuk admin, sesuai dengan asumsi Anda
            'email' => 'admin@example.com',
            'password' => Hash::make('admin123'),  // Asumsi kata sandi
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
