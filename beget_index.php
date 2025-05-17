<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

// Определяем константу для начала измерения времени
define('LARAVEL_START', microtime(true));

// Определяем пути для beget.tech
$username = 'powerpki'; // Замените на ваше имя пользователя на beget
$laravel_path = '/home/p/' . $username . '/laravel_app';

// Проверяем режим обслуживания
if (file_exists($maintenance = $laravel_path . '/storage/framework/maintenance.php')) {
    require $maintenance;
}

// Подключаем автозагрузчик Composer
require $laravel_path . '/vendor/autoload.php';

// Загружаем приложение Laravel
/** @var Application $app */
$app = require_once $laravel_path . '/bootstrap/app.php';

// Указываем путь к public директории, если необходимо
$app->usePublicPath(__DIR__);

// Обработка запроса
$app->handleRequest(Request::capture()); 