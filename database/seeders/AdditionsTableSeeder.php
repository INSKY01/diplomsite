<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Addition;

class AdditionsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('additions')->delete();
        
        Addition::insert([
            [
                'name' => 'Терраса',
                'description' => 'Открытая терраса для отдыха',
                'price' => 180000,
                'perMeter' => false,
                'category' => 'design',
                'image' => 'https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?w=400&h=300&fit=crop&crop=center',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Веранда',
                'description' => 'Застекленная веранда',
                'price' => 250000,
                'perMeter' => false,
                'category' => 'comfort',
                'image' => 'https://images.unsplash.com/photo-1600047509807-ba8f99d2cdde?w=400&h=300&fit=crop&crop=center',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Камин',
                'description' => 'Дровяной камин с дымоходом',
                'price' => 320000,
                'perMeter' => false,
                'category' => 'comfort',
                'image' => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=400&h=300&fit=crop&crop=center',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Гараж',
                'description' => 'Пристроенный гараж на 1 автомобиль',
                'price' => 450000,
                'perMeter' => false,
                'category' => 'utility',
                'image' => 'https://images.unsplash.com/photo-1558618047-fd6c13a75116?w=400&h=300&fit=crop&crop=center',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Система умный дом',
                'description' => 'Автоматизация освещения, отопления и безопасности',
                'price' => 280000,
                'perMeter' => false,
                'category' => 'utility',
                'image' => 'https://images.unsplash.com/photo-1563453392212-326f5e854473?w=400&h=300&fit=crop&crop=center',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Система безопасности',
                'description' => 'Видеонаблюдение и охранная сигнализация',
                'price' => 150000,
                'perMeter' => false,
                'category' => 'safety',
                'image' => 'https://images.unsplash.com/photo-1558618047-fd6c13a75116?w=400&h=300&fit=crop&crop=center',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Другое',
                'description' => 'Индивидуальные решения и дополнения по желанию',
                'price' => 0,
                'perMeter' => false,
                'category' => 'design',
                'image' => 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=400&h=300&fit=crop&crop=center',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
} 