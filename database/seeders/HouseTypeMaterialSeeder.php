<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HouseTypeMaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Очищаем таблицу перед заполнением
        DB::table('house_type_material')->truncate();

        // Соответствия типов домов и материалов
        $houseTypeMaterials = [
            // Каркасный дом (id: 1) - каркасные материалы
            ['house_type_id' => 1, 'material_id' => 6], // Каркас + OSB плиты
            ['house_type_id' => 1, 'material_id' => 7], // Каркас + СИП панели
            ['house_type_id' => 1, 'material_id' => 8], // Металлокаркас + ГВЛ
            ['house_type_id' => 1, 'material_id' => 18], // Другое

            // Дом из бруса (id: 2) - деревянные материалы
            ['house_type_id' => 2, 'material_id' => 9], // Профилированный брус 150x150
            ['house_type_id' => 2, 'material_id' => 10], // Клееный брус 200x200
            ['house_type_id' => 2, 'material_id' => 11], // Оцилиндрованное бревно D240
            ['house_type_id' => 2, 'material_id' => 18], // Другое

            // Кирпичный дом (id: 3) - кирпичные материалы
            ['house_type_id' => 3, 'material_id' => 12], // Керамический кирпич
            ['house_type_id' => 3, 'material_id' => 13], // Силикатный кирпич
            ['house_type_id' => 3, 'material_id' => 14], // Поризованная керамика
            ['house_type_id' => 3, 'material_id' => 18], // Другое

            // Дом из газобетона (id: 4) - газобетонные материалы
            ['house_type_id' => 4, 'material_id' => 15], // Газобетонные блоки D400
            ['house_type_id' => 4, 'material_id' => 16], // Газобетонные блоки D500
            ['house_type_id' => 4, 'material_id' => 17], // Пенобетонные блоки
            ['house_type_id' => 4, 'material_id' => 18], // Другое

            // Другое (id: 5) - все материалы
            ['house_type_id' => 5, 'material_id' => 6], // Каркас + OSB плиты
            ['house_type_id' => 5, 'material_id' => 7], // Каркас + СИП панели
            ['house_type_id' => 5, 'material_id' => 8], // Металлокаркас + ГВЛ
            ['house_type_id' => 5, 'material_id' => 9], // Профилированный брус 150x150
            ['house_type_id' => 5, 'material_id' => 10], // Клееный брус 200x200
            ['house_type_id' => 5, 'material_id' => 11], // Оцилиндрованное бревно D240
            ['house_type_id' => 5, 'material_id' => 12], // Керамический кирпич
            ['house_type_id' => 5, 'material_id' => 13], // Силикатный кирпич
            ['house_type_id' => 5, 'material_id' => 14], // Поризованная керамика
            ['house_type_id' => 5, 'material_id' => 15], // Газобетонные блоки D400
            ['house_type_id' => 5, 'material_id' => 16], // Газобетонные блоки D500
            ['house_type_id' => 5, 'material_id' => 17], // Пенобетонные блоки
            ['house_type_id' => 5, 'material_id' => 18], // Другое
        ];

        DB::table('house_type_material')->insert($houseTypeMaterials);
    }
}
