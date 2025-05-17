<?php

use App\Models\House;
use Illuminate\Support\Facades\DB;

require 'vendor/autoload.php'; // Убедитесь, что путь к autoload.php правильный

// Ваши данные о домах из admin.js
$houses = [
    [
        'name' => 'Каркасный дом',
        'type' => 'Каркасный',
        'description' => 'Современный деревянный каркасный дом с отличной теплоизоляцией',
        'price' => 25000,
    ],
    [
        'name' => 'Дом из бруса',
        'type' => 'Брус',
        'description' => 'Классический дом из строганного бруса',
        'price' => 30000,
    ],
    [
        'name' => 'Дом из бревна',
        'type' => 'Бревно',
        'description' => 'Традиционный дом из оцилиндрованного бревна',
        'price' => 35000,
    ],
    [
        'name' => 'Дом из лафета',
        'type' => 'Лафет',
        'description' => 'Премиальный дом из лафета ручной рубки',
        'price' => 40000,
    ]
];

// Импорт данных в базу данных
foreach ($houses as $house) {
    House::create($house);
}

echo "Данные успешно импортированы!"; 