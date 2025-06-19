<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MaterialsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('materials')->delete();
        
        DB::table('materials')->insert([
            [
                'name' => 'Каркас + OSB плиты',
                'description' => 'Деревянный каркас с OSB обшивкой',
                'price' => 8000,
                'image' => '/img/calculator/materials/frame_osb.webp',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Профилированный брус 150x150',
                'description' => 'Сухой профилированный брус естественной влажности',
                'price' => 12000,
                'image' => '/img/calculator/materials/profiled_timber.webp',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Керамический кирпич',
                'description' => 'Полнотелый керамический кирпич М150',
                'price' => 15000,
                'image' => '/img/calculator/materials/ceramic_brick.webp',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Газобетонные блоки D400',
                'description' => 'Автоклавный газобетон плотностью 400 кг/м³',
                'price' => 10000,
                'image' => '/img/calculator/materials/aerated_concrete.webp',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Другое',
                'description' => 'Альтернативные материалы по индивидуальному проекту',
                'price' => 0,
                'image' => '/img/calculator/materials/other.svg',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
} 