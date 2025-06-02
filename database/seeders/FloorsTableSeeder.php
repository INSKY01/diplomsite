<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FloorsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('floors')->delete();
        
        DB::table('floors')->insert([
            [
                'name' => '1 этаж',
                'description' => 'Одноэтажный дом - комфорт на одном уровне',
                'multiplier' => 1.0,
                'image' => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=400&h=300&fit=crop&crop=center',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => '2 этажа',
                'description' => 'Двухэтажный дом - больше пространства и приватности',
                'multiplier' => 1.8,
                'image' => 'https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?w=400&h=300&fit=crop&crop=center',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => '2 этажа + мансарда',
                'description' => 'Максимум полезной площади с мансардным этажом',
                'multiplier' => 2.2,
                'image' => 'https://images.unsplash.com/photo-1600047509807-ba8f99d2cdde?w=400&h=300&fit=crop&crop=center',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Другое',
                'description' => 'Индивидуальная планировка этажей',
                'multiplier' => 1.0,
                'image' => 'https://images.unsplash.com/photo-1502005229762-cf1b2da60035?w=400&h=300&fit=crop&crop=center',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
} 