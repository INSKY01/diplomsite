<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Запускаем все сиды для калькулятора с обновленными изображениями
        $this->call([
            HouseTypesTableSeeder::class,
            MaterialsTableSeeder::class,
            FoundationsTableSeeder::class,
            FloorsTableSeeder::class,
            RoofsTableSeeder::class,
            FacadesTableSeeder::class,
            ElectricalTableSeeder::class,
            WallFinishesTableSeeder::class,
            AdditionsTableSeeder::class,
        ]);
    }
}
