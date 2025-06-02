// Глобальные переменные
let currentSection = 'dashboard';
let currentData = {};
let editModal;
let confirmModal;
let pendingDeleteAction = null;

// Конфигурация таблиц
const tableConfig = {
    house_types: {
        title: 'Типы домов',
        fields: ['name', 'description', 'price', 'image'],
        labels: {
            name: 'Название',
            description: 'Описание', 
            price: 'Цена',
            image: 'Изображение'
        }
    },
    floors: {
        title: 'Этажность',
        fields: ['name', 'multiplier', 'description', 'image'],
        labels: {
            name: 'Название',
            multiplier: 'Множитель',
            description: 'Описание',
            image: 'Изображение'
        }
    },
    roofs: {
        title: 'Кровли',
        fields: ['name', 'description', 'price', 'image'],
        labels: {
            name: 'Название',
            description: 'Описание',
            price: 'Цена',
            image: 'Изображение'
        }
    },
    materials: {
        title: 'Материалы',
        fields: ['name', 'description', 'price', 'image'],
        labels: {
            name: 'Название',
            description: 'Описание',
            price: 'Цена',
            image: 'Изображение'
        }
    },
    foundations: {
        title: 'Фундаменты',
        fields: ['name', 'description', 'price', 'image'],
        labels: {
            name: 'Название',
            description: 'Описание',
            price: 'Цена',
            image: 'Изображение'
        }
    },
    facades: {
        title: 'Фасады',
        fields: ['name', 'description', 'price', 'image'],
        labels: {
            name: 'Название',
            description: 'Описание',
            price: 'Цена',
            image: 'Изображение'
        }
    },
    electricals: {
        title: 'Электрика',
        fields: ['name', 'description', 'price', 'image'],
        labels: {
            name: 'Название',
            description: 'Описание',
            price: 'Цена',
            image: 'Изображение'
        }
    },
    wall_finishes: {
        title: 'Отделка стен',
        fields: ['name', 'description', 'price', 'image'],
        labels: {
            name: 'Название',
            description: 'Описание',
            price: 'Цена',
            image: 'Изображение'
        }
    },
    additions: {
        title: 'Дополнения',
        fields: ['name', 'description', 'price', 'category', 'image'],
        labels: {
            name: 'Название',
            description: 'Описание',
            price: 'Цена',
            category: 'Категория',
            image: 'Изображение'
        }
    }
};

// Инициализация при загрузке страницы
document.addEventListener('DOMContentLoaded', function() {
    // Настройка CSRF токена
    const token = document.querySelector('meta[name="csrf-token"]');
    if (!token) {
        console.error('CSRF токен не найден');
        return;
    }
    
    const csrfToken = token.getAttribute('content');
    
    // Настройка заголовков для AJAX запросов
    const originalFetch = window.fetch;
    window.fetch = function(url, options = {}) {
        options.headers = options.headers || {};
        options.headers['X-CSRF-TOKEN'] = csrfToken;
        
        // Устанавливаем заголовки только если не передается FormData
        if (!(options.body instanceof FormData)) {
            options.headers['Content-Type'] = 'application/json';
        }
        options.headers['Accept'] = 'application/json';
        
        return originalFetch(url, options);
    };

    // Инициализация модальных окон
    editModal = new bootstrap.Modal(document.getElementById('editModal'));
    confirmModal = new bootstrap.Modal(document.getElementById('confirmModal'));
    
    // Настройка кнопки подтверждения удаления
    document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
        if (pendingDeleteAction) {
            pendingDeleteAction();
            pendingDeleteAction = null;
        }
        confirmModal.hide();
    });
    
    // Проверка аутентификации
    checkAuth();
    
    // Настройка навигации
    setupNavigation();
    
    // Настройка формы входа
    setupLoginForm();
});

// Проверка аутентификации
async function checkAuth() {
    try {
        const response = await fetch('/admin/check-auth');
        const data = await response.json();
        
        if (data.authenticated) {
            showAdminInterface();
            loadData();
        } else {
            showLoginScreen();
        }
    } catch (error) {
        console.error('Ошибка проверки аутентификации:', error);
        showLoginScreen();
    }
}

