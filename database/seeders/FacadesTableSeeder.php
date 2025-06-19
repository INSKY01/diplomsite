<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Facade;

class FacadesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('facades')->delete();
        
        Facade::insert([
            [
                'name' => 'Виниловый сайдинг',
                'description' => 'Практичная и доступная облицовка',
                'price' => 2500,
                'image' => '/img/calculator/facades/vinyl_siding.webp',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Имитация бруса',
                'description' => 'Деревянная отделка под натуральный брус',
                'price' => 3500,
                'image' => '/img/calculator/facades/timber_imitation.webp',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Фиброцементные панели',
                'description' => 'Современный долговечный материал',
                'price' => 4500,
                'image' => '/img/calculator/facades/fiber_cement.webp',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Клинкерная плитка',
                'description' => 'Премиальная отделка с неповторимым стилем',
                'price' => 6500,
                'image' => '/img/calculator/facades/clinker_tile.webp',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Другое',
                'description' => 'Индивидуальное фасадное решение',
                'price' => 0,
                'image' => '/img/calculator/facades/other.svg',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
} 