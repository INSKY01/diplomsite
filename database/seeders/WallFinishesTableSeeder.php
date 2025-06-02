<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WallFinishesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('wall_finishes')->delete();
        
        DB::table('wall_finishes')->insert([
            [
                'name' => 'Покраска стен',
                'description' => 'Простая и практичная отделка',
                'price' => 800,
                'image' => 'https://images.unsplash.com/photo-1558618047-fd6c13a75116?w=400&h=300&fit=crop&crop=center',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Обои',
                'description' => 'Классическая отделка с широким выбором дизайна',
                'price' => 1500,
                'image' => 'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?w=400&h=300&fit=crop&crop=center',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Декоративная штукатурка',
                'description' => 'Современная отделка с интересной фактурой',
                'price' => 2200,
                'image' => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=400&h=300&fit=crop&crop=center',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Деревянные панели',
                'description' => 'Премиальная отделка из натурального дерева',
                'price' => 3500,
                'image' => 'https://images.unsplash.com/photo-1600047509807-ba8f99d2cdde?w=400&h=300&fit=crop&crop=center',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Другое',
                'description' => 'Авторская отделка по индивидуальному дизайну',
                'price' => 0,
                'image' => 'https://images.unsplash.com/photo-1484301548518-d0e0a5db0fc8?w=400&h=300&fit=crop&crop=center',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
} 