// Показать экран входа
function showLoginScreen() {
    document.getElementById('loginScreen').style.display = 'flex';
    document.getElementById('adminInterface').style.display = 'none';
}

// Показать админ интерфейс
function showAdminInterface() {
    document.getElementById('loginScreen').style.display = 'none';
    document.getElementById('adminInterface').style.display = 'block';
}

// Настройка формы входа
function setupLoginForm() {
    document.getElementById('loginForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const password = document.getElementById('password').value;
        const errorDiv = document.getElementById('loginError');
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        try {
            const response = await fetch('/admin/login', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ password })
            });
            
            const data = await response.json();
            
            if (data.success) {
                showAdminInterface();
                loadData();
                document.getElementById('password').value = '';
                errorDiv.style.display = 'none';
            } else {
                errorDiv.textContent = data.message || 'Неверный пароль';
                errorDiv.style.display = 'block';
            }
        } catch (error) {
            errorDiv.textContent = 'Произошла ошибка при входе';
            errorDiv.style.display = 'block';
            console.error('Ошибка входа:', error);
        }
    });
}

// Настройка навигации
function setupNavigation() {
    const navItems = document.querySelectorAll('.nav-item');
    
    navItems.forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Убираем активный класс у всех элементов
            navItems.forEach(nav => nav.classList.remove('active'));
            
            // Добавляем активный класс к выбранному элементу
            this.classList.add('active');
            
            // Получаем секцию из data-section
            const section = this.getAttribute('data-section');
            
            // Переключаем контент
            switchSection(section);
        });
    });
}

// Переключение секций
function switchSection(section) {
    currentSection = section;
    
    // Обновляем заголовок
    const pageTitle = document.getElementById('pageTitle');
    
    if (section === 'dashboard') {
        pageTitle.textContent = 'Панель управления';
        showDashboard();
    } else {
        const config = tableConfig[section];
        if (config) {
            pageTitle.textContent = config.title;
            showTableSection(section);
        }
    }
}

// Показать панель управления
function showDashboard() {
    const contentArea = document.getElementById('contentArea');
    
    contentArea.innerHTML = `
        <div class="row">
            <div class="col-md-12">
                <h2>Добро пожаловать в админ-панель!</h2>
                <p>Выберите раздел в боковом меню для управления данными.</p>
        </div>
        </div>
        <div class="row mt-4">
            ${Object.entries(tableConfig).map(([key, config]) => `
                <div class="col-md-4 mb-3">
            <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">${config.title}</h5>
                            <p class="card-text">Управление данными: ${config.title.toLowerCase()}</p>
                            <button class="btn btn-primary" onclick="switchSection('${key}')">
                                Перейти
                        </button>
                    </div>
                </div>
            </div>
            `).join('')}
        </div>
    `;
}

// Показать секцию с таблицей
function showTableSection(section) {
    const contentArea = document.getElementById('contentArea');
    const config = tableConfig[section];
    
    contentArea.innerHTML = `
        <div class="data-table">
            <div class="table-header">
                <h3>${config.title}</h3>
                <button class="btn-add" onclick="addItem('${section}')">
                    <i class="fas fa-plus"></i> Добавить
                    </button>
                </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            ${config.fields.map(field => `<th>${config.labels[field]}</th>`).join('')}
                            <th>Действия</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        <tr>
                            <td colspan="${config.fields.length + 2}" class="text-center">
                                <i class="fas fa-spinner fa-spin"></i> Загрузка...
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            </div>
        `;
    
    // Загружаем данные для таблицы
    loadTableData(section);
}

