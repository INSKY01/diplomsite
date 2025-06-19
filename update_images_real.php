<?php

// Скрипт для обновления изображений в базе данных калькулятора
require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

echo "Обновление изображений в базе данных на реальные изображения из папки calculator...\n\n";

// Структура изображений (реальные изображения из папки calculator)
$images = [
    'house_types' => [
        'Каркасный дом' => '/img/calculator/house_types/frame_house.webp',
        'Дом из бруса' => '/img/calculator/house_types/timber_house.webp',
        'Кирпичный дом' => '/img/calculator/house_types/brick_house.webp',
        'Дом из газобетона' => '/img/calculator/house_types/aerated_concrete_house.jpg',
        'Другое' => '/img/calculator/materials/other.svg',
    ],
    'floors' => [
        '1 этаж' => '/img/calculator/floors/one_floor.jpg',
        '2 этажа' => '/img/calculator/floors/two_floors.jpg',
        '2 этажа + мансарда' => '/img/calculator/floors/two_floors_attic.jpg',
        'Другое' => '/img/calculator/floors/other.svg',
    ],
    'roofs' => [
        'Металлочерепица' => '/img/calculator/roofs/metal_tile.webp',
        'Мягкая кровля' => '/img/calculator/roofs/soft_roof.webp',
        'Профнастил' => '/img/calculator/roofs/corrugated_metal.jpg',
        'Керамическая черепица' => '/img/calculator/roofs/ceramic_tile.webp',
        'Другое' => '/img/calculator/roofs/other.svg',
    ],
    'materials' => [
        'Каркас + OSB плиты' => '/img/calculator/materials/frame_osb.webp',
        'Профилированный брус 150x150' => '/img/calculator/materials/profiled_timber.webp',
        'Керамический кирпич' => '/img/calculator/materials/ceramic_brick.webp',
        'Газобетонные блоки D400' => '/img/calculator/materials/aerated_concrete.webp',
        'Другое' => '/img/calculator/materials/other.svg',
    ],
    'foundations' => [
        'Свайно-винтовой' => '/img/calculator/foundations/screw_pile.jpg',
        'Ленточный мелкозаглубленный' => '/img/calculator/foundations/shallow_strip.jpg',
        'Ленточный заглубленный' => '/img/calculator/foundations/deep_strip.jpg',
        'Монолитная плита' => '/img/calculator/foundations/concrete_slab.jpeg',
        'Другое' => '/img/calculator/foundations/other.svg',
    ],
    'facades' => [
        'Виниловый сайдинг' => '/img/calculator/facades/vinyl_siding.webp',
        'Имитация бруса' => '/img/calculator/facades/timber_imitation.webp',
        'Фиброцементные панели' => '/img/calculator/facades/fiber_cement.webp',
        'Клинкерная плитка' => '/img/calculator/facades/clinker_tile.webp',
        'Другое' => '/img/calculator/facades/other.svg',
    ],
    'electricals' => [
        'Базовая проводка' => '/img/calculator/electrical/basic.jpg',
        'Улучшенная проводка' => '/img/calculator/electrical/improved.jpg',
        'Премиум проводка' => '/img/calculator/electrical/premium.jpg',
        'Другое' => '/img/calculator/electrical/other.svg',
    ],
    'wall_finishes' => [
        'Покраска стен' => '/img/calculator/wall_finishes/paint.jpg',
        'Обои' => '/img/calculator/wall_finishes/wallpaper.webp',
        'Декоративная штукатурка' => '/img/calculator/wall_finishes/decorative_plaster.jpg',
        'Деревянные панели' => '/img/calculator/wall_finishes/wood_panels.jpg',
        'Другое' => '/img/calculator/wall_finishes/other.svg',
    ],
    'additions' => [
        'Терраса' => '/img/calculator/additions/terrace.jpg',
        'Веранда' => '/img/calculator/additions/veranda.jpg',
        'Камин' => '/img/calculator/additions/fireplace.png',
        'Гараж' => '/img/calculator/additions/garage.jpg',
        'Другое' => '/img/calculator/additions/other.svg',
    ],
];

// Обновляем изображения в базе данных
foreach ($images as $table => $tableImages) {
    echo "Обновление таблицы: $table\n";
    
    foreach ($tableImages as $name => $imagePath) {
        $updated = DB::table($table)
            ->where('name', $name)
            ->update(['image' => $imagePath]);
            
        if ($updated) {
            echo "  ✓ $name -> $imagePath\n";
        } else {
            echo "  ✗ Не найден элемент: $name\n";
        }
    }
    echo "\n";
}

echo "Готово! Изображения обновлены в базе данных.\n";
echo "Теперь используются реальные изображения из папки calculator.\n\n"; 