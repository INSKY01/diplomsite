<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FoundationsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('foundations')->delete();
        
        DB::table('foundations')->insert([
            [
                'name' => 'Свайно-винтовой',
                'description' => 'Экономичный вариант для легких домов',
                'price' => 3500,
                'image' => '/img/calculator/foundations/screw_pile.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Ленточный мелкозаглубленный',
                'description' => 'Оптимальное решение для большинства грунтов',
                'price' => 5500,
                'image' => '/img/calculator/foundations/shallow_strip.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Ленточный заглубленный',
                'description' => 'Надежный фундамент для тяжелых конструкций',
                'price' => 8500,
                'image' => '/img/calculator/foundations/deep_strip.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Монолитная плита',
                'description' => 'Максимальная надежность для сложных грунтов',
                'price' => 12000,
                'image' => '/img/calculator/foundations/concrete_slab.jpeg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Другое',
                'description' => 'Специальный тип фундамента под геологические условия',
                'price' => 0,
                'image' => '/img/calculator/foundations/other.svg',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
} 