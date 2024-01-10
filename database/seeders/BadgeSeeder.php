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
            'image' => "bronze_medal",
            'name' => 'Bronze Medal',
            'price' => 50,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('badges')->insert([
            'image' => "silver_medal",
            'name' => 'Silver Medal',
            'price' => 100,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('badges')->insert([
            'image' => "gold_medal",
            'name' => 'Gold Medal',
            'price' => 150,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('badges')->insert([
            'image' => "sandglass",
            'name' => 'Sandglass',
            'price' => 200,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
