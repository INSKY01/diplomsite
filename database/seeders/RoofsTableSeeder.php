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
                'image' => 'https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?w=400&h=300&fit=crop&crop=center',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Мягкая кровля',
                'description' => 'Тихая и эстетичная битумная черепица',
                'price' => 220000,
                'image' => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=400&h=300&fit=crop&crop=center',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Профнастил',
                'description' => 'Экономичное решение для крыши',
                'price' => 120000,
                'image' => 'https://images.unsplash.com/photo-1600047509807-ba8f99d2cdde?w=400&h=300&fit=crop&crop=center',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Керамическая черепица',
                'description' => 'Премиальная кровля с превосходным внешним видом',
                'price' => 350000,
                'image' => 'https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?w=400&h=300&fit=crop&crop=center',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Другое',
                'description' => 'Альтернативные кровельные материалы',
                'price' => 0,
                'image' => 'https://images.unsplash.com/photo-1513475382585-d06e58bcb0e0?w=400&h=300&fit=crop&crop=center',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
} 