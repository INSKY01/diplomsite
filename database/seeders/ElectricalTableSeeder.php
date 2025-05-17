<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ElectricalTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('electrical')->insert([
            [
                'name' => 'Базовая электрика',
                'description' => 'Простая электропроводка с минимальным количеством точек',
                'price' => 800,
                'sockets' => 10,
                'switches' => 5,
                'lights' => 8,
                'image' => 'img/electrical1.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Стандарт',
                'description' => 'Стандартная электропроводка с оптимальным количеством розеток и выключателей',
                'price' => 1200,
                'sockets' => 15,
                'switches' => 8,
                'lights' => 12,
                'image' => 'img/electrical2.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Комфорт',
                'description' => 'Расширенная электрика с дополнительными точками и встроенной защитой',
                'price' => 1800,
                'sockets' => 20,
                'switches' => 12,
                'lights' => 16,
                'image' => 'img/electrical3.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Премиум',
                'description' => 'Полная электрификация с защитой, автоматикой и подготовкой под "умный дом"',
                'price' => 2500,
                'sockets' => 25,
                'switches' => 15,
                'lights' => 20,
                'image' => 'img/electrical4.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
} 