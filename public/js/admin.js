// Глобальные переменные
let currentSection = 'dashboard';
let currentData = {};
let editModal;
let confirmModal;
let pendingDeleteAction = null;

// Конфигурация таблиц
const tableConfig = {
    requests: {
        title: 'Заявки калькулятора',
        fields: ['id', 'name', 'phone', 'email', 'area', 'total_price', 'status', 'created_at'],
        labels: {
            id: 'ID',
            name: 'Имя',
            phone: 'Телефон',
            email: 'Email',
            area: 'Площадь',
            total_price: 'Стоимость',
            status: 'Статус',
            created_at: 'Дата'
        },
        readOnly: true,
        statusField: 'status'
    },
    feedback: {
        title: 'Обратная связь',
        fields: ['id', 'firstname', 'tel', 'email', 'subject', 'created_at'],
        labels: {
            id: 'ID',
            firstname: 'Имя',
            tel: 'Телефон',
            email: 'Email',
            subject: 'Сообщение',
            created_at: 'Дата'
        },
        readOnly: true
    },
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
    currentSection = 'dashboard';
    document.getElementById('pageTitle').textContent = 'Панель управления';
    
    // Загружаем статистику
    fetch('/admin/api/requests/stats')
        .then(response => response.json())
        .then(data => {
            const contentArea = document.getElementById('contentArea');
            contentArea.innerHTML = `
                <div class="row">
                    <div class="col-md-3 mb-4">
                        <div class="card bg-primary text-white">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h4 class="card-title">${data.total_requests}</h4>
                                        <p class="card-text">Всего заявок</p>
                                    </div>
                                    <div class="align-self-center">
                                        <i class="fas fa-clipboard-list fa-2x"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="card bg-warning text-white">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h4 class="card-title">${data.new_requests}</h4>
                                        <p class="card-text">Новые заявки</p>
                                    </div>
                                    <div class="align-self-center">
                                        <i class="fas fa-bell fa-2x"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="card bg-info text-white">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h4 class="card-title">${data.in_progress_requests}</h4>
                                        <p class="card-text">В работе</p>
                                    </div>
                                    <div class="align-self-center">
                                        <i class="fas fa-cogs fa-2x"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="card bg-success text-white">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h4 class="card-title">${data.total_feedback}</h4>
                                        <p class="card-text">Обращений</p>
                                    </div>
                                    <div class="align-self-center">
                                        <i class="fas fa-comments fa-2x"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">
                                    <i class="fas fa-clock"></i> Последние заявки
                                </h5>
                            </div>
                            <div class="card-body">
                                ${data.recent_requests.length > 0 ? `
                                    <div class="table-responsive">
                                        <table class="table table-sm">
                                            <thead>
                                                <tr>
                                                    <th>Имя</th>
                                                    <th>Телефон</th>
                                                    <th>Стоимость</th>
                                                    <th>Статус</th>
                                                    <th>Дата</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                ${data.recent_requests.map(request => `
                                                    <tr>
                                                        <td>${request.name}</td>
                                                        <td>${request.phone}</td>
                                                        <td>${new Intl.NumberFormat('ru-RU').format(request.total_price)} ₽</td>
                                                        <td>
                                                            <span class="badge bg-${getStatusColor(request.status)}">
                                                                ${getStatusText(request.status)}
                                                            </span>
                                                        </td>
                                                        <td>${new Date(request.created_at).toLocaleDateString('ru-RU')}</td>
                                                    </tr>
                                                `).join('')}
                                            </tbody>
                                        </table>
                                    </div>
                                ` : '<p class="text-muted">Нет заявок</p>'}
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">
                                    <i class="fas fa-comment"></i> Последние обращения
                                </h5>
                            </div>
                            <div class="card-body">
                                ${data.recent_feedback.length > 0 ? `
                                    <div class="table-responsive">
                                        <table class="table table-sm">
                                            <thead>
                                                <tr>
                                                    <th>Имя</th>
                                                    <th>Email</th>
                                                    <th>Дата</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                ${data.recent_feedback.map(feedback => `
                                                    <tr>
                                                        <td>${feedback.firstname}</td>
                                                        <td>${feedback.email}</td>
                                                        <td>${new Date(feedback.created_at).toLocaleDateString('ru-RU')}</td>
                                                    </tr>
                                                `).join('')}
                                            </tbody>
                                        </table>
                                    </div>
                                ` : '<p class="text-muted">Нет обращений</p>'}
                            </div>
                        </div>
                    </div>
                </div>
            `;
        })
        .catch(error => {
            console.error('Ошибка загрузки статистики:', error);
            document.getElementById('contentArea').innerHTML = `
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-triangle"></i> Ошибка загрузки статистики
                </div>
            `;
        });
}