// Загрузка всех данных
async function loadData() {
    try {
        const response = await fetch('/admin/api/data');
        const data = await response.json();
        
        if (response.ok) {
            currentData = data;
            
            // Если мы на странице с таблицей, обновляем её
            if (currentSection !== 'dashboard') {
                loadTableData(currentSection);
            }
        } else {
            showToast('Ошибка загрузки данных: ' + (data.error || 'Неизвестная ошибка'), 'error');
        }
    } catch (error) {
        console.error('Ошибка загрузки данных:', error);
        showToast('Ошибка загрузки данных', 'error');
    }
}

// Загрузка данных для конкретной таблицы
async function loadTableData(section) {
    try {
        const response = await fetch(`/admin/api/data/${section}`);
        const data = await response.json();
        
        if (response.ok) {
            currentData[section] = data;
            renderTable(section, data);
        } else {
            showToast('Ошибка загрузки данных: ' + (data.error || 'Неизвестная ошибка'), 'error');
        }
    } catch (error) {
        console.error('Ошибка загрузки данных таблицы:', error);
        showToast('Ошибка загрузки данных', 'error');
    }
}

// Отрисовка таблицы
function renderTable(section, data) {
    const tableBody = document.getElementById('tableBody');
    const config = tableConfig[section];
    
    if (!data || data.length === 0) {
        tableBody.innerHTML = `
            <tr>
                <td colspan="${config.fields.length + 2}" class="text-center text-muted">
                    Нет данных для отображения
                </td>
            </tr>
        `;
                return;
            }

    tableBody.innerHTML = data.map(item => `
        <tr>
            <td>${item.id}</td>
            ${config.fields.map(field => {
                let value = item[field] || '';
                
                // Специальная обработка для изображений
                if (field === 'image' && value) {
                    return `<td><img src="${value}" class="image-preview" alt="Изображение" onerror="this.style.display='none'"></td>`;
                }
                
                // Обрезаем длинный текст
                if (typeof value === 'string' && value.length > 50) {
                    value = value.substring(0, 50) + '...';
                }
                
                return `<td>${value}</td>`;
            }).join('')}
            <td>
                <button class="btn-edit" onclick="editItem('${section}', ${item.id})">
                    <i class="fas fa-edit"></i>
                        </button>
                <button class="btn-delete" onclick="deleteItem('${section}', ${item.id})">
                    <i class="fas fa-trash"></i>
                        </button>
            </td>
        </tr>
    `).join('');
}

// Добавить новый элемент
function addItem(section) {
    const config = tableConfig[section];
    
    document.getElementById('modalTitle').textContent = `Добавить ${config.title.toLowerCase()}`;
    
    // Создаем форму
    const formFields = document.getElementById('formFields');
    formFields.innerHTML = config.fields.map(field => {
        const label = config.labels[field];
        
        if (field === 'description') {
            return `
                <div class="mb-3">
                    <label for="${field}" class="form-label">${label}</label>
                    <textarea class="form-control" id="${field}" name="${field}" rows="3"></textarea>
        </div>
    `;
        } else if (field === 'category') {
            return `
                <div class="mb-3">
                    <label for="${field}" class="form-label">${label}</label>
                    <select class="form-control" id="${field}" name="${field}">
                        <option value="">Выберите категорию</option>
                        <option value="design">Дизайн</option>
                        <option value="comfort">Комфорт</option>
                        <option value="utility">Хозяйственные</option>
                        <option value="safety">Безопасность</option>
                    </select>
            </div>
        `;
        } else if (field === 'price' || field === 'value' || field === 'sockets' || field === 'switches' || field === 'lights') {
            return `
                <div class="mb-3">
                    <label for="${field}" class="form-label">${label}</label>
                    <input type="number" class="form-control" id="${field}" name="${field}" ${field === 'multiplier' ? 'step="0.1"' : ''}>
        </div>
    `;
        } else if (field === 'multiplier') {
            return `
                <div class="mb-3">
                    <label for="${field}" class="form-label">${label}</label>
                    <input type="number" class="form-control" id="${field}" name="${field}" step="0.1">
        </div>
    `;
        } else {
            return `
                <div class="mb-3">
                    <label for="${field}" class="form-label">${label}</label>
                    <input type="text" class="form-control" id="${field}" name="${field}">
        </div>
    `;
        }
    }).join('');
    
    // Устанавливаем режим добавления
    document.getElementById('editForm').setAttribute('data-mode', 'add');
    document.getElementById('editForm').setAttribute('data-section', section);
    
    editModal.show();
}

