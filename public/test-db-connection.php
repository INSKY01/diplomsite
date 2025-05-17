<?php

require __DIR__.'/../vendor/autoload.php';

$app = require_once __DIR__.'/../bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Models\HouseType;
use App\Models\Floor;
use App\Models\Roof;
use App\Models\Material;
use App\Models\Foundation;
use App\Models\Facade;
use App\Models\Electrical;
use App\Models\WallFinish;
use App\Models\Addition;

try {
    // Проверяем подключение к базе данных
    echo "Проверка подключения к базе данных...\n";
    $connection = DB::connection()->getPdo();
    echo "Успешное подключение к базе данных: " . DB::connection()->getDatabaseName() . "\n\n";
    
    // Проверяем существование таблиц
    echo "Проверка существования таблиц:\n";
    $tables = [
        'house_types', 'floors', 'roofs', 'materials', 'foundations',
        'facades', 'electrical', 'wall_finishes', 'additions'
    ];
    
    foreach ($tables as $table) {
        if (Schema::hasTable($table)) {
            echo "- Таблица '{$table}' существует\n";
            
            // Считаем количество записей
            $count = DB::table($table)->count();
            echo "  Количество записей: {$count}\n";
            
            // Если записей нет, вставляем тестовые данные
            if ($count == 0) {
                echo "  Вставка тестовых данных...\n";
                
                switch ($table) {
                    case 'house_types':
                        HouseType::create([
                            'name' => 'Тестовый тип дома',
                            'description' => 'Описание тестового типа дома',
                            'price' => 25000,
                            'image' => 'img/test-house.jpg'
                        ]);
                        break;
                        
                    case 'floors':
                        Floor::create([
                            'name' => 'Тестовый этаж',
                            'multiplier' => 1.0,
                            'description' => 'Описание тестового этажа',
                            'image' => 'img/test-floor.jpg'
                        ]);
                        break;
                        
                    case 'roofs':
                        Roof::create([
                            'name' => 'Тестовая крыша',
                            'price' => 15000,
                            'description' => 'Описание тестовой крыши',
                            'image' => 'img/test-roof.jpg'
                        ]);
                        break;
                        
                    case 'materials':
                        Material::create([
                            'name' => 'Тестовый материал',
                            'price' => 5000,
                            'description' => 'Описание тестового материала',
                            'image' => 'img/test-material.jpg'
                        ]);
                        break;
                        
                    case 'foundations':
                        Foundation::create([
                            'name' => 'Тестовый фундамент',
                            'price' => 8000,
                            'description' => 'Описание тестового фундамента',
                            'image' => 'img/test-foundation.jpg'
                        ]);
                        break;
                        
                    case 'facades':
                        Facade::create([
                            'name' => 'Тестовый фасад',
                            'price' => 3000,
                            'description' => 'Описание тестового фасада',
                            'image' => 'img/test-facade.jpg'
                        ]);
                        break;
                        
                    case 'electrical':
                        Electrical::create([
                            'name' => 'Тестовая электрика',
                            'price' => 2000,
                            'description' => 'Описание тестовой электрики',
                            'sockets' => 10,
                            'switches' => 5,
                            'lights' => 8,
                            'image' => 'img/test-electrical.jpg'
                        ]);
                        break;
                        
                    case 'wall_finishes':
                        WallFinish::create([
                            'name' => 'Тестовая отделка стен',
                            'price' => 1500,
                            'description' => 'Описание тестовой отделки стен',
                            'image' => 'img/test-wallfinish.jpg'
                        ]);
                        break;
                        
                    case 'additions':
                        Addition::create([
                            'name' => 'Тестовое дополнение',
                            'price' => 5000,
                            'description' => 'Описание тестового дополнения',
                            'category' => 'design',
                            'image' => 'img/test-addition.jpg'
                        ]);
                        break;
                }
                
                // Проверяем, вставились ли данные
                $newCount = DB::table($table)->count();
                echo "  Новое количество записей: {$newCount}\n";
            }
        } else {
            echo "- ОШИБКА: Таблица '{$table}' не существует!\n";
        }
    }
    
    echo "\nВсе операции выполнены успешно.\n";
    
} catch (\Exception $e) {
    echo "ОШИБКА: " . $e->getMessage() . "\n";
    echo "Код: " . $e->getCode() . "\n";
    echo "Файл: " . $e->getFile() . "\n";
    echo "Строка: " . $e->getLine() . "\n";
    echo "Трассировка:\n" . $e->getTraceAsString() . "\n";
} 