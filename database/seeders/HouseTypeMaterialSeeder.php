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
            // Каркасный дом (id: 1) - только каркасные материалы
            ['house_type_id' => 1, 'material_id' => 1], // Каркас + OSB плиты
            ['house_type_id' => 1, 'material_id' => 5], // Другое

            // Дом из бруса (id: 2) - только деревянные материалы
            ['house_type_id' => 2, 'material_id' => 2], // Профилированный брус 150x150
            ['house_type_id' => 2, 'material_id' => 5], // Другое

            // Кирпичный дом (id: 3) - только кирпичные материалы
            ['house_type_id' => 3, 'material_id' => 3], // Керамический кирпич
            ['house_type_id' => 3, 'material_id' => 5], // Другое

            // Дом из газобетона (id: 4) - только газобетонные материалы
            ['house_type_id' => 4, 'material_id' => 4], // Газобетонные блоки D400
            ['house_type_id' => 4, 'material_id' => 5], // Другое

            // Другое (id: 5) - все материалы
            ['house_type_id' => 5, 'material_id' => 1], // Каркас + OSB плиты
            ['house_type_id' => 5, 'material_id' => 2], // Профилированный брус 150x150
            ['house_type_id' => 5, 'material_id' => 3], // Керамический кирпич
            ['house_type_id' => 5, 'material_id' => 4], // Газобетонные блоки D400
            ['house_type_id' => 5, 'material_id' => 5], // Другое
        ];

        DB::table('house_type_material')->insert($houseTypeMaterials);
    }
}
