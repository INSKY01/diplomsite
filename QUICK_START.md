# ⚡ Быстрый запуск сервера

## 🚀 Запуск (3 шага)

### 1. Запустите AMPPS
- Найдите иконку AMPPS в трее
- Убедитесь, что Apache и MySQL работают (зеленые)

### 2. Запустите сервер
```bash
cd /Users/admin/Desktop/demo/diplomsite
php artisan serve --host=0.0.0.0 --port=8000
```

### 3. Откройте сайт
- Браузер → http://localhost:8000

---

## 🛑 Остановка
```bash
Ctrl + C
```

---

## 🔧 Если не работает

### Проверьте AMPPS
```bash
ps aux | grep -i ampps
```

### Проверьте базу данных
```bash
/Applications/AMPPS/apps/mysql/bin/mysql -u root -pmysql -e "USE diplomsite; SELECT 1;"
```

### Очистите кэш
```bash
php artisan cache:clear
php artisan config:clear
```

### Другой порт
```bash
php artisan serve --port=8001
```

---

## 📱 Доступные страницы
- Главная: http://localhost:8000
- Калькулятор: http://localhost:8000/calc
- Админка: http://localhost:8000/admin 