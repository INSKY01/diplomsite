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
                'image' => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=400&h=300&fit=crop&crop=center',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Имитация бруса',
                'description' => 'Деревянная отделка под натуральный брус',
                'price' => 3500,
                'image' => 'https://images.unsplash.com/photo-1600047509807-ba8f99d2cdde?w=400&h=300&fit=crop&crop=center',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Фиброцементные панели',
                'description' => 'Современный долговечный материал',
                'price' => 4500,
                'image' => 'https://images.unsplash.com/photo-1449824913935-59a10b8d2000?w=400&h=300&fit=crop&crop=center',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Клинкерная плитка',
                'description' => 'Премиальная отделка с неповторимым стилем',
                'price' => 6500,
                'image' => 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=400&h=300&fit=crop&crop=center',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Другое',
                'description' => 'Индивидуальное фасадное решение',
                'price' => 0,
                'image' => 'https://images.unsplash.com/photo-1449824913935-59a10b8d2000?w=400&h=300&fit=crop&crop=center',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
} 