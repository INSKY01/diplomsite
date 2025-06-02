<?php

// Скрипт для обновления изображений в базе данных калькулятора
require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

echo "Обновление изображений в базе данных...\n\n";

// Структура изображений (SVG заглушки)
$images = [
    'house_types' => [
        'Каркасный дом' => '/img/calculator/house_types/frame_house.svg',
        'Дом из бруса' => '/img/calculator/house_types/timber_house.svg',
        'Кирпичный дом' => '/img/calculator/house_types/brick_house.svg',
        'Дом из газобетона' => '/img/calculator/house_types/aerated_concrete_house.svg',
    ],
    'floors' => [
        '1 этаж' => '/img/calculator/floors/one_floor.svg',
        '2 этажа' => '/img/calculator/floors/two_floors.svg',
        '2 этажа + мансарда' => '/img/calculator/floors/two_floors_attic.svg',
        'Другое' => '/img/calculator/floors/other.svg',
    ],
    'roofs' => [
        'Металлочерепица' => '/img/calculator/roofs/metal_tile.svg',
        'Мягкая кровля' => '/img/calculator/roofs/soft_roof.svg',
        'Профнастил' => '/img/calculator/roofs/corrugated_metal.svg',
        'Керамическая черепица' => '/img/calculator/roofs/ceramic_tile.svg',
        'Другое' => '/img/calculator/roofs/other.svg',
    ],
    'materials' => [
        'Каркас + OSB плиты' => '/img/calculator/materials/frame_osb.svg',
        'Профилированный брус 150x150' => '/img/calculator/materials/profiled_timber.svg',
        'Керамический кирпич' => '/img/calculator/materials/ceramic_brick.svg',
        'Газобетонные блоки D400' => '/img/calculator/materials/aerated_concrete.svg',
        'Другое' => '/img/calculator/materials/other.svg',
    ],
    'foundations' => [
        'Свайно-винтовой' => '/img/calculator/foundations/screw_pile.svg',
        'Ленточный мелкозаглубленный' => '/img/calculator/foundations/shallow_strip.svg',
        'Ленточный заглубленный' => '/img/calculator/foundations/deep_strip.svg',
        'Монолитная плита' => '/img/calculator/foundations/concrete_slab.svg',
        'Другое' => '/img/calculator/foundations/other.svg',
    ],
    'facades' => [
        'Виниловый сайдинг' => '/img/calculator/facades/vinyl_siding.svg',
        'Имитация бруса' => '/img/calculator/facades/timber_imitation.svg',
        'Фиброцементные панели' => '/img/calculator/facades/fiber_cement.svg',
        'Клинкерная плитка' => '/img/calculator/facades/clinker_tile.svg',
        'Другое' => '/img/calculator/facades/other.svg',
    ],
    'electricals' => [
        'Базовая проводка' => '/img/calculator/electrical/basic.svg',
        'Улучшенная проводка' => '/img/calculator/electrical/improved.svg',
        'Премиум проводка' => '/img/calculator/electrical/premium.svg',
        'Другое' => '/img/calculator/electrical/other.svg',
    ],
    'wall_finishes' => [
        'Покраска стен' => '/img/calculator/wall_finishes/paint.svg',
        'Обои' => '/img/calculator/wall_finishes/wallpaper.svg',
        'Декоративная штукатурка' => '/img/calculator/wall_finishes/decorative_plaster.svg',
        'Деревянные панели' => '/img/calculator/wall_finishes/wood_panels.svg',
        'Другое' => '/img/calculator/wall_finishes/other.svg',
    ],
    'additions' => [
        'Терраса' => '/img/calculator/additions/terrace.svg',
        'Веранда' => '/img/calculator/additions/veranda.svg',
        'Камин' => '/img/calculator/additions/fireplace.svg',
        'Гараж' => '/img/calculator/additions/garage.svg',
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
echo "Установлены SVG заглушки. Вы можете заменить их на реальные изображения.\n\n";

echo "Рекомендуемые сайты для поиска изображений:\n";
echo "- https://unsplash.com\n";
echo "- https://pexels.com\n";
echo "- https://pixabay.com\n";
echo "- https://bing.com/create (AI генератор)\n"; 