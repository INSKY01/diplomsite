<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Админ-панель - Управление сайтом</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #4CAF50;
            --secondary-color: #2E7D32;
            --danger-color: #f44336;
            --warning-color: #ff9800;
            --info-color: #2196F3;
            --success-color: #4CAF50;
            --dark-color: #212529;
            --light-color: #f8f9fa;
        }

        body {
            margin: 0;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', sans-serif;
            background-color: #f5f5f5;
        }

        /* Экран входа */
        .login-screen {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        }

        .login-card {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
        }

        .login-card h1 {
            text-align: center;
            margin-bottom: 2rem;
            color: var(--dark-color);
        }

        /* Главный интерфейс */
        .admin-interface {
            display: none;
            min-height: 100vh;
        }

        .sidebar {
            width: 280px;
            background: white;
            border-right: 1px solid #e0e0e0;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            overflow-y: auto;
            z-index: 1000;
        }

        .sidebar-header {
            padding: 1.5rem;
            border-bottom: 1px solid #e0e0e0;
            background: var(--primary-color);
            color: white;
        }

        .sidebar-header h3 {
            margin: 0;
            font-size: 1.2rem;
        }

        .nav-menu {
            padding: 1rem 0;
        }

        .nav-item {
            display: block;
            padding: 0.75rem 1.5rem;
            color: #666;
            text-decoration: none;
            border-bottom: 1px solid #f0f0f0;
            transition: all 0.3s;
        }

        .nav-item:hover {
            background: #f8f9fa;
            color: var(--primary-color);
        }

        .nav-item.active {
            background: var(--primary-color);
            color: white;
        }

        .nav-item i {
            margin-right: 0.5rem;
            width: 20px;
        }

        .main-content {
            margin-left: 280px;
            padding: 2rem;
            min-height: 100vh;
        }

        .header {
            background: white;
            padding: 1rem 2rem;
            margin: -2rem -2rem 2rem -2rem;
            border-bottom: 1px solid #e0e0e0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header h1 {
            margin: 0;
            color: var(--dark-color);
        }

        .logout-btn {
            background: var(--danger-color);
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            cursor: pointer;
        }

        /* Таблицы */
        .data-table {
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .table-header {
            background: var(--light-color);
            padding: 1rem;
            border-bottom: 1px solid #e0e0e0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .table-header h3 {
            margin: 0;
            color: var(--dark-color);
        }

        .btn-add {
            background: var(--success-color);
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            cursor: pointer;
        }

        .btn-add:hover {
            background: var(--secondary-color);
        }

        .table {
            margin: 0;
        }

        .table th {
            background: var(--light-color);
            border: none;
            font-weight: 600;
            color: var(--dark-color);
        }

        .table td {
            border: none;
            border-bottom: 1px solid #f0f0f0;
            vertical-align: middle;
        }

        .btn-edit {
            background: var(--info-color);
            color: white;
            border: none;
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
            margin-right: 0.25rem;
            cursor: pointer;
        }

        .btn-delete {
            background: var(--danger-color);
            color: white;
            border: none;
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
            cursor: pointer;
        }

        /* Модальные окна */
        .modal-header {
            background: var(--primary-color);
            color: white;
        }

        .modal-header .btn-close {
            filter: invert(1);
        }

        /* Модальное окно подтверждения */
        .modal-header.bg-danger {
            background: var(--danger-color) !important;
        }

        .btn-close-white {
            filter: invert(1) grayscale(100%) brightness(200%);
        }

        #confirmModal .modal-body {
            padding: 2rem;
        }

        #confirmModal .text-danger {
            color: var(--danger-color) !important;
        }

        /* Анимация для иконки в модальном окне */
        #confirmModal .fa-trash-alt {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }

        /* Уведомления */
        .toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
        }

        .toast {
            min-width: 300px;
        }

        /* Адаптивность */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s;
            }
            
            .sidebar.mobile-open {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .mobile-toggle {
                display: block;
            }
        }

        .mobile-toggle {
            display: none;
            background: var(--primary-color);
            color: white;
            border: none;
            padding: 0.5rem;
            border-radius: 4px;
        }

        .image-preview {
            max-width: 100px;
            max-height: 100px;
            object-fit: cover;
            border-radius: 4px;
        }

        .loading {
            text-align: center;
            padding: 2rem;
            color: #666;
        }
    </style>
