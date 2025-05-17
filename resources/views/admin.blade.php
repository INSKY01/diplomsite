<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Админ-панель</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            background-color: #f0f2f5;
            color: #333;
        }
        
        .admin-layout {
            display: flex;
            min-height: 100vh;
            display: none;
        }
        
        .sidebar {
            width: 250px;
            background-color: #ffffff;
            padding: 20px;
            display: flex;
            flex-direction: column;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        }
        
        .logo-container {
            margin-bottom: 30px;
            text-align: center;
            padding: 20px 0;
        }
        
        .logo-container img {
            max-width: 200px;
            height: auto;
        }
        
        .nav-buttons {
            flex-grow: 1;
        }
        
        .nav-button {
            width: 100%;
            padding: 15px 20px;
            margin-bottom: 15px;
            background: #f8f9fa;
            border: none;
            color: #333;
            text-align: left;
            border-radius: 8px;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            font-size: 16px;
            font-weight: 500;
        }
        
        .nav-button i {
            margin-right: 15px;
            width: 20px;
            font-size: 18px;
        }
        
        .nav-button:hover {
            background: #e9ecef;
            transform: translateX(5px);
        }
        
        .nav-button.active {
            background: #4CAF50;
            color: white;
        }
        
        .main-content {
            flex-grow: 1;
            padding: 30px;
            background-color: #f0f2f5;
        }
        
        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid #e0e0e0;
        }
        
        .section-header h2 {
            margin: 0;
            font-weight: 600;
            color: #2c3e50;
        }
        
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 25px;
        }
        
        .card {
            background: #ffffff;
            border: none;
            border-radius: 12px;
            margin-bottom: 20px;
            height: 100%;
            display: flex;
            flex-direction: column;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s, box-shadow 0.3s;
            overflow: hidden;
            position: relative;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
        }
        
        .card-image {
            width: 100%;
            height: 220px;
            object-fit: cover;
            object-position: center;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            transition: opacity 0.3s;
        }
        
        .card:hover .card-image {
            opacity: 0.95;
        }
        
        .no-image {
            width: 100%;
            height: 220px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f0f0f0;
            color: #a0a0a0;
            font-style: italic;
            font-size: 16px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }
        
        .card-content {
            padding: 20px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }
        
        .card-content h3 {
            margin-top: 0;
            margin-bottom: 12px;
            color: #2c3e50;
            font-size: 20px;
            font-weight: 600;
            line-height: 1.3;
            padding-bottom: 8px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }
        
        .price-tag {
            background-color: #4CAF50;
            color: white;
            padding: 6px 12px;
            border-radius: 6px;
            display: inline-block;
            margin-bottom: 15px;
            font-weight: 600;
            font-size: 16px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        
        .description {
            color: #7f8c8d;
            margin-bottom: 15px;
            line-height: 1.5;
            font-size: 15px;
            flex-grow: 1;
            overflow-wrap: break-word;
        }
        
        .property-value {
            margin-bottom: 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 15px;
            color: #555;
        }
        
        .property-value span {
            font-weight: 600;
            color: #2c3e50;
        }
        
        .card-content .details {
            margin-top: 15px;
            padding: 15px;
            border-radius: 8px;
            background-color: #f9f9f9;
            margin-bottom: 15px;
        }
        
        .card-content .details p {
            margin-bottom: 8px;
            font-size: 14px;
            display: flex;
            justify-content: space-between;
            color: #555;
        }
        
        .card-content .details p span:first-child {
            font-weight: 500;
            color: #2c3e50;
        }
        
        .card-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: auto;
            padding-top: 15px;
            border-top: 1px solid rgba(0, 0, 0, 0.05);
        }
        
        .btn-edit, .btn-delete {
            border: none;
            padding: 8px 15px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
        }
        
        .btn-edit {
            background-color: #3498db;
            color: white;
        }
        
        .btn-edit:hover {
            background-color: #2980b9;
        }
        
        .btn-delete {
            background-color: #e74c3c;
            color: white;
        }
        
        .btn-delete:hover {
            background-color: #c0392b;
        }
        
        .add-card {
            border: 2px dashed #ccc;
            background: rgba(255, 255, 255, 0.7);
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            transition: all 0.3s;
            min-height: 300px;
        }
        
        .add-card:hover {
            border-color: #4CAF50;
            background: rgba(255, 255, 255, 0.9);
        }
        
        .add-content {
            text-align: center;
            padding: 30px;
            color: #666;
            transition: all 0.3s;
        }
        
        .add-content i {
            font-size: 48px;
            margin-bottom: 15px;
            color: #4CAF50;
        }
        
        .add-content p {
            font-size: 18px;
            font-weight: 500;
            margin: 0;
            color: #555;
        }
        
        .add-card:hover .add-content {
            transform: scale(1.05);
        }
        
        .no-data {
            text-align: center;
            padding: 50px 20px;
            color: #a0a0a0;
            font-style: italic;
            font-size: 18px;
            background: #f9f9f9;
            border-radius: 10px;
            margin-bottom: 25px;
        }
        
        .loading {
            text-align: center;
            padding: 50px 20px;
            color: #666;
            font-size: 18px;
            background: #f9f9f9;
            border-radius: 10px;
            margin-bottom: 25px;
            animation: pulse 1.5s infinite;
        }
        
        @keyframes pulse {
            0% { opacity: 0.6; }
            50% { opacity: 1; }
            100% { opacity: 0.6; }
        }
        
        .modal-content {
            background-color: #ffffff;
            color: #333;
            border-radius: 10px;
        }
        
        .modal-header {
            border-bottom-color: #e9ecef;
        }
        
        .modal-footer {
            border-top-color: #e9ecef;
        }
        
        .form-control {
            background-color: #f8f9fa;
            border-color: #e9ecef;
            color: #333;
        }
        
        .form-control:focus {
            background-color: #ffffff;
            border-color: #4CAF50;
            color: #333;
            box-shadow: 0 0 0 0.25rem rgba(76, 175, 80, 0.25);
        }
        
        .btn-close {
            filter: none;
        }
        
        .tab-content {
            display: none;
        }
        
        .tab-content.active {
            display: block;
        }
        
        /* Стили для страницы логина */
        .admin-login-page {
            display: flex;
            min-height: 100vh;
            justify-content: center;
            align-items: center;
            background-color: #f0f2f5;
        }
        
        .admin-login-container {
            width: 400px;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        .admin-login-container h1 {
            color: #2c3e50;
            text-align: center;
            margin-bottom: 30px;
            font-size: 24px;
        }
        
        .admin-form-group {
            margin-bottom: 20px;
        }
        
        .admin-form-group label {
            display: block;
            margin-bottom: 8px;
            color: #34495e;
            font-weight: 500;
        }
        
        .admin-form-group input {
            width: 100%;
            padding: 12px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }
        
        .admin-form-group input:focus {
            border-color: #4CAF50;
            outline: none;
        }
        
        .admin-login-btn {
            width: 100%;
            padding: 12px;
            background: #4CAF50;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        
        .admin-login-btn:hover {
            background: #45a049;
        }
        
        .admin-error-message {
            display: none;
            color: #e74c3c;
            font-size: 14px;
            margin-top: 8px;
            padding: 8px;
            background: #fde8e7;
            border-radius: 4px;
        }
        
        .admin-success-message {
            display: none;
            color: #27ae60;
            font-size: 14px;
            margin-top: 8px;
            padding: 8px;
            background: #e8f5e9;
            border-radius: 4px;
        }
        
        /* Стили для уведомлений */
        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 15px 25px;
            border-radius: 8px;
            color: white;
            font-weight: 500;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            z-index: 9999;
            opacity: 1;
            transform: translateY(0);
            transition: all 0.3s ease;
            max-width: 400px;
            word-break: break-word;
        }
        
        .notification.hidden {
            opacity: 0;
            transform: translateY(-20px);
            pointer-events: none;
        }
        
        .notification.success {
            background-color: #4CAF50;
        }
        
        .notification.info {
            background-color: #3498db;
        }
        
        .notification.warning {
            background-color: #f39c12;
        }
        
        .notification.error {
            background-color: #e74c3c;
        }
    </style>
</head>
<body>
    <!-- Страница входа -->
    <div id="loginPage" class="admin-login-page">
        <div id="loginContainer" class="admin-login-container">
            <h1>Вход в админ-панель</h1>
            <form onsubmit="handleLogin(event)">
                <div class="admin-form-group">
                    <label for="password">Пароль</label>
                    <input type="password" id="password" placeholder="Введите пароль" required>
                </div>
                <div id="errorMessage" class="admin-error-message">
                    Неверный пароль. Пожалуйста, попробуйте снова.
                </div>
                <div id="successMessage" class="admin-success-message">
                    Успешный вход. Перенаправление...
                </div>
                <button type="submit" class="admin-login-btn">Войти</button>
            </form>
        </div>
    </div>

    <div class="admin-layout">
        <div class="sidebar">
            <div class="logo-container">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('icons/logo.svg') }}" alt="Логотип" width="200">
                </a>
            </div>
            <div class="nav-buttons">
                <button class="nav-button" onclick="showTab('houseTypes')">
                    <i class="fas fa-home"></i> Типы домов
                </button>
                <button class="nav-button active" onclick="showTab('floors')">
                    <i class="fas fa-layer-group"></i> Этажи
                </button>
                <button class="nav-button" onclick="showTab('roofs')">
                    <i class="fas fa-home"></i> Крыши
                </button>
                <button class="nav-button" onclick="showTab('materials')">
                    <i class="fas fa-cubes"></i> Материалы
                </button>
                <button class="nav-button" onclick="showTab('foundations')">
                    <i class="fas fa-square"></i> Фундаменты
                </button>
                <button class="nav-button" onclick="showTab('facades')">
                    <i class="fas fa-building"></i> Фасады
                </button>
                <button class="nav-button" onclick="showTab('electrical')">
                    <i class="fas fa-bolt"></i> Электрика
                </button>
                <button class="nav-button" onclick="showTab('wallFinishes')">
                    <i class="fas fa-paint-roller"></i> Отделка стен
                </button>
                <button class="nav-button" onclick="showTab('additions')">
                    <i class="fas fa-plus-circle"></i> Дополнения
                </button>
                <button class="nav-button" onclick="logout()" style="margin-top: auto;">
                    <i class="fas fa-sign-out-alt"></i> Выйти
                </button>
            </div>
        </div>

        <div class="main-content">
            <div id="houseTypesTab" class="tab-content">
                <div class="section-header">
                    <h2>Типы домов</h2>
                    <button class="btn btn-primary" onclick="showAddHouseTypeForm()">
                        <i class="fas fa-plus"></i> Добавить тип дома
                    </button>
                </div>
                <div class="grid" id="houseTypesContainer"></div>
            </div>

            <div id="floorsTab" class="tab-content active">
                <div class="section-header">
                    <h2>Этажи</h2>
                    <button class="btn btn-primary" onclick="showAddFloorForm()">
                        <i class="fas fa-plus"></i> Добавить этаж
                    </button>
                </div>
                <div class="grid" id="floorsContainer"></div>
            </div>

            <div id="roofsTab" class="tab-content">
                <div class="section-header">
                    <h2>Крыши</h2>
                    <button class="btn btn-primary" onclick="showAddRoofForm()">
                        <i class="fas fa-plus"></i> Добавить крышу
                    </button>
                </div>
                <div class="grid" id="roofsContainer"></div>
            </div>

            <div id="materialsTab" class="tab-content">
                <div class="section-header">
                    <h2>Материалы</h2>
                    <button class="btn btn-primary" onclick="showAddMaterialForm()">
                        <i class="fas fa-plus"></i> Добавить материал
                    </button>
                </div>
                <div class="grid" id="materialsContainer"></div>
            </div>

            <div id="foundationsTab" class="tab-content">
                <div class="section-header">
                    <h2>Фундаменты</h2>
                    <button class="btn btn-primary" onclick="showAddFoundationForm()">
                        <i class="fas fa-plus"></i> Добавить фундамент
                    </button>
                </div>
                <div class="grid" id="foundationsContainer"></div>
            </div>

            <div id="facadesTab" class="tab-content">
                <div class="section-header">
                    <h2>Фасады</h2>
                    <button class="btn btn-primary" onclick="showAddFacadeForm()">
                        <i class="fas fa-plus"></i> Добавить фасад
                    </button>
                </div>
                <div class="grid" id="facadesContainer"></div>
            </div>

            <div id="electricalTab" class="tab-content">
                <div class="section-header">
                    <h2>Электрика</h2>
                    <button class="btn btn-primary" onclick="showAddElectricalForm()">
                        <i class="fas fa-plus"></i> Добавить электрику
                    </button>
                </div>
                <div class="grid" id="electricalContainer"></div>
            </div>

            <div id="wallFinishesTab" class="tab-content">
                <div class="section-header">
                    <h2>Отделка стен</h2>
                    <button class="btn btn-primary" onclick="showAddWallFinishForm()">
                        <i class="fas fa-plus"></i> Добавить отделку
                    </button>
                </div>
                <div class="grid" id="wallFinishesContainer"></div>
            </div>

            <div id="additionsTab" class="tab-content">
                <div class="section-header">
                    <h2>Дополнения</h2>
                    <button class="btn btn-primary" onclick="showAddAdditionForm()">
                        <i class="fas fa-plus"></i> Добавить дополнение
                    </button>
                </div>
                <div class="grid" id="additionsContainer"></div>
            </div>

            <div id="requestsTab" class="tab-content">
                <div class="section-header">
                    <h2>Заявки</h2>
                </div>
                <div id="requestsContainer"></div>
            </div>
        </div>
    </div>

    <!-- Модальное окно для добавления/редактирования элементов -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="modalTitle" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Добавить</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="itemId">
                    <input type="hidden" id="itemType">
                    <div class="form-group">
                        <label for="name" class="form-label">Название</label>
                        <input type="text" id="name" class="form-input">
                    </div>
                    <div class="form-group">
                        <label for="price" class="form-label">Цена</label>
                        <input type="number" id="price" class="form-input">
                    </div>
                    <div class="form-group">
                        <label for="multiplier" class="form-label">Множитель</label>
                        <input type="number" id="multiplier" class="form-input" step="0.1">
                    </div>
                    <div class="form-group">
                        <label for="description" class="form-label">Описание</label>
                        <textarea id="description" class="form-textarea"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="image" class="form-label">URL изображения</label>
                        <input type="text" id="image" class="form-input">
                    </div>
                    <!-- Контейнер для дополнительных полей -->
                    <div id="additionalFields"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                    <button type="button" class="btn btn-primary" onclick="saveItem()">Сохранить</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Модальное окно -->
    <div class="modal fade" id="adminModal" tabindex="-1" aria-labelledby="modalTitle">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Заголовок модального окна</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                </div>
                <div class="modal-body" id="modalBody">
                    Содержимое модального окна
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Инициализация Bootstrap модального окна
        const modalElement = document.getElementById('editModal');
        const modal = new bootstrap.Modal(modalElement);

        // Инициализация модального окна Bootstrap
        var adminModal = new bootstrap.Modal(document.getElementById('adminModal'));
    </script>
    <script src="{{ asset('js/admin.js') }}"></script>
</body>
</html>