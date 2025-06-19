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
                'image' => '/img/calculator/additions/terrace.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Веранда',
                'description' => 'Застекленная веранда',
                'price' => 250000,
                'perMeter' => false,
                'category' => 'comfort',
                'image' => '/img/calculator/additions/veranda.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Камин',
                'description' => 'Дровяной камин с дымоходом',
                'price' => 320000,
                'perMeter' => false,
                'category' => 'comfort',
                'image' => '/img/calculator/additions/fireplace.png',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Гараж',
                'description' => 'Пристроенный гараж на 1 автомобиль',
                'price' => 450000,
                'perMeter' => false,
                'category' => 'utility',
                'image' => '/img/calculator/additions/garage.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Другое',
                'description' => 'Индивидуальные решения и дополнения по желанию',
                'price' => 0,
                'perMeter' => false,
                'category' => 'design',
                'image' => '/img/calculator/additions/other.svg',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
} 