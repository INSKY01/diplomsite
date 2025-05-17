<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ImportAdminData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:admin-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Импорт данных из admin.js в базу данных';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $data = [
            'houseTypes' => [
                [
                    'name' => "Каркасный дом",
                    'description' => "Современный деревянный каркасный дом с отличной теплоизоляцией",
                    'price' => 25000,
                    'image' => "img/carc-house.png"
                ],
                // Добавьте остальные типы домов
            ],
            'floors' => [
                [
                    'name' => 'Одноэтажный',
                    'value' => 1,
                    'multiplier' => 1,
                    'image' => 'img/1floor.jpg',
                    'description' => 'Одноэтажный дом - классическое решение для небольшой семьи'
                ],
                // Добавьте остальные этажи
            ],
            // Добавьте остальные категории данных
        ];

        // Импорт данных в таблицы
        foreach ($data['houseTypes'] as $houseType) {
            DB::table('house_types')->insert($houseType);
        }

        foreach ($data['floors'] as $floor) {
            DB::table('floors')->insert($floor);
        }

        // Повторите для остальных категорий данных

        $this->info('Данные успешно импортированы в базу данных.');
    }
}
