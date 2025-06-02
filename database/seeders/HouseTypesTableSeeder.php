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
                'image' => 'https://images.unsplash.com/photo-1570129477492-45c003edd2be?w=400&h=300&fit=crop&crop=center',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Дом из бруса',
                'description' => 'Экологичный дом из натурального дерева',
                'price' => 45000,
                'image' => 'https://images.unsplash.com/photo-1449824913935-59a10b8d2000?w=400&h=300&fit=crop&crop=center',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Кирпичный дом',
                'description' => 'Надежный дом с отличной теплоизоляцией',
                'price' => 65000,
                'image' => 'https://images.unsplash.com/photo-1564013799919-ab600027ffc6?w=400&h=300&fit=crop&crop=center',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Дом из газобетона',
                'description' => 'Современный дом из газобетонных блоков с отличной теплоизоляцией',
                'price' => 50000,
                'image' => 'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?w=400&h=300&fit=crop&crop=center',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Другое',
                'description' => 'Индивидуальный проект по вашим пожеланиям',
                'price' => 0,
                'image' => 'https://images.unsplash.com/photo-1541888946425-d81bb19240f5?w=400&h=300&fit=crop&crop=center',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
} 