// Редактировать элемент
function editItem(section, id) {
    const config = tableConfig[section];
    const data = currentData[section];
    const item = data.find(item => item.id == id);
    
    if (!item) {
        showToast('Элемент не найден', 'error');
                return;
            }
            
    document.getElementById('modalTitle').textContent = `Редактировать ${config.title.toLowerCase()}`;
    
    // Создаем форму с заполненными данными
    const formFields = document.getElementById('formFields');
    formFields.innerHTML = config.fields.map(field => {
        const label = config.labels[field];
        const value = item[field] || '';
        
        if (field === 'description') {
            return `
                <div class="mb-3">
                    <label for="${field}" class="form-label">${label}</label>
                    <textarea class="form-control" id="${field}" name="${field}" rows="3">${value}</textarea>
                    </div>
                `;
        } else if (field === 'category') {
            return `
                <div class="mb-3">
                    <label for="${field}" class="form-label">${label}</label>
                    <select class="form-control" id="${field}" name="${field}">
                        <option value="">Выберите категорию</option>
                        <option value="design" ${value === 'design' ? 'selected' : ''}>Дизайн</option>
                        <option value="comfort" ${value === 'comfort' ? 'selected' : ''}>Комфорт</option>
                        <option value="utility" ${value === 'utility' ? 'selected' : ''}>Хозяйственные</option>
                        <option value="safety" ${value === 'safety' ? 'selected' : ''}>Безопасность</option>
                    </select>
                </div>
            `;
        } else if (field === 'price' || field === 'value' || field === 'sockets' || field === 'switches' || field === 'lights') {
            return `
                <div class="mb-3">
                    <label for="${field}" class="form-label">${label}</label>
                    <input type="number" class="form-control" id="${field}" name="${field}" value="${value}" ${field === 'multiplier' ? 'step="0.1"' : ''}>
                    </div>
                `;
        } else if (field === 'multiplier') {
            return `
                <div class="mb-3">
                    <label for="${field}" class="form-label">${label}</label>
                    <input type="number" class="form-control" id="${field}" name="${field}" value="${value}" step="0.1">
                </div>
            `;
        } else {
            return `
                <div class="mb-3">
                    <label for="${field}" class="form-label">${label}</label>
                    <input type="text" class="form-control" id="${field}" name="${field}" value="${value}">
                    </div>
                `;
        }
    }).join('');
    
    // Устанавливаем режим редактирования
    document.getElementById('editForm').setAttribute('data-mode', 'edit');
    document.getElementById('editForm').setAttribute('data-section', section);
    document.getElementById('editForm').setAttribute('data-id', id);
    
    editModal.show();
}

// Сохранить элемент
async function saveItem() {
    const form = document.getElementById('editForm');
    const mode = form.getAttribute('data-mode');
    const section = form.getAttribute('data-section');
    const id = form.getAttribute('data-id');
    
    // Собираем данные формы
    const formData = new FormData(form);
    const data = {};
    
    for (let [key, value] of formData.entries()) {
        data[key] = value;
    }
    
    try {
        let response;
        
        if (mode === 'add') {
            response = await fetch(`/admin/api/data/${section}`, {
                method: 'POST',
                body: JSON.stringify(data)
            });
        } else {
            response = await fetch(`/admin/api/data/${section}/${id}`, {
                method: 'PUT',
                body: JSON.stringify(data)
            });
        }
        
        const result = await response.json();
        
        if (response.ok && result.success) {
            showToast(result.message || 'Данные успешно сохранены', 'success');
            editModal.hide();
            loadTableData(section);
                } else {
            showToast('Ошибка сохранения: ' + (result.error || 'Неизвестная ошибка'), 'error');
        }
    } catch (error) {
        console.error('Ошибка сохранения:', error);
        showToast('Ошибка сохранения данных', 'error');
    }
}

