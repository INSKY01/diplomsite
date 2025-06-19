<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoofsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('roofs')->delete();
        
        DB::table('roofs')->insert([
            [
                'name' => 'Металлочерепица',
                'description' => 'Популярное и долговечное покрытие',
                'price' => 180000,
                'image' => '/img/calculator/roofs/metal_tile.webp',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Мягкая кровля',
                'description' => 'Тихая и эстетичная битумная черепица',
                'price' => 220000,
                'image' => '/img/calculator/roofs/soft_roof.webp',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Профнастил',
                'description' => 'Экономичное решение для крыши',
                'price' => 120000,
                'image' => '/img/calculator/roofs/corrugated_metal.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Керамическая черепица',
                'description' => 'Премиальная кровля с превосходным внешним видом',
                'price' => 350000,
                'image' => '/img/calculator/roofs/ceramic_tile.webp',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Другое',
                'description' => 'Альтернативные кровельные материалы',
                'price' => 0,
                'image' => '/img/calculator/roofs/other.svg',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
} 