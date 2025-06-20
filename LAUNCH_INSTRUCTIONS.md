# 🚀 Инструкция по запуску сервера

## Быстрый запуск (если проект уже настроен)

### 1. Запуск AMPPS
1. Найдите иконку AMPPS в системном трее (рядом с часами)
2. Если AMPPS не запущен - запустите его
3. Убедитесь, что Apache и MySQL работают (зеленые индикаторы)

### 2. Запуск Laravel сервера
```bash
# Откройте терминал в папке проекта
cd /Users/admin/Desktop/demo/diplomsite

# Запустите сервер
php artisan serve --host=0.0.0.0 --port=8000
```

### 3. Проверка работы
- Откройте браузер
- Перейдите на http://localhost:8000
- Сайт должен загрузиться

---

## Полная инструкция (если что-то не работает)

### Шаг 1: Проверка AMPPS
```bash
# Проверьте, что AMPPS запущен
ps aux | grep -i ampps

# Если не запущен - запустите AMPPS вручную
```

### Шаг 2: Проверка базы данных
```bash
# Проверьте подключение к MySQL
/Applications/AMPPS/apps/mysql/bin/mysql -u root -pmysql -e "SHOW DATABASES;"

# Убедитесь, что база diplomsite существует
/Applications/AMPPS/apps/mysql/bin/mysql -u root -pmysql -e "USE diplomsite; SHOW TABLES;"
```

### Шаг 3: Проверка конфигурации
```bash
# Убедитесь, что файл .env существует и настроен
cat .env | grep DB_
```

Должно быть:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=diplomsite
DB_USERNAME=root
DB_PASSWORD=mysql
```

### Шаг 4: Проверка зависимостей
```bash
# Убедитесь, что все зависимости установлены
composer install

# Проверьте ключ приложения
php artisan key:generate
```

### Шаг 5: Проверка прав доступа
```bash
# Установите права на папки
chmod -R 775 storage bootstrap/cache
```

### Шаг 6: Запуск сервера
```bash
# Запустите сервер
php artisan serve --host=0.0.0.0 --port=8000
```

---

## Полезные команды

### Остановка сервера
```bash
# В терминале с запущенным сервером нажмите:
Ctrl + C
```

### Проверка статуса сервера
```bash
# Проверьте, запущен ли сервер
ps aux | grep "php artisan serve"

# Проверьте, отвечает ли сервер
curl -I http://localhost:8000
```

### Очистка кэша (если что-то не работает)
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

### Перезапуск с другим портом
```bash
# Если порт 8000 занят
php artisan serve --host=0.0.0.0 --port=8001
```

---

## Доступные URL

После запуска сервера доступны:

- **Главная страница**: http://localhost:8000
- **Калькулятор**: http://localhost:8000/calc
- **Отзывы**: http://localhost:8000/reviews
- **Галерея**: http://localhost:8000/galery
- **Контакты**: http://localhost:8000/contacts
- **Админ-панель**: http://localhost:8000/admin
- **API данных**: http://localhost:8000/api/calculator/data

---

## Устранение проблем

### Ошибка "Port already in use"
```bash
# Найдите процесс, использующий порт 8000
lsof -i :8000

# Завершите процесс или используйте другой порт
php artisan serve --port=8001
```

### Ошибка подключения к базе данных
```bash
# Проверьте, что MySQL запущен
ps aux | grep mysql

# Проверьте подключение
/Applications/AMPPS/apps/mysql/bin/mysql -u root -pmysql -e "SELECT 1;"
```

### Ошибка "Class not found"
```bash
# Переустановите зависимости
composer install
composer dump-autoload
```

### Ошибка прав доступа
```bash
# Установите права на папки
chmod -R 775 storage bootstrap/cache
```

---

## Краткая памятка

```bash
# Быстрый запуск (3 команды):
cd /Users/admin/Desktop/demo/diplomsite
php artisan serve --host=0.0.0.0 --port=8000
# Откройте http://localhost:8000
```

**Остановка**: `Ctrl + C` в терминале с сервером 