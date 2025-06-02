# Структура проекта - Калькулятор строительства домов

## Миграции (database/migrations)

### Основные таблицы Laravel
- `0001_01_01_000000_create_users_table.php` - пользователи
- `0001_01_01_000001_create_cache_table.php` - кэш
- `0001_01_01_000002_create_jobs_table.php` - очереди

### Таблицы калькулятора
- `2024_03_19_create_all_tables.php` - **ГЛАВНАЯ МИГРАЦИЯ** создает все таблицы калькулятора:
  - `house_types` - типы домов (каркасный, брус, кирпич, газобетон)
  - `floors` - этажность (1 этаж, 2 этажа, 2+мансарда)
  - `materials` - материалы стен
  - `foundations` - типы фундаментов
  - `roofs` - типы кровли
  - `facades` - фасадные материалы
  - `electricals` - варианты электрики
  - `wall_finishes` - отделка стен
  - `additions` - дополнения (терраса, камин, гараж и т.д.)

### Дополнительные таблицы
- `2023_01_01_000002_create_requests_table.php` - заявки с калькулятора
- `2025_03_03_224405_create_feedback_table.php` - обратная связь

## Сидеры (database/seeders)

### Главный сидер
- `DatabaseSeeder.php` - запускает все сидеры калькулятора

### Сидеры данных (содержат актуальные данные с изображениями)
- `HouseTypesTableSeeder.php` - типы домов
- `MaterialsTableSeeder.php` - материалы
- `FoundationsTableSeeder.php` - фундаменты
- `FloorsTableSeeder.php` - этажность
- `RoofsTableSeeder.php` - кровля
- `FacadesTableSeeder.php` - фасады
- `ElectricalTableSeeder.php` - электрика
- `WallFinishesTableSeeder.php` - отделка стен
- `AdditionsTableSeeder.php` - дополнения

## Модели (app/Models)

### Модели калькулятора
- `HouseType.php` - типы домов
- `Floor.php` - этажность (с полем multiplier)
- `Material.php` - материалы
- `Foundation.php` - фундаменты
- `Roof.php` - кровля
- `Facade.php` - фасады
- `Electrical.php` - электрика (таблица: electricals)
- `WallFinish.php` - отделка стен
- `Addition.php` - дополнения (с полем category)

### Дополнительные модели
- `Request.php` - заявки
- `Feedback.php` - обратная связь
- `User.php` - пользователи

## Контроллеры

### Основные контроллеры
- `CalculatorDataController.php` - API для калькулятора (использует модели)
- `AdminController.php` - админ-панель (работает с таблицами напрямую)

## Особенности структуры

1. **Таблица floors** использует поле `multiplier` вместо `price`
2. **Таблица electricals** (не electrical) 
3. **Таблица additions** имеет поле `category` (design, comfort, utility, safety)
4. **Все изображения** используют Unsplash URLs
5. **Данные только в сидерах** - миграции создают только структуру таблиц

## Команды для работы

```bash
# Запуск миграций
php artisan migrate

# Заполнение данными
php artisan db:seed

# Запуск сервера
php artisan serve --port=8003
```

## Админ-панель
- URL: `/admin`
- Пароль: `Respons1` (из .env ADMIN_PASSWORD) 