<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MaterialsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('materials')->delete();
        
        DB::table('materials')->insert([
            // Каркасные материалы
            [
                'name' => 'Каркас + OSB плиты',
                'description' => 'Деревянный каркас с OSB обшивкой',
                'price' => 8000,
                'image' => '/img/calculator/materials/frame_osb.webp',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Каркас + СИП панели',
                'description' => 'Энергоэффективные структурно-изоляционные панели',
                'price' => 12000,
                'image' => '/img/calculator/materials/sip_panels.webp',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Металлокаркас + ГВЛ',
                'description' => 'Металлический каркас с гипсоволокнистыми листами',
                'price' => 9500,
                'image' => '/img/calculator/materials/metal_frame.webp',
                'created_at' => now(),
                'updated_at' => now()
            ],

            // Деревянные материалы
            [
                'name' => 'Профилированный брус 150x150',
                'description' => 'Сухой профилированный брус естественной влажности',
                'price' => 12000,
                'image' => '/img/calculator/materials/profiled_timber.webp',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Клееный брус 200x200',
                'description' => 'Высококачественный клееный брус повышенной прочности',
                'price' => 18000,
                'image' => '/img/calculator/materials/glued_timber.webp',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Оцилиндрованное бревно D240',
                'description' => 'Экологичное оцилиндрованное бревно диаметром 240мм',
                'price' => 15000,
                'image' => '/img/calculator/materials/log_house.webp',
                'created_at' => now(),
                'updated_at' => now()
            ],

            // Кирпичные материалы
            [
                'name' => 'Керамический кирпич',
                'description' => 'Полнотелый керамический кирпич М150',
                'price' => 15000,
                'image' => '/img/calculator/materials/ceramic_brick.webp',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Силикатный кирпич',
                'description' => 'Белый силикатный кирпич М200 повышенной прочности',
                'price' => 13000,
                'image' => '/img/calculator/materials/silicate_brick.webp',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Поризованная керамика',
                'description' => 'Теплые керамические блоки с высокой теплоизоляцией',
                'price' => 17000,
                'image' => '/img/calculator/materials/ceramic_blocks.webp',
                'created_at' => now(),
                'updated_at' => now()
            ],

            // Газобетонные материалы
            [
                'name' => 'Газобетонные блоки D400',
                'description' => 'Автоклавный газобетон плотностью 400 кг/м³',
                'price' => 10000,
                'image' => '/img/calculator/materials/aerated_concrete.webp',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Газобетонные блоки D500',
                'description' => 'Автоклавный газобетон повышенной плотности 500 кг/м³',
                'price' => 11500,
                'image' => '/img/calculator/materials/aerated_concrete_d500.webp',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Пенобетонные блоки',
                'description' => 'Легкие пенобетонные блоки с отличной теплоизоляцией',
                'price' => 9000,
                'image' => '/img/calculator/materials/foam_concrete.webp',
                'created_at' => now(),
                'updated_at' => now()
            ],

            // Универсальный вариант
            [
                'name' => 'Другое',
                'description' => 'Альтернативные материалы по индивидуальному проекту',
                'price' => 0,
                'image' => '/img/calculator/materials/other.svg',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
} 