</head>
<body>
    <!-- Экран входа -->
    <div id="loginScreen" class="login-screen">
        <div class="login-card">
            <h1><i class="fas fa-lock"></i> Вход в админ-панель</h1>
            <form id="loginForm">
                <div class="mb-3">
                    <label for="password" class="form-label">Пароль</label>
                    <input type="password" class="form-control" id="password" required>
                </div>
                <button type="submit" class="btn btn-success w-100">
                    <i class="fas fa-sign-in-alt"></i> Войти
                </button>
            </form>
            <div id="loginError" class="alert alert-danger mt-3" style="display: none;"></div>
        </div>
    </div>

    <!-- Главный интерфейс -->
    <div id="adminInterface" class="admin-interface">
        <!-- Боковая панель -->
        <nav class="sidebar">
            <div class="sidebar-header">
                <h3><i class="fas fa-cogs"></i> Админ-панель</h3>
            </div>
            <div class="nav-menu">
                <a href="#" class="nav-item active" data-section="dashboard">
                    <i class="fas fa-tachometer-alt"></i> Панель управления
                </a>
                <a href="#" class="nav-item" data-section="requests">
                    <i class="fas fa-clipboard-list"></i> Заявки калькулятора
                </a>
                <a href="#" class="nav-item" data-section="feedback">
                    <i class="fas fa-comments"></i> Обратная связь
                </a>
                <a href="#" class="nav-item" data-section="house_types">
                    <i class="fas fa-home"></i> Типы домов
                </a>
                <a href="#" class="nav-item" data-section="floors">
                    <i class="fas fa-layer-group"></i> Этажность
                </a>
                <a href="#" class="nav-item" data-section="roofs">
                    <i class="fas fa-mountain"></i> Кровли
                </a>
                <a href="#" class="nav-item" data-section="materials">
                    <i class="fas fa-cube"></i> Материалы
                </a>
                <a href="#" class="nav-item" data-section="foundations">
                    <i class="fas fa-building"></i> Фундаменты
                </a>
                <a href="#" class="nav-item" data-section="facades">
                    <i class="fas fa-paint-brush"></i> Фасады
                </a>
                <a href="#" class="nav-item" data-section="electricals">
                    <i class="fas fa-bolt"></i> Электрика
                </a>
                <a href="#" class="nav-item" data-section="wall_finishes">
                    <i class="fas fa-brush"></i> Отделка стен
                </a>
                <a href="#" class="nav-item" data-section="additions">
                    <i class="fas fa-plus-circle"></i> Дополнения
                </a>
            </div>
        </nav>

        <!-- Основной контент -->
        <main class="main-content">
            <div class="header">
                <button class="mobile-toggle" onclick="toggleSidebar()">
                    <i class="fas fa-bars"></i>
                </button>
                <h1 id="pageTitle">Панель управления</h1>
                <button class="logout-btn" onclick="logout()">
                    <i class="fas fa-sign-out-alt"></i> Выйти
                </button>
            </div>

            <div id="contentArea">
                <div class="loading">
                    <i class="fas fa-spinner fa-spin fa-2x"></i>
                    <p>Загрузка данных...</p>
                </div>
            </div>
        </main>
    </div>

    <!-- Модальное окно для редактирования -->
    <div class="modal fade" id="editModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Редактирование</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm">
                        <div id="formFields"></div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                    <button type="button" class="btn btn-success" onclick="saveItem()">Сохранить</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Модальное окно подтверждения -->
    <div class="modal fade" id="confirmModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-exclamation-triangle"></i> Подтверждение действия
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex align-items-center">
                        <div class="text-danger me-3">
                            <i class="fas fa-trash-alt fa-2x"></i>
                        </div>
                        <div>
                            <p class="mb-1" id="confirmMessage">Вы уверены, что хотите удалить этот элемент?</p>
                            <small class="text-muted">Это действие нельзя будет отменить.</small>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times"></i> Отмена
                    </button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">
                        <i class="fas fa-trash"></i> Удалить
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Контейнер для уведомлений -->
    <div class="toast-container"></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/admin.js') }}"></script>
</body>
</html>