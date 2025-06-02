<?php

// Скрипт для создания заглушек изображений (простые SVG)
$categories = [
    'house_types' => [
        'frame_house' => 'Каркасный дом',
        'timber_house' => 'Дом из бруса', 
        'brick_house' => 'Кирпичный дом',
        'aerated_concrete_house' => 'Дом из газобетона'
    ],
    'floors' => [
        'one_floor' => '1 этаж',
        'two_floors' => '2 этажа',
        'two_floors_attic' => '2 этажа + мансарда',
        'other' => 'Другое'
    ],
    'roofs' => [
        'metal_tile' => 'Металлочерепица',
        'soft_roof' => 'Мягкая кровля',
        'corrugated_metal' => 'Профнастил',
        'ceramic_tile' => 'Керамическая черепица',
        'other' => 'Другое'
    ],
    'materials' => [
        'frame_osb' => 'Каркас + OSB',
        'profiled_timber' => 'Профилированный брус',
        'ceramic_brick' => 'Керамический кирпич',
        'aerated_concrete' => 'Газобетонные блоки',
        'other' => 'Другое'
    ],
    'foundations' => [
        'screw_pile' => 'Свайно-винтовой',
        'shallow_strip' => 'Ленточный мелкозаглубленный',
        'deep_strip' => 'Ленточный заглубленный',
        'concrete_slab' => 'Монолитная плита',
        'other' => 'Другое'
    ],
    'facades' => [
        'vinyl_siding' => 'Виниловый сайдинг',
        'timber_imitation' => 'Имитация бруса',
        'fiber_cement' => 'Фиброцементные панели',
        'clinker_tile' => 'Клинкерная плитка',
        'other' => 'Другое'
    ],
    'electrical' => [
        'basic' => 'Базовая проводка',
        'improved' => 'Улучшенная проводка',
        'premium' => 'Премиум проводка',
        'other' => 'Другое'
    ],
    'wall_finishes' => [
        'paint' => 'Покраска стен',
        'wallpaper' => 'Обои',
        'decorative_plaster' => 'Декоративная штукатурка',
        'wood_panels' => 'Деревянные панели',
        'other' => 'Другое'
    ],
    'additions' => [
        'terrace' => 'Терраса',
        'veranda' => 'Веранда',
        'fireplace' => 'Камин',
        'garage' => 'Гараж',
        'other' => 'Другое'
    ]
];

// Цвета для разных категорий
$colors = [
    'house_types' => '#4CAF50',
    'floors' => '#2196F3', 
    'roofs' => '#FF9800',
    'materials' => '#9C27B0',
    'foundations' => '#795548',
    'facades' => '#607D8B',
    'electrical' => '#FFC107',
    'wall_finishes' => '#E91E63',
    'additions' => '#00BCD4'
];

function createPlaceholderSVG($text, $color = '#4CAF50') {
    // Разбиваем текст на строки для лучшего отображения
    $words = explode(' ', $text);
    $lines = [];
    $currentLine = '';
    
    foreach ($words as $word) {
        if (strlen($currentLine . ' ' . $word) <= 15) {
            $currentLine .= ($currentLine ? ' ' : '') . $word;
        } else {
            if ($currentLine) $lines[] = $currentLine;
            $currentLine = $word;
        }
    }
    if ($currentLine) $lines[] = $currentLine;
    
    // Ограничиваем до 3 строк
    $lines = array_slice($lines, 0, 3);
    
    // Создаем SVG
    $svg = '<?xml version="1.0" encoding="UTF-8"?>
<svg width="400" height="300" viewBox="0 0 400 300" xmlns="http://www.w3.org/2000/svg">
    <rect width="400" height="300" fill="' . $color . '10"/>
    <rect x="20" y="20" width="360" height="260" fill="white" stroke="' . $color . '" stroke-width="2" rx="10"/>
    <circle cx="200" cy="120" r="40" fill="' . $color . '30"/>
    <rect x="170" y="90" width="60" height="60" fill="' . $color . '" rx="5"/>
    <rect x="185" y="105" width="30" height="30" fill="white" rx="3"/>';
    
    // Добавляем текст
    $startY = 190;
    foreach ($lines as $i => $line) {
        $y = $startY + ($i * 25);
        $svg .= '<text x="200" y="' . $y . '" text-anchor="middle" font-family="Arial, sans-serif" font-size="18" font-weight="bold" fill="' . $color . '">' . htmlspecialchars($line) . '</text>';
    }
    
    $svg .= '</svg>';
    return $svg;
}

echo "Создание заглушек изображений...\n\n";

foreach ($categories as $category => $items) {
    $color = $colors[$category] ?? '#4CAF50';
    echo "Категория: $category\n";
    
    foreach ($items as $filename => $title) {
        $dir = "public/img/calculator/$category";
        $filepath = "$dir/$filename.svg";
        
        // Создаем директорию если не существует
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
        
        // Создаем SVG заглушку
        $svg = createPlaceholderSVG($title, $color);
        file_put_contents($filepath, $svg);
        
        echo "  ✓ $title -> $filepath\n";
    }
    echo "\n";
}

echo "Готово! Созданы SVG заглушки для всех изображений.\n";
echo "Теперь вы можете заменить их на реальные изображения по мере необходимости.\n"; 