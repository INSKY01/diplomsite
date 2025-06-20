# Дипломный проект - Калькулятор строительства домов

## Описание проекта
Веб-приложение для расчета стоимости строительства домов с различными типами материалов, фундаментов, крыш и дополнительными опциями.

## Технологии
- **Backend**: Laravel 11 (PHP 8.2+)
- **Frontend**: HTML, CSS, JavaScript
- **База данных**: MySQL
- **Сервер**: AMPPS (Apache + MySQL + PHP)

## Быстрый запуск на AMPPS

### 1. Предварительные требования
- Установленный AMPPS
- PHP 8.2 или выше
- Composer

### 2. Настройка проекта
```bash
# Клонирование проекта (если нужно)
git clone <repository-url>
cd diplomsite

# Установка зависимостей
composer install

# Создание файла конфигурации
cp .env.example .env

# Генерация ключа приложения
php artisan key:generate
```

### 3. Настройка базы данных
1. Запустите AMPPS
2. Убедитесь, что Apache и MySQL запущены
3. Создайте базу данных `diplomsite` в phpMyAdmin (http://localhost/phpmyadmin)
   - Логин: `root`
   - Пароль: `mysql`
   - Кодировка: `utf8mb4_unicode_ci`

### 4. Запуск миграций и заполнение данных
```bash
# Запуск миграций
php artisan migrate

# Заполнение базы данных тестовыми данными
php artisan db:seed
```

### 5. Запуск проекта
```bash
# Запуск встроенного сервера Laravel
php artisan serve --host=0.0.0.0 --port=8000
```

### 6. Доступ к проекту
- **Главная страница**: http://localhost:8000
- **Калькулятор**: http://localhost:8000/calc
- **Админ-панель**: http://localhost:8000/admin
- **API данных**: http://localhost:8000/api/calculator/data

## Структура проекта

### Основные страницы
- `/` - Главная страница
- `/calc` - Калькулятор строительства
- `/reviews` - Отзывы клиентов
- `/galery` - Галерея работ
- `/contacts` - Контакты
- `/admin` - Админ-панель

### API Endpoints
- `GET /api/calculator/data` - Все данные для калькулятора
- `GET /api/calculator/house-types` - Типы домов
- `GET /api/calculator/materials` - Все материалы
- `GET /api/calculator/materials/by-house-type/{id}` - Материалы по типу дома ⭐
- `GET /api/calculator/foundations` - Фундаменты
- `GET /api/calculator/roofs` - Крыши
- `GET /api/calculator/facades` - Фасады
- `GET /api/calculator/electrical` - Электрика
- `GET /api/calculator/wall-finishes` - Отделка стен
- `GET /api/calculator/additions` - Дополнения
- `POST /api/calculator/submit-request` - Отправка заявки

### Админ-панель
- Управление всеми типами данных
- Просмотр и обработка заявок
- Статистика по заявкам

## 🏗️ Логика соответствия типов домов и материалов

### Каркасный дом
- ✅ Каркас + OSB плиты
- ✅ Другое

### Дом из бруса
- ✅ Профилированный брус 150x150
- ✅ Другое

### Кирпичный дом
- ✅ Керамический кирпич
- ✅ Другое

### Дом из газобетона
- ✅ Газобетонные блоки D400
- ✅ Другое

### Другое
- ✅ Все материалы

## Конфигурация базы данных
Проект настроен для работы с AMPPS:
- **Хост**: 127.0.0.1
- **Порт**: 3306
- **База данных**: diplomsite
- **Пользователь**: root
- **Пароль**: mysql

## Важные замечания
1. Убедитесь, что папки `storage` и `bootstrap/cache` имеют права на запись
2. Для продакшена рекомендуется настроить виртуальный хост в AMPPS
3. Все изображения находятся в папке `public/img/`
4. API возвращает данные в формате JSON с поддержкой UTF-8
5. **Новая логика**: Материалы фильтруются по типу дома для логической корректности

## Разработка
Для разработки используйте встроенный сервер Laravel:
```bash
php artisan serve --host=0.0.0.0 --port=8000
```

Для продакшена рекомендуется настроить виртуальный хост в AMPPS, указав DocumentRoot на папку `public` проекта.

## Документация
- **API Документация**: `API_DOCUMENTATION.md`
- **Инструкции по запуску**: `LAUNCH_INSTRUCTIONS.md`
- **Быстрый старт**: `QUICK_START.md`

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
