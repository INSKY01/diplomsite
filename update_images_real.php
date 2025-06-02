<?php

// Скрипт для обновления путей к реальным изображениям в базе данных
require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

echo "Обновление путей к реальным изображениям...\n\n";

// Функция для поиска реального файла изображения
function findRealImage($basePath, $fileName) {
    $extensions = ['jpg', 'jpeg', 'png', 'webp'];
    
    foreach ($extensions as $ext) {
        $fullPath = "public/img/calculator/{$basePath}/{$fileName}.{$ext}";
        if (file_exists($fullPath)) {
            return "/img/calculator/{$basePath}/{$fileName}.{$ext}";
        }
    }
    
    // Если реальное изображение не найдено, возвращаем SVG заглушку
    return "/img/calculator/{$basePath}/{$fileName}.svg";
}

// Определяем пути к изображениям
$imageMapping = [
    'house_types' => [
        'Каркасный дом' => 'frame_house',
        'Дом из бруса' => 'timber_house',
        'Кирпичный дом' => 'brick_house',
        'Дом из газобетона' => 'aerated_concrete_house',
    ],
    'floors' => [
        '1 этаж' => 'one_floor',
        '2 этажа' => 'two_floors',
        '2 этажа + мансарда' => 'two_floors_attic',
        'Другое' => 'other',
    ],
    'roofs' => [
        'Металлочерепица' => 'metal_tile',
        'Мягкая кровля' => 'soft_roof',
        'Профнастил' => 'corrugated_metal',
        'Керамическая черепица' => 'ceramic_tile',
        'Другое' => 'other',
    ],
    'materials' => [
        'Каркас + OSB плиты' => 'frame_osb',
        'Профилированный брус 150x150' => 'profiled_timber',
        'Керамический кирпич' => 'ceramic_brick',
        'Газобетонные блоки D400' => 'aerated_concrete',
        'Другое' => 'other',
    ],
    'foundations' => [
        'Свайно-винтовой' => 'screw_pile',
        'Ленточный мелкозаглубленный' => 'shallow_strip',
        'Ленточный заглубленный' => 'deep_strip',
        'Монолитная плита' => 'concrete_slab',
        'Другое' => 'other',
    ],
    'facades' => [
        'Виниловый сайдинг' => 'vinyl_siding',
        'Имитация бруса' => 'timber_imitation',
        'Фиброцементные панели' => 'fiber_cement',
        'Клинкерная плитка' => 'clinker_tile',
        'Другое' => 'other',
    ],
    'electricals' => [
        'Базовая проводка' => 'basic',
        'Улучшенная проводка' => 'improved',
        'Премиум проводка' => 'premium',
        'Другое' => 'other',
    ],
    'wall_finishes' => [
        'Покраска стен' => 'paint',
        'Обои' => 'wallpaper',
        'Декоративная штукатурка' => 'decorative_plaster',
        'Деревянные панели' => 'wood_panels',
        'Другое' => 'other',
    ],
    'additions' => [
        'Терраса' => 'terrace',
        'Веранда' => 'veranda',
        'Камин' => 'fireplace',
        'Гараж' => 'garage',
        'Другое' => 'other',
    ],
];

$totalUpdated = 0;
$foundImages = 0;

// Обновляем изображения в базе данных
foreach ($imageMapping as $table => $items) {
    echo "Обновление таблицы: $table\n";
    
    foreach ($items as $name => $fileName) {
        // Определяем путь к папке (учитываем особенность названия таблицы electrical)
        $folderName = $table === 'electricals' ? 'electrical' : $table;
        
        // Ищем реальное изображение
        $imagePath = findRealImage($folderName, $fileName);
        
        // Проверяем, найдено ли реальное изображение
        $isRealImage = !str_ends_with($imagePath, '.svg');
        
        $updated = DB::table($table)
            ->where('name', $name)
            ->update(['image' => $imagePath]);
            
        if ($updated) {
            $totalUpdated++;
            if ($isRealImage) {
                $foundImages++;
                echo "  ✓ $name -> $imagePath (РЕАЛЬНОЕ ИЗОБРАЖЕНИЕ)\n";
            } else {
                echo "  ○ $name -> $imagePath (SVG заглушка)\n";
            }
        } else {
            echo "  ✗ Не найден элемент: $name\n";
        }
    }
    echo "\n";
}

echo "==========================================\n";
echo "Готово! Обновлено записей: $totalUpdated\n";
echo "Найдено реальных изображений: $foundImages из " . array_sum(array_map('count', $imageMapping)) . "\n";
echo "SVG заглушек: " . (array_sum(array_map('count', $imageMapping)) - $foundImages) . "\n\n";

// Показываем статистику по папкам
echo "Статистика по категориям:\n";
foreach ($imageMapping as $table => $items) {
    $folderName = $table === 'electricals' ? 'electrical' : $table;
    $realCount = 0;
    
    foreach ($items as $name => $fileName) {
        $imagePath = findRealImage($folderName, $fileName);
        if (!str_ends_with($imagePath, '.svg')) {
            $realCount++;
        }
    }
    
    echo "- " . ucfirst($folderName) . ": $realCount/" . count($items) . " реальных изображений\n";
}

echo "\nДля завершения работы замените оставшиеся SVG заглушки на реальные изображения.\n"; 