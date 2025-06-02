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
                'image' => 'https://images.unsplash.com/photo-1558618047-fd6c13a75116?w=400&h=300&fit=crop&crop=center',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Профилированный брус 150x150',
                'description' => 'Сухой профилированный брус естественной влажности',
                'price' => 12000,
                'image' => 'https://images.unsplash.com/photo-1600047509807-ba8f99d2cdde?w=400&h=300&fit=crop&crop=center',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Керамический кирпич',
                'description' => 'Полнотелый керамический кирпич М150',
                'price' => 15000,
                'image' => 'https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=400&h=300&fit=crop&crop=center',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Газобетонные блоки D400',
                'description' => 'Автоклавный газобетон плотностью 400 кг/м³',
                'price' => 10000,
                'image' => 'https://images.unsplash.com/photo-1581094794329-c8112a89af12?w=400&h=300&fit=crop&crop=center',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Другое',
                'description' => 'Альтернативные материалы по индивидуальному проекту',
                'price' => 0,
                'image' => 'https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=400&h=300&fit=crop&crop=center',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
} 