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
                'image' => '/img/calculator/wall_finishes/paint.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Обои',
                'description' => 'Классическая отделка с широким выбором дизайна',
                'price' => 1500,
                'image' => '/img/calculator/wall_finishes/wallpaper.webp',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Декоративная штукатурка',
                'description' => 'Современная отделка с интересной фактурой',
                'price' => 2200,
                'image' => '/img/calculator/wall_finishes/decorative_plaster.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Деревянные панели',
                'description' => 'Премиальная отделка из натурального дерева',
                'price' => 3500,
                'image' => '/img/calculator/wall_finishes/wood_panels.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Другое',
                'description' => 'Авторская отделка по индивидуальному дизайну',
                'price' => 0,
                'image' => '/img/calculator/wall_finishes/other.svg',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
} 