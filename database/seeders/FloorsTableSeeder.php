<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FloorsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('floors')->delete();
        
        DB::table('floors')->insert([
            [
                'name' => '1 этаж',
                'description' => 'Одноэтажный дом - комфорт на одном уровне',
                'multiplier' => 1.0,
                'image' => '/img/calculator/floors/one_floor.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => '2 этажа',
                'description' => 'Двухэтажный дом - больше пространства и приватности',
                'multiplier' => 1.8,
                'image' => '/img/calculator/floors/two_floors.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => '2 этажа + мансарда',
                'description' => 'Максимум полезной площади с мансардным этажом',
                'multiplier' => 2.2,
                'image' => '/img/calculator/floors/two_floors_attic.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Другое',
                'description' => 'Индивидуальная планировка этажей',
                'multiplier' => 1.0,
                'image' => '/img/calculator/floors/other.svg',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
} 