# Настройка проекта для работы с AMPPS

## Шаги для настройки:

### 1. Установка и запуск AMPPS
- Установите AMPPS
- Запустите AMPPS
- Убедитесь, что Apache и MySQL запущены
- По умолчанию AMPPS использует:
  - Apache: порт 80
  - MySQL: порт 3306
  - Пароль root: `mysql`

### 2. Создание базы данных
- Откройте phpMyAdmin: http://localhost/phpmyadmin
- Войдите с логином `root` и паролем `mysql`
- Создайте новую базу данных с именем `diplomsite`
- Убедитесь, что кодировка установлена как `utf8mb4_unicode_ci`

### 3. Настройка проекта
Проект настроен для работы с AMPPS:
- База данных: `diplomsite`
- Хост: `127.0.0.1`
- Порт: `3306` (стандартный порт MySQL)
- Пользователь: `root`
- Пароль: `mysql`

### 4. Установка зависимостей и миграции
Выполните следующие команды в терминале:

```bash
# Установка зависимостей PHP
composer install

# Установка зависимостей Node.js (если нужно)
npm install

# Создание ключа приложения (если нужно)
php artisan key:generate

# Запуск миграций
php artisan migrate

# Заполнение базы данных тестовыми данными
php artisan db:seed
```

### 5. Доступ к проекту
**Вариант 1: Через папку AMPPS**
- Поместите проект в папку AMPPS: `/Applications/AMPPS/www/diplomsite`
- Откройте в браузере: http://localhost/diplomsite/public

**Вариант 2: Через встроенный сервер Laravel**
```bash
# Запуск встроенного сервера Laravel
php artisan serve --host=0.0.0.0 --port=8000
```
Затем откройте: http://localhost:8000

**Вариант 3: Настройка виртуального хоста**
- В AMPPS настройте виртуальный хост для проекта
- Укажите DocumentRoot на папку `public` вашего проекта

### 6. Проверка подключения
Для проверки подключения к базе данных выполните:
```bash
php artisan tinker
```
И попробуйте выполнить простой запрос:
```php
DB::connection()->getPdo();
```

## Важные замечания:

1. **PHP версия**: AMPPS с PHP 8.2 полностью совместим с проектом
2. **Порт MySQL**: AMPPS использует стандартный порт 3306
3. **Пароль**: По умолчанию в AMPPS пароль root - это "mysql"
4. **Кодировка**: Убедитесь, что база данных создана с кодировкой utf8mb4_unicode_ci
5. **Права доступа**: Убедитесь, что папки storage и bootstrap/cache имеют права на запись

## Преимущества AMPPS:
- Более стабильная работа
- Лучшая производительность
- Встроенный phpMyAdmin
- Простая настройка виртуальных хостов
- Поддержка множественных версий PHP 