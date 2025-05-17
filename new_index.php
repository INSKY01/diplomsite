<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Путь к основным файлам Laravel (за пределами public_html)
$laravel_path = __DIR__ . '/../laravel_app';

// Определяем режим обслуживания
if (file_exists($maintenance = $laravel_path.'/storage/framework/maintenance.php')) {
    require $maintenance;
}

// Регистрируем автозагрузчик Composer
require $laravel_path.'/vendor/autoload.php';

// Запускаем Laravel и обрабатываем запрос
/** @var Application $app */
$app = require_once $laravel_path.'/bootstrap/app.php';

$app->handleRequest(Request::capture()); 