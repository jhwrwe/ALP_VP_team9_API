<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BadgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $imagePath = 'bronze_medal';
        DB::table('badges')->insert([
            'image' => $imagePath,
            'name' => 'Bronze Medal',
            'price' => 50, 
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
