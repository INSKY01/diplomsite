<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HouseTypesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('house_types')->delete();
        
        DB::table('house_types')->insert([
            [
                'name' => 'Каркасный дом',
                'description' => 'Быстровозводимый энергоэффективный дом',
                'price' => 35000,
                'image' => '/img/calculator/house_types/frame_house.webp',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Дом из бруса',
                'description' => 'Экологичный дом из натурального дерева',
                'price' => 45000,
                'image' => '/img/calculator/house_types/timber_house.webp',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Кирпичный дом',
                'description' => 'Надежный дом с отличной теплоизоляцией',
                'price' => 65000,
                'image' => '/img/calculator/house_types/brick_house.webp',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Дом из газобетона',
                'description' => 'Современный дом из газобетонных блоков с отличной теплоизоляцией',
                'price' => 50000,
                'image' => '/img/calculator/house_types/aerated_concrete_house.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Другое',
                'description' => 'Индивидуальный проект по вашим пожеланиям',
                'price' => 0,
                'image' => '/img/calculator/materials/other.svg',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
} 