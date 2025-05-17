<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HouseTypesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('house_types')->insert([
            [
                'name' => 'Каркасный дом',
                'description' => 'Современный деревянный каркасный дом с отличной теплоизоляцией',
                'price' => 25000,
                'image' => 'img/carc-house.png',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Дом из бруса',
                'description' => 'Классический дом из строганного бруса',
                'price' => 30000,
                'image' => 'img/brus-house.png',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Дом из бревна',
                'description' => 'Традиционный дом из оцилиндрованного бревна',
                'price' => 35000,
                'image' => 'img/brev-house.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Дом из лафета',
                'description' => 'Премиальный дом из лафета ручной рубки',
                'price' => 40000,
                'image' => 'img/lafet-house.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
} 