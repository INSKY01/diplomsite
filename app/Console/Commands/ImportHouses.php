<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\House;

class ImportHouses extends Command
{
    protected $signature = 'import:houses';
    protected $description = 'Импорт данных о домах';

    public function handle()
    {
        $houses = [
            [
                'name' => 'Деревянный дом',
                'type' => 'Деревянный',
                'description' => 'Описание деревянного дома.',
                'price' => 1000000.00,
            ],
            [
                'name' => 'Каркасный дом',
                'type' => 'Каркасный',
                'description' => 'Описание каркасного дома.',
                'price' => 1200000.00,
            ],
            [
                'name' => 'Баня',
                'type' => 'Баня',
                'description' => 'Описание бани.',
                'price' => 800000.00,
            ],
        ];

        foreach ($houses as $house) {
            House::create($house);
        }

        $this->info('Данные успешно импортированы!');
    }
} 