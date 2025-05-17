<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class FillDatabase extends Command
{
    protected $signature = 'fill:database';
    protected $description = 'Заполняет таблицу types данными из admin.js';

    public function handle()
    {
        $data = [
            ['name' => 'Тип 1', 'value' => 100],
            ['name' => 'Тип 2', 'value' => 200],
            // Добавьте другие типы по необходимости
        ];

        foreach ($data as $item) {
            DB::table('types')->insert($item);
        }

        $this->info('Данные успешно добавлены в таблицу types.');
    }
} 