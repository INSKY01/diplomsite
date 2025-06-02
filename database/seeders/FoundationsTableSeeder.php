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
                'image' => 'https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=400&h=300&fit=crop&crop=center',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Ленточный мелкозаглубленный',
                'description' => 'Оптимальное решение для большинства грунтов',
                'price' => 5500,
                'image' => 'https://images.unsplash.com/photo-1581094794329-c8112a89af12?w=400&h=300&fit=crop&crop=center',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Ленточный заглубленный',
                'description' => 'Надежный фундамент для тяжелых конструкций',
                'price' => 8500,
                'image' => 'https://images.unsplash.com/photo-1598300042247-d088f8ab3a91?w=400&h=300&fit=crop&crop=center',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Монолитная плита',
                'description' => 'Максимальная надежность для сложных грунтов',
                'price' => 12000,
                'image' => 'https://images.unsplash.com/photo-1590725175611-4579a24a683f?w=400&h=300&fit=crop&crop=center',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Другое',
                'description' => 'Специальный тип фундамента под геологические условия',
                'price' => 0,
                'image' => 'https://images.unsplash.com/photo-1598300042247-d088f8ab3a91?w=400&h=300&fit=crop&crop=center',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
} 