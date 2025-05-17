<?php

// Файл инициализации для Laravel на хостинге beget.tech

// Определяем пути
$username = 'powerpki'; // Замените на ваше имя пользователя на beget
$domain = 'powerpki.beget.tech'; // Замените на ваш домен

// Путь к основным файлам Laravel
$laravel_path = '/home/p/' . $username . '/laravel_app';

// Путь к public директории Laravel
$public_path = '/home/p/' . $username . '/' . $domain . '/public_html';

// Создаем символические ссылки для storage
$storage_link_command = 'ln -sf ' . $laravel_path . '/storage/app/public ' . $public_path . '/storage';
shell_exec($storage_link_command);

// Выводим информацию о путях для отладки
echo "Laravel Path: " . $laravel_path . "<br>";
echo "Public Path: " . $public_path . "<br>";
echo "Storage Link Command: " . $storage_link_command . "<br>";

echo "Файл инициализации выполнен успешно.<br>"; 