// Показать подтверждение с настраиваемым сообщением
function showConfirmation(message, onConfirm, title = 'Подтверждение действия', icon = 'fa-exclamation-triangle') {
    document.getElementById('confirmMessage').textContent = message;
    
    // Обновляем иконку и заголовок если нужно
    const modalTitle = document.querySelector('#confirmModal .modal-title');
    modalTitle.innerHTML = `<i class="fas ${icon}"></i> ${title}`;
    
    // Обновляем иконку в теле модального окна
    const bodyIcon = document.querySelector('#confirmModal .modal-body .fa-trash-alt');
    if (bodyIcon) {
        bodyIcon.className = `fas ${icon} fa-2x`;
    }
    
    pendingDeleteAction = onConfirm;
    confirmModal.show();
}

// Удалить элемент
async function deleteItem(section, id) {
    // Получаем название элемента для более информативного сообщения
    const config = tableConfig[section];
    const data = currentData[section];
    const item = data.find(item => item.id == id);
    const itemName = item ? item.name : 'элемент';
    
    const confirmAction = async function() {
        try {
            const response = await fetch(`/admin/api/data/${section}/${id}`, {
                method: 'DELETE'
            });
            
            const result = await response.json();
            
            if (response.ok && result.success) {
                showToast(result.message || 'Элемент успешно удален', 'success');
                loadTableData(section);
        } else {
                showToast('Ошибка удаления: ' + (result.error || 'Неизвестная ошибка'), 'error');
            }
        } catch (error) {
            console.error('Ошибка удаления:', error);
            showToast('Ошибка удаления элемента', 'error');
        }
    };
    
    showConfirmation(
        `Вы уверены, что хотите удалить "${itemName}"?`,
        confirmAction,
        'Удаление элемента',
        'fa-trash-alt'
    );
}

// Выход из системы
async function logout() {
    const logoutAction = async function() {
        try {
            const response = await fetch('/admin/logout', {
                method: 'POST'
            });
            
            const result = await response.json();
            
            if (result.success) {
                showLoginScreen();
                showToast('Вы успешно вышли из системы', 'info');
            }
        } catch (error) {
            console.error('Ошибка выхода:', error);
            showLoginScreen();
        }
    };
    
    showConfirmation(
        'Вы уверены, что хотите выйти из админ-панели?',
        logoutAction,
        'Выход из системы',
        'fa-sign-out-alt'
    );
}

// Показать уведомление
function showToast(message, type = 'info') {
    const toastContainer = document.querySelector('.toast-container');
    
    const toastId = 'toast-' + Date.now();
    const toastHtml = `
        <div id="${toastId}" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto">
                    <i class="fas ${getToastIcon(type)}"></i>
                    ${getToastTitle(type)}
                </strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                ${message}
            </div>
        </div>
    `;
    
    toastContainer.insertAdjacentHTML('beforeend', toastHtml);
    
    const toastElement = document.getElementById(toastId);
    const toast = new bootstrap.Toast(toastElement);
    
    toast.show();
    
    // Удаляем toast после скрытия
    toastElement.addEventListener('hidden.bs.toast', function() {
        toastElement.remove();
    });
}

// Получить иконку для уведомления
function getToastIcon(type) {
    const icons = {
        success: 'fa-check-circle',
        error: 'fa-exclamation-triangle',
        warning: 'fa-exclamation-circle',
        info: 'fa-info-circle'
    };
    
    return icons[type] || icons.info;
}

// Получить заголовок для уведомления
function getToastTitle(type) {
    const titles = {
        success: 'Успешно',
        error: 'Ошибка',
        warning: 'Предупреждение',
        info: 'Информация'
    };
    
    return titles[type] || titles.info;
}

// Переключение мобильной боковой панели
function toggleSidebar() {
    const sidebar = document.querySelector('.sidebar');
    sidebar.classList.toggle('mobile-open');
}
