<?php

// Тестирование подключения к MAMP MySQL
echo "Тестирование подключения к MAMP MySQL...\n";

// Настройки подключения
$hosts = ['127.0.0.1', 'localhost'];
$port = 8889;
$database = 'diplomsite';
$username = 'root';
$password = 'root';

foreach ($hosts as $host) {
    echo "\nПробуем подключиться к $host:$port...\n";
    
    try {
        // Попытка подключения
        $dsn = "mysql:host=$host;port=$port;charset=utf8mb4";
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        echo "✅ Подключение к MySQL успешно через $host!\n";
        
        // Проверяем существование базы данных
        $stmt = $pdo->query("SHOW DATABASES LIKE '$database'");
        if ($stmt->rowCount() > 0) {
            echo "✅ База данных '$database' существует\n";
            
            // Подключаемся к конкретной базе данных
            $pdo = new PDO("mysql:host=$host;port=$port;dbname=$database;charset=utf8mb4", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "✅ Подключение к базе данных '$database' успешно!\n";
            
            // Обновляем .env файл с рабочим хостом
            $envContent = file_get_contents('.env');
            $envContent = preg_replace('/DB_HOST=.*/', "DB_HOST=$host", $envContent);
            file_put_contents('.env', $envContent);
            echo "✅ Обновлен .env файл с хостом $host\n";
            
            break;
        } else {
            echo "❌ База данных '$database' не существует\n";
            echo "Создаем базу данных...\n";
            
            $pdo->exec("CREATE DATABASE `$database` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
            echo "✅ База данных '$database' создана успешно!\n";
            
            // Обновляем .env файл с рабочим хостом
            $envContent = file_get_contents('.env');
            $envContent = preg_replace('/DB_HOST=.*/', "DB_HOST=$host", $envContent);
            file_put_contents('.env', $envContent);
            echo "✅ Обновлен .env файл с хостом $host\n";
            
            break;
        }
        
    } catch (PDOException $e) {
        echo "❌ Ошибка подключения через $host: " . $e->getMessage() . "\n";
    }
}

echo "\nИнформация о системе:\n";
echo "PHP версия: " . PHP_VERSION . "\n";
echo "PDO драйверы: " . implode(', ', PDO::getAvailableDrivers()) . "\n";

// Проверяем, запущен ли MAMP
echo "\nПроверка MAMP:\n";
if (file_exists('/Applications/MAMP/MAMP.app')) {
    echo "✅ MAMP установлен\n";
} else {
    echo "❌ MAMP не найден в стандартном месте\n";
}

// Проверяем процессы MySQL
echo "\nПроцессы MySQL:\n";
exec('ps aux | grep mysql', $output);
foreach ($output as $line) {
    if (strpos($line, 'mysqld') !== false) {
        echo "✅ MySQL процесс найден: $line\n";
    }
} 