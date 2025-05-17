<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FloorsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('floors')->insert([
            ['name' => 'Одноэтажный', 'multiplier' => 1, 'description' => 'Одноэтажный дом - классическое решение для небольшой семьи', 'image' => 'img/1floor.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Двухэтажный', 'multiplier' => 1.8, 'description' => 'Двухэтажный дом - оптимальное использование земельного участка', 'image' => 'img/2floor.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Одноэтажный с мансардой', 'multiplier' => 1.3, 'description' => 'Компактный дом с жилой мансардой - экономичный и функциональный вариант', 'image' => 'img/3floor.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Двухэтажный с цоколем', 'multiplier' => 2.1, 'description' => 'Двухэтажный дом с цокольным этажом - подходит для любых грунтов', 'image' => 'img/4floor.jpg', 'created_at' => now(), 'updated_at' => now()]
        ]);
    }
} 