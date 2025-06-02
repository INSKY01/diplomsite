<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Electrical;

class ElectricalTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('electricals')->delete();
        
        Electrical::insert([
            [
                'name' => 'Базовая проводка',
                'description' => 'Стандартная электрификация дома',
                'price' => 2500,
                'sockets' => 20,
                'switches' => 12,
                'lights' => 8,
                'image' => 'https://images.unsplash.com/photo-1621905251189-08b45d6a269e?w=400&h=300&fit=crop&crop=center',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Улучшенная проводка',
                'description' => 'Расширенный набор электрических точек',
                'price' => 3200,
                'sockets' => 35,
                'switches' => 18,
                'lights' => 15,
                'image' => 'https://images.unsplash.com/photo-1581092918484-8313de2e8f2d?w=400&h=300&fit=crop&crop=center',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Премиум проводка',
                'description' => 'Полная автоматизация с системами безопасности и управления',
                'price' => 4500,
                'sockets' => 50,
                'switches' => 25,
                'lights' => 22,
                'image' => 'https://images.unsplash.com/photo-1558618047-fd6c13a75116?w=400&h=300&fit=crop&crop=center',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Другое',
                'description' => 'Индивидуальная электрификация по техническому заданию',
                'price' => 0,
                'sockets' => 0,
                'switches' => 0,
                'lights' => 0,
                'image' => 'https://images.unsplash.com/photo-1563453392212-326f5e854473?w=400&h=300&fit=crop&crop=center',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
} 