// Показать секцию с таблицей
function showTableSection(section) {
    const contentArea = document.getElementById('contentArea');
    const config = tableConfig[section];
    
    contentArea.innerHTML = `
        <div class="data-table">
            <div class="table-header">
                <h3>${config.title}</h3>
                ${!config.readOnly ? `<button class="btn-add" onclick="addItem('${section}')">
                    <i class="fas fa-plus"></i> Добавить
                </button>` : ''}
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            ${config.fields.map(field => `<th>${config.labels[field]}</th>`).join('')}
                            <th>Действия</th>
                        </tr>
                    </thead>
                    <tbody>
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
    const config = tableConfig[section];
    if (!config) return;

    const contentArea = document.getElementById('contentArea');
    
    let tableHtml = `
        <div class="data-table">
            <div class="table-header">
                <h3>${config.title}</h3>
                ${!config.readOnly ? `<button class="btn-add" onclick="addItem('${section}')">
                    <i class="fas fa-plus"></i> Добавить
                </button>` : ''}
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            ${config.fields.map(field => `<th>${config.labels[field]}</th>`).join('')}
                            <th>Действия</th>
                        </tr>
                    </thead>
                    <tbody>
    `;

    data.forEach(item => {
        tableHtml += '<tr>';
        
        config.fields.forEach(field => {
            let value = item[field];
            
            // Специальная обработка для разных типов полей
            if (field === 'created_at') {
                value = new Date(value).toLocaleDateString('ru-RU');
            } else if (field === 'total_price') {
                value = new Intl.NumberFormat('ru-RU').format(value) + ' ₽';
            } else if (field === 'area') {
                value = value + ' м²';
            } else if (field === 'status') {
                value = `<span class="badge bg-${getStatusColor(value)}">${getStatusText(value)}</span>`;
            } else if (field === 'subject' && value && value.length > 50) {
                value = value.substring(0, 50) + '...';
            }
            
            tableHtml += `<td>${value || '-'}</td>`;
        });
        
        // Кнопки действий
        tableHtml += '<td>';
        
        if (section === 'requests') {
            tableHtml += `
                <button class="btn-edit" onclick="showRequestDetails(${JSON.stringify(item).replace(/"/g, '&quot;')})">
                    <i class="fas fa-eye"></i>
                </button>
            `;
        } else if (section === 'feedback') {
            tableHtml += `
                <button class="btn-edit" onclick="showFeedbackDetails(${JSON.stringify(item).replace(/"/g, '&quot;')})">
                    <i class="fas fa-eye"></i>
                </button>
            `;
        } else {
            tableHtml += `
                <button class="btn-edit" onclick="editItem('${section}', ${item.id})">
                    <i class="fas fa-edit"></i>
                </button>
            `;
        }
        
        tableHtml += `
            <button class="btn-delete" onclick="deleteItem('${section}', ${item.id})">
                <i class="fas fa-trash"></i>
            </button>
        </td>`;
        
        tableHtml += '</tr>';
    });

    tableHtml += `
                    </tbody>
                </table>
            </div>
        </div>
    `;

    contentArea.innerHTML = tableHtml;
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

// Вспомогательные функции для работы со статусами
function getStatusText(status) {
    const statuses = {
        'new': 'Новая',
        'in_progress': 'В работе',
        'completed': 'Завершена',
        'cancelled': 'Отменена'
    };
    return statuses[status] || status;
}

function getStatusColor(status) {
    const colors = {
        'new': 'primary',
        'in_progress': 'warning',
        'completed': 'success',
        'cancelled': 'danger'
    };
    return colors[status] || 'secondary';
}

// Функция для обновления статуса заявки
async function updateRequestStatus(requestId, newStatus) {
    try {
        const response = await fetch(`/admin/api/requests/${requestId}/status`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ status: newStatus })
        });

        const data = await response.json();
        
        if (data.success) {
            showToast('Статус заявки успешно обновлен', 'success');
            // Перезагружаем данные
            if (currentSection === 'requests') {
                loadTableData('requests');
            } else if (currentSection === 'dashboard') {
                showDashboard();
            }
        } else {
            showToast('Ошибка обновления статуса: ' + data.message, 'error');
        }
    } catch (error) {
        console.error('Ошибка обновления статуса:', error);
        showToast('Произошла ошибка при обновлении статуса', 'error');
    }
}

// Функция для отображения детальной информации о заявке
function showRequestDetails(request) {
    const modal = new bootstrap.Modal(document.getElementById('editModal'));
    document.getElementById('modalTitle').textContent = 'Детали заявки';
    
    const formFields = document.getElementById('formFields');
    formFields.innerHTML = `
        <div class="row">
            <div class="col-md-6">
                <h6>Контактные данные</h6>
                <p><strong>Имя:</strong> ${request.name}</p>
                <p><strong>Телефон:</strong> ${request.phone}</p>
                <p><strong>Email:</strong> ${request.email || 'Не указан'}</p>
                <p><strong>Комментарий:</strong> ${request.comment || 'Не указан'}</p>
            </div>
            <div class="col-md-6">
                <h6>Параметры дома</h6>
                <p><strong>Площадь:</strong> ${request.area} м²</p>
                <p><strong>Тип дома:</strong> ${request.house_type ? request.house_type.name : 'Не указан'}</p>
                <p><strong>Этажность:</strong> ${request.floor ? request.floor.name : 'Не указан'}</p>
                <p><strong>Материал:</strong> ${request.material ? request.material.name : 'Не указан'}</p>
                <p><strong>Фундамент:</strong> ${request.foundation ? request.foundation.name : 'Не указан'}</p>
                <p><strong>Крыша:</strong> ${request.roof ? request.roof.name : 'Не указан'}</p>
                <p><strong>Фасад:</strong> ${request.facade ? request.facade.name : 'Не указан'}</p>
                <p><strong>Электрика:</strong> ${request.electrical ? request.electrical.name : 'Не указан'}</p>
                <p><strong>Отделка стен:</strong> ${request.wall_finish ? request.wall_finish.name : 'Не указан'}</p>
                <p><strong>Дополнения:</strong> ${request.additions_names || 'Не выбраны'}</p>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12">
                <h6>Статус заявки</h6>
                <select class="form-select" id="requestStatus">
                    <option value="new" ${request.status === 'new' ? 'selected' : ''}>Новая</option>
                    <option value="in_progress" ${request.status === 'in_progress' ? 'selected' : ''}>В работе</option>
                    <option value="completed" ${request.status === 'completed' ? 'selected' : ''}>Завершена</option>
                    <option value="cancelled" ${request.status === 'cancelled' ? 'selected' : ''}>Отменена</option>
                </select>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12">
                <h6>Итоговая стоимость</h6>
                <h4 class="text-success">${new Intl.NumberFormat('ru-RU').format(request.total_price)} ₽</h4>
            </div>
        </div>
    `;
    
    // Настройка кнопки сохранения
    const saveBtn = document.querySelector('#editModal .btn-success');
    saveBtn.onclick = () => {
        const newStatus = document.getElementById('requestStatus').value;
        updateRequestStatus(request.id, newStatus);
        modal.hide();
    };
    
    modal.show();
}

// Функция для отображения детальной информации об обращении
function showFeedbackDetails(feedback) {
    const modal = new bootstrap.Modal(document.getElementById('editModal'));
    document.getElementById('modalTitle').textContent = 'Детали обращения';
    
    const formFields = document.getElementById('formFields');
    formFields.innerHTML = `
        <div class="row">
            <div class="col-md-6">
                <h6>Контактные данные</h6>
                <p><strong>Имя:</strong> ${feedback.firstname}</p>
                <p><strong>Телефон:</strong> ${feedback.tel}</p>
                <p><strong>Email:</strong> ${feedback.email}</p>
            </div>
            <div class="col-md-6">
                <h6>Сообщение</h6>
                <p>${feedback.subject || 'Сообщение не указано'}</p>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12">
                <h6>Дата обращения</h6>
                <p>${new Date(feedback.created_at).toLocaleString('ru-RU')}</p>
            </div>
        </div>
    `;
    
    // Скрываем кнопку сохранения для обращений
    const saveBtn = document.querySelector('#editModal .btn-success');
    saveBtn.style.display = 'none';
    
    modal.show();
}
