let adminData = {};

// Массив с типами элементов для загрузки с сервера
const types = ['houseTypes', 'floors', 'roofs', 'materials', 'foundations', 'facades', 'electrical', 'wallFinishes', 'additions'];

const defaultAdminData = {
    houseTypes: [
        {
            id: 1,
            name: "Каркасный дом",
            description: "Современный деревянный каркасный дом с отличной теплоизоляцией",
            price: 25000,
            image: "img/carc-house.png"
        },
        {
            id: 2,
            name: "Дом из бруса",
            description: "Классический дом из строганного бруса",
            price: 30000,
            image: "img/brus-house.png"
        },
        {
            id: 3,
            name: "Дом из бревна",
            description: "Традиционный дом из оцилиндрованного бревна",
            price: 35000,
            image: "img/brev-house.jpg"
        },
        {
            id: 4,
            name: "Дом из лафета",
            description: "Премиальный дом из лафета ручной рубки",
            price: 40000,
            image: "img/lafet-house.jpg"
        }
    ],
    floors: [
        { 
            id: 1, 
            name: 'Одноэтажный', 
            value: 1, 
            multiplier: 1,
            image: 'img/1floor.jpg',
            description: 'Одноэтажный дом - классическое решение для небольшой семьи'
        },
        { 
            id: 2, 
            name: 'Двухэтажный', 
            value: 2, 
            multiplier: 1.8,
            image: 'img/2floor.jpg',
            description: 'Двухэтажный дом - оптимальное использование земельного участка'
        },
        {
            id: 3,
            name: "Одноэтажный с мансардой",
            value: 3, 
            multiplier: 1.3,
            image: "img/3floor.jpg",
            description: 'Компактный дом с жилой мансардой - экономичный и функциональный вариант'
        },
        {
            id: 4,
            name: "Двухэтажный с цоколем",
            value: 4, 
            multiplier: 2.1,
            image: "img/4floor.jpg",
            description: 'Двухэтажный дом с цокольным этажом - подходит для любых грунтов'
        }
    ],
    roofs: [
        {
            id: 1,
            name: "Двускатная",
            description: "Классическая двускатная крыша",
            price: 280000,  
            image: "img/1roof.jpg"
        },
        {
            id: 2,
            name: "Четырехскатная",
            description: "Традиционная четырехскатная крыша",
            price: 350000,  
            image: "img/2roof.jpg"
        },
        {
            id: 3,
            name: "Мансардная",
            description: "Крыша с жилой мансардой",
            price: 420000,  
            image: "img/3roof.jpg"
        },
        {
            id: 4,
            name: "Многощипцовая",
            description: "Сложная многощипцовая крыша",
            price: 520000,  
            image: "img/4roof.jpg"
        }
    ],
    materials: [
        {
            id: 1,
            name: "Профилированный брус",
            description: "Сухой профилированный брус 145х145",
            price: 28000,   
            image: "img/prof-brus.png"
        },
        {
            id: 2,
            name: "Клееный брус",
            description: "Премиальный клееный брус 200х200",
            price: 42000,   
            image: "img/kleenyj-brus.jpg"
        },
        {
            id: 3,
            name: "Оцилиндрованное бревно",
            description: "Оцилиндрованное бревно диаметром 240мм",
            price: 32000,   
            image: "img/ocil-brus.jpg"
        },
        {
            id: 4,
            name: "Лафет",
            description: "Лафет ручной рубки 240х240",
            price: 45000,   
            image: "img/lafet-brus.png"
        }
    ],
    foundations: [
        {
            id: 1,
            name: "Ленточный",
            description: "Классический ленточный фундамент",
            price: 12000,   
            image: "img/fund1.jpg"
        },
        {
            id: 2,
            name: "Свайно-винтовой",
            description: "Современный свайно-винтовой фундамент",
            price: 8000,    
            image: "img/fund2.jpg"
        },
        {
            id: 3,
            name: "Свайно-ростверковый",
            description: "Надежный свайно-ростверковый фундамент",
            price: 15000,   
            image: "img/fund3.jpg"
        },
        {
            id: 4,
            name: "Монолитная плита",
            description: "Усиленная монолитная плита",
            price: 18000,   
            image: "img/fund4.jpeg"
        }
    ],
    facades: [
        {
            id: 1,
            name: "Натуральное дерево",
            description: "Фасад из натурального дерева с защитной пропиткой",
            price: 3500,    
            image: "img/fas1.png"
        },
        {
            id: 2,
            name: "Имитация бруса",
            description: "Фасад из имитации бруса с покраской",
            price: 2800,    
            image: "img/fas2.jpg"
        },
        {
            id: 3,
            name: "Блок-хаус",
            description: "Фасад из блок-хауса под бревно",
            price: 3200,    
            image: "img/fas3.jpg"
        },
        {
            id: 4,
            name: "Планкен",
            description: "Современный фасад из планкена",
            price: 4500,    
            image: "img/fas4.jpg"
        }
    ],
    electrical: [
        {
            id: 1,
            name: "Базовый",
            description: "Базовая электрика для небольшого дома",
            price: 1200,    
            sockets: 10,
            switches: 5,
            lights: 8,
            image: "img/elec1.jpg"
        },
        {
            id: 2,
            name: "Стандарт",
            description: "Стандартный пакет электрики",
            price: 1800,    
            sockets: 15,
            switches: 8,
            lights: 12,
            image: "img/elec2.jpg"
        },
        {
            id: 3,
            name: "Комфорт",
            description: "Расширенный пакет электрики",
            price: 2500,    
            sockets: 20,
            switches: 12,
            lights: 16,
            image: "img/elec3.jpg"
        },
        {
            id: 4,
            name: "Премиум",
            description: "Премиальный пакет с системой умный дом",
            price: 3500,    
            sockets: 25,
            switches: 15,
            lights: 20,
            image: "img/elec4.jpg"
        }
    ],
    wallFinishes: [
        {
            id: 1,
            name: "Шлифовка",
            description: "Шлифовка стен с защитной пропиткой",
            price: 800,     
            image: "img/wall1.jpg"
        },
        {
            id: 2,
            name: "Покраска",
            description: "Шлифовка и покраска стен",
            price: 1200,    
            image: "img/wall2.jpg"
        },
        {
            id: 3,
            name: "Вагонка",
            description: "Отделка стен вагонкой",
            price: 2200,    
            image: "img/wall3.jpg"
        },
        {
            id: 4,
            name: "Имитация бруса",
            description: "Отделка стен имитацией бруса",
            price: 2500,    
            image: "img/wall4.jpg"
        }
    ],
    additions: [
        {
            id: 1,
            name: "Терраса",
            description: "Открытая терраса из дерева",
            price: 15000,
            category: "design",
            image: "img/add1.jpg"
        },
        {
            id: 2,
            name: "Крыльцо",
            description: "Деревянное крыльцо с навесом",
            price: 8000,
            category: "design",
            image: "img/add2.jpg"
        },
        {
            id: 3,
            name: "Балкон",
            description: "Деревянный балкон с резными элементами",
            price: 12000,
            category: "design",
            image: "img/add3.jpg"
        },
        {
            id: 4,
            name: "Веранда",
            description: "Закрытая веранда с панорамными окнами",
            price: 20000,
            category: "design",
            image: "img/add4.jpg"
        }
    ],
    requests: []
};

function loadAdminData() {
    try {
        // Загружаем данные из API вместо localStorage
        fetch('/api/calculator/data')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Ошибка при загрузке данных');
                }
                return response.json();
            })
            .then(data => {
                adminData = data;
                renderAllSections();
            })
            .catch(error => {
                console.error('Error loading admin data:', error);
                showNotification('Ошибка при загрузке данных. Проверьте соединение с сервером.', 'error');
            });
    } catch (error) {
        console.error('Error loading admin data:', error);
    }
}

function saveData() {
    // Эта функция больше не нужна для прямого сохранения всех данных одновременно
    // Теперь сохранение происходит через специализированные API для каждого типа данных
    console.log('Данные управляются через API');
    
    // Обновляем UI
    renderAllSections();
}

function showAddRequestForm() {
    const html = `
        <div class="form-group">
            <label>Имя:</label>
            <input type="text" id="requestName" class="form-input">
        </div>
        <div class="form-group">
            <label>Телефон:</label>
            <input type="text" id="requestPhone" class="form-input">
        </div>
        <div class="form-group">
            <label>Email:</label>
            <input type="email" id="requestEmail" class="form-input">
        </div>
        <div class="form-group">
            <label>Комментарий:</label>
            <textarea id="requestComment" class="form-input"></textarea>
        </div>
    `;

    showModal('Добавить заявку', html, () => {
        const name = document.getElementById('requestName').value;
        const phone = document.getElementById('requestPhone').value;
        const email = document.getElementById('requestEmail').value;
        const comment = document.getElementById('requestComment').value;

        if (name && phone && email) {
            const newRequest = {
                id: Date.now(),
                date: new Date().toISOString(),
                status: 'new',
                name,
                phone,
                email,
                comment,
                selections: {},
                totalPrice: 0
            };
            adminData.requests.push(newRequest);
            saveData();
            renderRequests();
            closeModal();
        } else {
            showNotification('Заполните обязательные поля', 'error');
        }
    });
}

function showTab(tabName) {
    // Скрываем все вкладки
    document.querySelectorAll('.tab-content').forEach(tab => {
        tab.classList.remove('active');
    });

    // Показываем выбранную вкладку
    const selectedTab = document.getElementById(`${tabName}Tab`);
    if (selectedTab) {
        selectedTab.classList.add('active');
    }

    // Обновляем активную кнопку в меню
    document.querySelectorAll('.nav-button').forEach(button => {
        button.classList.remove('active');
    });
    const activeButton = document.querySelector(`[onclick="showTab('${tabName}')"]`);
    if (activeButton) {
        activeButton.classList.add('active');
    }

    // Загружаем данные для активной вкладки
    renderTabContent(tabName);
}

// Функция для отображения контента активной вкладки
function renderTabContent(tabName) {
    switch(tabName) {
        case 'houseTypes':
            renderHouseTypes();
            break;
        case 'floors':
            renderFloorsAdmin();
            break;
        case 'roofs':
            renderRoofs();
            break;
        case 'materials':
            renderMaterials();
            break;
        case 'foundations':
            renderFoundations();
            break;
        case 'facades':
            renderFacades();
            break;
        case 'electrical':
            renderElectrical();
            break;
        case 'wallFinishes':
            renderWallFinishes();
            break;
        case 'additions':
            renderAdditions();
            break;
        case 'requests':
            loadRequests();
            break;
    }
}


function handleLogin(event) {
    event.preventDefault();
    const password = document.getElementById('password').value;
    const loginPage = document.getElementById('loginPage');
    const adminLayout = document.querySelector('.admin-layout');
    const errorMessage = document.getElementById('errorMessage');
    const successMessage = document.getElementById('successMessage');

    // Отправляем запрос на сервер для проверки пароля
    fetch('/admin/login', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ password })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Неверный пароль');
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            successMessage.style.display = 'block';
            errorMessage.style.display = 'none';
            
            loginPage.style.display = 'none';
            adminLayout.style.display = 'flex';
            
            loadAdminData();
            renderAllSections();
        } else {
            errorMessage.style.display = 'block';
            successMessage.style.display = 'none';
        }
    })
    .catch(error => {
        console.error('Login error:', error);
        errorMessage.style.display = 'block';
        successMessage.style.display = 'none';
    });
}

function checkAuth() {
    const loginPage = document.getElementById('loginPage');
    const adminLayout = document.querySelector('.admin-layout');
    
    if (!loginPage || !adminLayout) {
        console.error('Не найдены необходимые элементы для авторизации');
        return;
    }

    // Проверяем авторизацию через API вместо localStorage
    fetch('/admin/check-auth')
        .then(response => response.json())
        .then(data => {
            if (data.authenticated) {
                loginPage.style.display = 'none';
                adminLayout.style.display = 'flex';
                loadAdminData();
                // После авторизации показываем первую вкладку
                showTab('houseTypes');
            } else {
                loginPage.style.display = 'flex';
                adminLayout.style.display = 'none';
            }
        })
        .catch(error => {
            console.error('Auth check error:', error);
            loginPage.style.display = 'flex';
            adminLayout.style.display = 'none';
            showNotification('Ошибка при проверке авторизации', 'error');
        });
}

function logout() {
    // Выход через API вместо localStorage
    fetch('/admin/logout', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
    })
    .then(response => response.json())
    .then(() => {
        const loginPage = document.getElementById('loginPage');
        const adminLayout = document.querySelector('.admin-layout');
        
        if (loginPage && adminLayout) {
            loginPage.style.display = 'flex';
            adminLayout.style.display = 'none';
        }
        
        const passwordInput = document.getElementById('password');
        if (passwordInput) {
            passwordInput.value = '';
        }
    })
    .catch(error => {
        console.error('Logout error:', error);
    });
}


function showModal(title, content, onSave) {
    
    let modal = document.getElementById('adminModal');
    if (!modal) {
        modal = document.createElement('div');
        modal.id = 'adminModal';
        modal.className = 'modal';
        document.body.appendChild(modal);
    }

    
    modal.innerHTML = `
        <div class="modal-content">
            <div class="modal-header">
                <h2>${title}</h2>
                <span class="close-modal" onclick="closeModal()">&times;</span>
            </div>
            <div class="modal-body">
                ${content}
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" onclick="closeModal()">Отмена</button>
                <button class="btn btn-primary" onclick="handleModalSave()">Сохранить</button>
            </div>
        </div>
    `;

    
    modal.onSave = onSave;

    
    modal.style.display = 'block';
}

function closeModal() {
    const modal = document.getElementById('adminModal');
    if (modal) {
        modal.style.display = 'none';
    }
}

function handleModalSave() {
    const modal = document.getElementById('adminModal');
    if (modal && modal.onSave) {
        modal.onSave();
    }
}

window.onclick = function(event) {
    const modal = document.getElementById('adminModal');
    if (event.target === modal) {
        closeModal();
    }
}


function addImagePreview(inputId, previewId) {
    const input = document.getElementById(inputId);
    const preview = document.getElementById(previewId);

    if (input && preview) {
        input.addEventListener('input', function() {
            const imageUrl = this.value;
            if (imageUrl) {
                preview.innerHTML = `<img src="${imageUrl}" alt="Preview">`;
            } else {
                preview.innerHTML = '';
            }
        });
    }
}


function renderAllSections() {
    // Находим активную вкладку
    const activeTab = document.querySelector('.tab-content.active');
    if (activeTab) {
        const tabName = activeTab.id.replace('Tab', '');
        renderTabContent(tabName);
    } else {
        // Если нет активной вкладки, показываем первую по умолчанию
        showTab('houseTypes');
    }
}


function renderHouseTypes() {
    const container = document.getElementById('houseTypesContainer');
    if (!container) return;

    // Проверяем наличие данных
    if (!adminData.houseTypes || adminData.houseTypes.length === 0) {
        container.innerHTML = '<div class="no-data">Нет данных о типах домов</div>';
        return;
    }

    let html = '';
    adminData.houseTypes.forEach(house => {
        const formattedPrice = typeof house.price === 'number' ? 
            house.price.toLocaleString() : '0';

        html += `
            <div class="card">
                ${house.image ? 
                    `<img src="${house.image}" alt="${house.name}" class="card-image">` : 
                    '<div class="no-image">Нет изображения</div>'
                }
                <div class="card-content">
                    <h3>${house.name || 'Без названия'}</h3>
                    <div class="price-tag">${formattedPrice} ₽/м²</div>
                    ${house.description ? 
                        `<div class="description">${house.description}</div>` : 
                        ''
                    }
                    <div class="card-actions">
                        <button onclick="editHouseType(${house.id})" class="btn btn-edit">
                            <i class="fas fa-edit"></i> Редактировать
                        </button>
                        <button onclick="deleteHouseType(${house.id})" class="btn btn-delete">
                            <i class="fas fa-trash"></i> Удалить
                        </button>
                    </div>
                </div>
            </div>
        `;
    });

    container.innerHTML = html;
    
    // Добавляем кнопку добавления нового элемента
    const addButton = document.createElement('div');
    addButton.className = 'card add-card';
    addButton.innerHTML = `
        <div class="add-content" onclick="showAddHouseTypeForm()">
            <i class="fas fa-plus-circle"></i>
            <p>Добавить тип дома</p>
        </div>
    `;
    container.appendChild(addButton);
}

function showAddHouseTypeForm() {
    const html = `
        <div class="form-group">
            <label for="houseTypeName">Название:</label>
            <input type="text" id="houseTypeName" class="form-input" required>
        </div>
        <div class="form-group">
            <label for="houseTypePrice">Стоимость:</label>
            <input type="number" id="houseTypePrice" class="form-input" required>
        </div>
        <div class="form-group">
            <label for="houseTypeImage">URL изображения:</label>
            <input type="text" id="houseTypeImage" class="form-input">
        </div>
        <div class="form-group">
            <label for="houseTypeDescription">Описание:</label>
            <textarea id="houseTypeDescription" class="form-input"></textarea>
        </div>
        <div class="image-preview" id="imagePreview"></div>
    `;

    showModal('Добавить тип дома', html, () => {
        const name = document.getElementById('houseTypeName')?.value;
        const priceInput = document.getElementById('houseTypePrice')?.value;
        const price = priceInput ? parseFloat(priceInput) : 0;
        const image = document.getElementById('houseTypeImage')?.value || '';
        const description = document.getElementById('houseTypeDescription')?.value || '';

        if (!name || isNaN(price)) {
            showNotification('Заполните корректно обязательные поля: Название и Стоимость', 'error');
            return;
        }

        const newHouseType = {
            id: Date.now(),
            name,
            price,
            image,
            description
        };

        if (!adminData.houseTypes) {
            adminData.houseTypes = [];
        }

        adminData.houseTypes.push(newHouseType);
        saveData();
        renderHouseTypes();
        closeModal();
    });

    addImagePreview('houseTypeImage', 'imagePreview');
}

function editHouseType(id) {
    const house = adminData.houseTypes.find(h => h.id === id);
    if (!house) return;

    const html = `
        <div class="form-group">
            <label for="houseTypeName">Название:</label>
            <input type="text" id="houseTypeName" class="form-input" value="${house.name || ''}" required>
        </div>
        <div class="form-group">
            <label for="houseTypePrice">Стоимость:</label>
            <input type="number" id="houseTypePrice" class="form-input" value="${house.price || 0}" required>
        </div>
        <div class="form-group">
            <label for="houseTypeImage">URL изображения:</label>
            <input type="text" id="houseTypeImage" class="form-input" value="${house.image || ''}">
        </div>
        <div class="form-group">
            <label for="houseTypeDescription">Описание:</label>
            <textarea id="houseTypeDescription" class="form-input">${house.description || ''}</textarea>
        </div>
        <div class="image-preview" id="imagePreview">
            ${house.image ? `<img src="${house.image}" alt="Preview">` : ''}
        </div>
    `;

    showModal('Редактировать тип дома', html, () => {
        const name = document.getElementById('houseTypeName')?.value;
        const priceInput = document.getElementById('houseTypePrice')?.value;
        const price = priceInput ? parseFloat(priceInput) : 0;
        const image = document.getElementById('houseTypeImage')?.value || '';
        const description = document.getElementById('houseTypeDescription')?.value || '';

        if (!name || isNaN(price)) {
            showNotification('Заполните корректно обязательные поля: Название и Стоимость', 'error');
            return;
        }

        const index = adminData.houseTypes.findIndex(h => h.id === id);
        if (index !== -1) {
            adminData.houseTypes[index] = { ...house, name, price, image, description };
            saveData();
            renderHouseTypes();
            closeModal();
        }
    });

    addImagePreview('houseTypeImage', 'imagePreview');
}

function deleteHouseType(id) {
    if (confirm('Вы уверены, что хотите удалить этот тип дома?')) {
        adminData.houseTypes = adminData.houseTypes.filter(h => h.id !== id);
        saveData();
        renderHouseTypes();
    }
}


function renderFloors() {
    const container = document.getElementById('floorsContainer');
    if (!container) return;

    if (!adminData.floors || adminData.floors.length === 0) {
        container.innerHTML = '<div class="no-data">Нет данных об этажах</div>';
        
        // Добавляем кнопку для создания первого элемента
        const addButton = document.createElement('div');
        addButton.className = 'card add-card';
        addButton.innerHTML = `
            <div class="add-content" onclick="showAddFloorForm()">
                <i class="fas fa-plus-circle"></i>
                <p>Добавить этаж</p>
            </div>
        `;
        container.appendChild(addButton);
        return;
    }

    let html = '';
    adminData.floors.forEach(floor => {
        html += `
            <div class="card">
                ${floor.image ? 
                    `<img src="${floor.image}" alt="${floor.name}" class="card-image">` : 
                    '<div class="no-image">Нет изображения</div>'
                }
                <div class="card-content">
                    <h3>${floor.name}</h3>
                    <div class="property-value">Множитель: <span>${floor.multiplier || 1}x</span></div>
                    ${floor.description ? 
                        `<div class="description">${floor.description}</div>` : 
                        ''
                    }
                    <div class="card-actions">
                        <button onclick="editFloor(${floor.id})" class="btn btn-edit">
                            <i class="fas fa-edit"></i> Редактировать
                        </button>
                        <button onclick="deleteFloor(${floor.id})" class="btn btn-delete">
                            <i class="fas fa-trash"></i> Удалить
                        </button>
                    </div>
                </div>
            </div>
        `;
    });
    
    container.innerHTML = html;
    
    // Добавляем кнопку добавления нового элемента
    const addButton = document.createElement('div');
    addButton.className = 'card add-card';
    addButton.innerHTML = `
        <div class="add-content" onclick="showAddFloorForm()">
            <i class="fas fa-plus-circle"></i>
            <p>Добавить этаж</p>
        </div>
    `;
    container.appendChild(addButton);
}

function showAddFloorForm(floor = null) {
    const isEdit = !!floor;
    const html = `
        <div class="form-group">
            <label>Название:</label>
            <input type="text" id="floorName" class="form-input" value="${isEdit ? floor.name : ''}">
        </div>
        <div class="form-group">
            <label>Множитель:</label>
            <input type="number" id="floorMultiplier" class="form-input" step="0.1" value="${isEdit ? floor.multiplier : '1.0'}">
        </div>
        <div class="form-group">
            <label>URL изображения:</label>
            <input type="text" id="floorImage" class="form-input" value="${isEdit ? floor.image || '' : ''}">
        </div>
        <div class="form-group">
            <label>Описание:</label>
            <textarea id="floorDescription" class="form-input">${isEdit ? floor.description || '' : ''}</textarea>
        </div>
        <div class="image-preview" id="imagePreview">
            ${isEdit && floor.image ? `<img src="${floor.image}" alt="Preview">` : ''}
        </div>
    `;

    showModal(isEdit ? 'Редактировать этаж' : 'Добавить этаж', html, () => {
        const name = document.getElementById('floorName').value;
        const multiplier = parseFloat(document.getElementById('floorMultiplier').value);
        const image = document.getElementById('floorImage').value;
        const description = document.getElementById('floorDescription').value;

        if (name && multiplier) {
            const newFloor = {
                id: isEdit ? floor.id : Date.now(),
                name,
                multiplier,
                image,
                description
            };

            if (isEdit) {
                const index = adminData.floors.findIndex(f => f.id === floor.id);
                adminData.floors[index] = newFloor;
            } else {
                adminData.floors.push(newFloor);
            }

            saveData();
            renderFloorsAdmin();
            closeModal();
        } else {
            showNotification('Заполните обязательные поля', 'error');
        }
    });

    addImagePreview('floorImage', 'imagePreview');
}
function renderFloorsAdmin() {
    const container = document.getElementById('floorsContainer');
    if (!container) return;

    container.innerHTML = adminData.floors.map(floor => `
        <div class="card">
            ${floor.image ? 
                `<img src="${floor.image}" alt="${floor.name}" class="card-image">` : 
                '<div class="no-image">Нет изображения</div>'
            }
            <div class="card-content">
                <h3>${floor.name}</h3>
                <p>Множитель: ${floor.multiplier || 1}x</p>
                ${floor.description ? `<p class="description">${floor.description}</p>` : ''}
                <div class="card-actions">
                    <button onclick="editFloor(${floor.id})" class="btn btn-edit">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button onclick="deleteFloor(${floor.id})" class="btn btn-delete">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
        </div>
    `).join('');
}

function editFloor(id) {
    const floor = adminData.floors.find(f => f.id === id);
    if (!floor) return;
    showAddFloorForm(floor);
}

function deleteFloor(id) {
    if (confirm('Вы уверены, что хотите удалить этот этаж?')) {
        adminData.floors = adminData.floors.filter(f => f.id !== id);
        saveData();
        renderFloorsAdmin();
    }
}

function renderRoofs() {
    const container = document.getElementById('roofsContainer');
    if (!container) return;

    if (!adminData.roofs || adminData.roofs.length === 0) {
        container.innerHTML = '<div class="no-data">Нет данных о крышах</div>';
        
        // Добавляем кнопку для создания первого элемента
        const addButton = document.createElement('div');
        addButton.className = 'card add-card';
        addButton.innerHTML = `
            <div class="add-content" onclick="showAddRoofForm()">
                <i class="fas fa-plus-circle"></i>
                <p>Добавить крышу</p>
            </div>
        `;
        container.appendChild(addButton);
        return;
    }

    let html = '';
    adminData.roofs.forEach(roof => {
        html += `
            <div class="card">
                ${roof.image ? 
                    `<img src="${roof.image}" alt="${roof.name}" class="card-image">` : 
                    '<div class="no-image">Нет изображения</div>'
                }
                <div class="card-content">
                    <h3>${roof.name}</h3>
                    <div class="price-tag">${roof.price.toLocaleString()} ₽</div>
                    ${roof.description ? 
                        `<div class="description">${roof.description}</div>` : 
                        ''
                    }
                    <div class="card-actions">
                        <button onclick="editRoof(${roof.id})" class="btn btn-edit">
                            <i class="fas fa-edit"></i> Редактировать
                        </button>
                        <button onclick="deleteRoof(${roof.id})" class="btn btn-delete">
                            <i class="fas fa-trash"></i> Удалить
                        </button>
                    </div>
                </div>
            </div>
        `;
    });
    
    container.innerHTML = html;
    
    // Добавляем кнопку добавления нового элемента
    const addButton = document.createElement('div');
    addButton.className = 'card add-card';
    addButton.innerHTML = `
        <div class="add-content" onclick="showAddRoofForm()">
            <i class="fas fa-plus-circle"></i>
            <p>Добавить крышу</p>
        </div>
    `;
    container.appendChild(addButton);
}

function showAddRoofForm() {
    const html = `
        <div class="form-group">
            <label>Название:</label>
            <input type="text" id="roofName" class="form-input">
        </div>
        <div class="form-group">
            <label>Стоимость:</label>
            <input type="number" id="roofPrice" class="form-input">
        </div>
        <div class="form-group">
            <label>URL изображения:</label>
            <input type="text" id="roofImage" class="form-input">
        </div>
        <div class="form-group">
            <label>Описание:</label>
            <textarea id="roofDescription" class="form-input"></textarea>
        </div>
        <div class="image-preview" id="imagePreview"></div>
    `;

    showModal('Добавить крышу', html, () => {
        const name = document.getElementById('roofName').value;
        const price = parseFloat(document.getElementById('roofPrice').value);
        const image = document.getElementById('roofImage').value;
        const description = document.getElementById('roofDescription').value;

        if (name && price) {
            const newRoof = {
                id: Date.now(),
                name,
                price,
                image,
                description
            };
            adminData.roofs.push(newRoof);
            saveData();
            renderRoofs();
            closeModal();
        } else {
            showNotification('Заполните обязательные поля', 'error');
        }
    });

    addImagePreview('roofImage', 'imagePreview');
}

function editRoof(id) {
    const roof = adminData.roofs.find(r => r.id === id);
    if (!roof) return;

    const html = `
        <div class="form-group">
            <label>Название:</label>
            <input type="text" id="roofName" class="form-input" value="${roof.name}">
        </div>
        <div class="form-group">
            <label>Стоимость:</label>
            <input type="number" id="roofPrice" class="form-input" value="${roof.price}">
        </div>
        <div class="form-group">
            <label>URL изображения:</label>
            <input type="text" id="roofImage" class="form-input" value="${roof.image || ''}">
        </div>
        <div class="form-group">
            <label>Описание:</label>
            <textarea id="roofDescription" class="form-input">${roof.description || ''}</textarea>
        </div>
        <div class="image-preview" id="imagePreview">
            ${roof.image ? `<img src="${roof.image}" alt="Preview">` : ''}
        </div>
    `;

    showModal('Редактировать крышу', html, () => {
        const name = document.getElementById('roofName').value;
        const price = parseFloat(document.getElementById('roofPrice').value);
        const image = document.getElementById('roofImage').value;
        const description = document.getElementById('roofDescription').value;

        if (name && price) {
            const index = adminData.roofs.findIndex(r => r.id === id);
            adminData.roofs[index] = { ...roof, name, price, image, description };
            saveData();
            renderRoofs();
            closeModal();
        } else {
            showNotification('Заполните обязательные поля', 'error');
        }
    });

    addImagePreview('roofImage', 'imagePreview');
}

function deleteRoof(id) {
    if (confirm('Вы уверены, что хотите удалить этот тип крыши?')) {
        adminData.roofs = adminData.roofs.filter(r => r.id !== id);
        saveData();
        renderRoofs();
    }
}


function renderMaterials() {
    const container = document.getElementById('materialsContainer');
    if (!container) return;

    // Показываем сообщение о загрузке
    container.innerHTML = '<div class="loading">Загрузка материалов...</div>';

    // Загружаем материалы напрямую с сервера
    fetch('/api/calculator/materials')
        .then(response => {
            if (!response.ok) {
                throw new Error('Ошибка при загрузке материалов');
            }
            return response.json();
        })
        .then(materials => {
            adminData.materials = materials; // Обновляем локальную копию
            
            if (!materials || materials.length === 0) {
                container.innerHTML = '<div class="no-data">Нет данных о материалах</div>';
                
                // Добавляем кнопку для создания первого материала
                const addButton = document.createElement('div');
                addButton.className = 'card add-card';
                addButton.innerHTML = `
                    <div class="add-content" onclick="showAddMaterialForm()">
                        <i class="fas fa-plus-circle"></i>
                        <p>Добавить материал</p>
                    </div>
                `;
                container.appendChild(addButton);
                return;
            }
            
            let html = '';
            materials.forEach(material => {
                html += `
                    <div class="card">
                        ${material.image ? 
                            `<img src="${material.image}" alt="${material.name}" class="card-image">` : 
                            '<div class="no-image">Нет изображения</div>'
                        }
                        <div class="card-content">
                            <h3>${material.name}</h3>
                            <div class="price-tag">${material.price.toLocaleString()} ₽/м²</div>
                            ${material.description ? 
                                `<div class="description">${material.description}</div>` : 
                                ''
                            }
                            <div class="card-actions">
                                <button onclick="editMaterial(${material.id})" class="btn btn-edit">
                                    <i class="fas fa-edit"></i> Редактировать
                                </button>
                                <button onclick="deleteMaterial(${material.id})" class="btn btn-delete">
                                    <i class="fas fa-trash"></i> Удалить
                                </button>
                            </div>
                        </div>
                    </div>
                `;
            });
            
            container.innerHTML = html;
            
            // Добавляем кнопку добавления нового материала
            const addButton = document.createElement('div');
            addButton.className = 'card add-card';
            addButton.innerHTML = `
                <div class="add-content" onclick="showAddMaterialForm()">
                    <i class="fas fa-plus-circle"></i>
                    <p>Добавить материал</p>
                </div>
            `;
            container.appendChild(addButton);
        })
        .catch(error => {
            console.error('Error loading materials:', error);
            container.innerHTML = `
                <div class="error">
                    <p>Ошибка при загрузке материалов</p>
                    <button class="btn btn-primary" onclick="renderMaterials()">Повторить</button>
                </div>
            `;
            showNotification('Ошибка при загрузке материалов: ' + error.message, 'error');
        });
}

function showAddMaterialForm() {
    const html = `
        <div class="form-group">
            <label>Название:</label>
            <input type="text" id="materialName" class="form-input">
        </div>
        <div class="form-group">
            <label>Стоимость за м²:</label>
            <input type="number" id="materialPrice" class="form-input">
        </div>
        <div class="form-group">
            <label>URL изображения:</label>
            <input type="text" id="materialImage" class="form-input">
        </div>
        <div class="form-group">
            <label>Описание:</label>
            <textarea id="materialDescription" class="form-input"></textarea>
        </div>
        <div class="image-preview" id="imagePreview"></div>
    `;

    showModal('Добавить материал', html, () => {
        const name = document.getElementById('materialName').value;
        const price = parseFloat(document.getElementById('materialPrice').value);
        const image = document.getElementById('materialImage').value;
        const description = document.getElementById('materialDescription').value;

        if (name && price) {
            const newMaterial = {
                name,
                price,
                image,
                description
            };
            
            // Отправка на сервер вместо сохранения в localStorage
            fetch('/api/calculator/materials', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify(newMaterial)
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Ошибка при добавлении материала');
                }
                return response.json();
            })
            .then(() => {
                renderMaterials(); // Перезагрузка данных с сервера
                closeModal();
                showNotification('Материал успешно добавлен', 'success');
            })
            .catch(error => {
                console.error('Error adding material:', error);
                showNotification('Ошибка при добавлении материала', 'error');
            });
        } else {
            showNotification('Заполните обязательные поля', 'error');
        }
    });

    addImagePreview('materialImage', 'imagePreview');
}

function editMaterial(id) {
    // Получаем данные материала с сервера
    fetch(`/api/calculator/materials/${id}/edit`)
        .then(response => response.json())
        .then(material => {
            if (!material) {
                showNotification('Материал не найден', 'error');
                return;
            }

            const html = `
                <div class="form-group">
                    <label>Название:</label>
                    <input type="text" id="materialName" class="form-input" value="${material.name}">
                </div>
                <div class="form-group">
                    <label>Стоимость за м²:</label>
                    <input type="number" id="materialPrice" class="form-input" value="${material.price}">
                </div>
                <div class="form-group">
                    <label>URL изображения:</label>
                    <input type="text" id="materialImage" class="form-input" value="${material.image || ''}">
                </div>
                <div class="form-group">
                    <label>Описание:</label>
                    <textarea id="materialDescription" class="form-input">${material.description || ''}</textarea>
                </div>
                <div class="image-preview" id="imagePreview">
                    ${material.image ? `<img src="${material.image}" alt="Preview">` : ''}
                </div>
            `;

            showModal('Редактировать материал', html, () => {
                const name = document.getElementById('materialName').value;
                const price = parseFloat(document.getElementById('materialPrice').value);
                const image = document.getElementById('materialImage').value;
                const description = document.getElementById('materialDescription').value;

                if (name && price) {
                    const updatedMaterial = {
                        name,
                        price,
                        image,
                        description
                    };
                    
                    // Отправляем изменения на сервер
                    fetch(`/api/calculator/materials/${id}`, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify(updatedMaterial)
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Ошибка при обновлении материала');
                        }
                        return response.json();
                    })
                    .then(() => {
                        renderMaterials(); // Перезагрузка данных с сервера
                        closeModal();
                        showNotification('Материал успешно обновлен', 'success');
                    })
                    .catch(error => {
                        console.error('Error updating material:', error);
                        showNotification('Ошибка при обновлении материала', 'error');
                    });
                } else {
                    showNotification('Заполните обязательные поля', 'error');
                }
            });

            addImagePreview('materialImage', 'imagePreview');
        })
        .catch(error => {
            console.error('Error loading material details:', error);
            showNotification('Ошибка при загрузке данных материала', 'error');
        });
}

function deleteMaterial(id) {
    if (confirm('Вы уверены, что хотите удалить этот материал?')) {
        // Удаляем материал на сервере
        fetch(`/api/calculator/materials/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Ошибка при удалении материала');
            }
            return response.json();
        })
        .then(() => {
            renderMaterials(); // Перезагрузка данных с сервера
            showNotification('Материал успешно удален', 'success');
        })
        .catch(error => {
            console.error('Error deleting material:', error);
            showNotification('Ошибка при удалении материала', 'error');
        });
    }
}


function renderFoundations() {
    const container = document.getElementById('foundationsContainer');
    if (!container) return;

    if (!adminData.foundations || adminData.foundations.length === 0) {
        container.innerHTML = '<div class="no-data">Нет данных о фундаментах</div>';
        
        // Добавляем кнопку для создания первого элемента
        const addButton = document.createElement('div');
        addButton.className = 'card add-card';
        addButton.innerHTML = `
            <div class="add-content" onclick="showAddFoundationForm()">
                <i class="fas fa-plus-circle"></i>
                <p>Добавить фундамент</p>
            </div>
        `;
        container.appendChild(addButton);
        return;
    }

    let html = '';
    adminData.foundations.forEach(foundation => {
        html += `
            <div class="card">
                ${foundation.image ? 
                    `<img src="${foundation.image}" alt="${foundation.name}" class="card-image">` : 
                    '<div class="no-image">Нет изображения</div>'
                }
                <div class="card-content">
                    <h3>${foundation.name}</h3>
                    <div class="price-tag">${foundation.price.toLocaleString()} ₽/м²</div>
                    ${foundation.description ? 
                        `<div class="description">${foundation.description}</div>` : 
                        ''
                    }
                    <div class="card-actions">
                        <button onclick="editFoundation(${foundation.id})" class="btn btn-edit">
                            <i class="fas fa-edit"></i> Редактировать
                        </button>
                        <button onclick="deleteFoundation(${foundation.id})" class="btn btn-delete">
                            <i class="fas fa-trash"></i> Удалить
                        </button>
                    </div>
                </div>
            </div>
        `;
    });
    
    container.innerHTML = html;
    
    // Добавляем кнопку добавления нового элемента
    const addButton = document.createElement('div');
    addButton.className = 'card add-card';
    addButton.innerHTML = `
        <div class="add-content" onclick="showAddFoundationForm()">
            <i class="fas fa-plus-circle"></i>
            <p>Добавить фундамент</p>
        </div>
    `;
    container.appendChild(addButton);
}

function showAddFoundationForm() {
    const html = `
        <div class="form-group">
            <label>Название:</label>
            <input type="text" id="foundationName" class="form-input">
        </div>
        <div class="form-group">
            <label>Стоимость за м²:</label>
            <input type="number" id="foundationPrice" class="form-input">
        </div>
        <div class="form-group">
            <label>URL изображения:</label>
            <input type="text" id="foundationImage" class="form-input">
        </div>
        <div class="form-group">
            <label>Описание:</label>
            <textarea id="foundationDescription" class="form-input"></textarea>
        </div>
        <div class="image-preview" id="imagePreview"></div>
    `;

    showModal('Добавить фундамент', html, () => {
        const name = document.getElementById('foundationName').value;
        const price = parseFloat(document.getElementById('foundationPrice').value);
        const image = document.getElementById('foundationImage').value;
        const description = document.getElementById('foundationDescription').value;

        if (name && price) {
            const newFoundation = {
                id: Date.now(),
                name,
                price,
                image,
                description
            };
            adminData.foundations.push(newFoundation);
            saveData();
            renderFoundations();
            closeModal();
        } else {
            showNotification('Заполните обязательные поля', 'error');
        }
    });

    addImagePreview('foundationImage', 'imagePreview');
}

function editFoundation(id) {
    const foundation = adminData.foundations.find(f => f.id === id);
    if (!foundation) return;

    const html = `
        <div class="form-group">
            <label>Название:</label>
            <input type="text" id="foundationName" class="form-input" value="${foundation.name}">
        </div>
        <div class="form-group">
            <label>Стоимость за м²:</label>
            <input type="number" id="foundationPrice" class="form-input" value="${foundation.price}">
        </div>
        <div class="form-group">
            <label>URL изображения:</label>
            <input type="text" id="foundationImage" class="form-input" value="${foundation.image || ''}">
        </div>
        <div class="form-group">
            <label>Описание:</label>
            <textarea id="foundationDescription" class="form-input">${foundation.description || ''}</textarea>
        </div>
        <div class="image-preview" id="imagePreview">
            ${foundation.image ? `<img src="${foundation.image}" alt="Preview">` : ''}
        </div>
    `;

    showModal('Редактировать фундамент', html, () => {
        const name = document.getElementById('foundationName').value;
        const price = parseFloat(document.getElementById('foundationPrice').value);
        const image = document.getElementById('foundationImage').value;
        const description = document.getElementById('foundationDescription').value;

        if (name && price) {
            const index = adminData.foundations.findIndex(f => f.id === id);
            adminData.foundations[index] = { ...foundation, name, price, image, description };
            saveData();
            renderFoundations();
            closeModal();
        } else {
            showNotification('Заполните обязательные поля', 'error');
        }
    });

    addImagePreview('foundationImage', 'imagePreview');
}

function deleteFoundation(id) {
    if (confirm('Вы уверены, что хотите удалить этот фундамент?')) {
        adminData.foundations = adminData.foundations.filter(f => f.id !== id);
        saveData();
        renderFoundations();
    }
}


function renderFacades() {
    const container = document.getElementById('facadesContainer');
    if (!container) return;

    if (!adminData.facades || adminData.facades.length === 0) {
        container.innerHTML = '<div class="no-data">Нет данных о фасадах</div>';
        
        // Добавляем кнопку для создания первого элемента
        const addButton = document.createElement('div');
        addButton.className = 'card add-card';
        addButton.innerHTML = `
            <div class="add-content" onclick="showAddFacadeForm()">
                <i class="fas fa-plus-circle"></i>
                <p>Добавить фасад</p>
            </div>
        `;
        container.appendChild(addButton);
        return;
    }

    let html = '';
    adminData.facades.forEach(facade => {
        html += `
            <div class="card">
                ${facade.image ? 
                    `<img src="${facade.image}" alt="${facade.name}" class="card-image">` : 
                    '<div class="no-image">Нет изображения</div>'
                }
                <div class="card-content">
                    <h3>${facade.name}</h3>
                    <div class="price-tag">${facade.price.toLocaleString()} ₽/м²</div>
                    ${facade.description ? 
                        `<div class="description">${facade.description}</div>` : 
                        ''
                    }
                    <div class="card-actions">
                        <button onclick="editFacade(${facade.id})" class="btn btn-edit">
                            <i class="fas fa-edit"></i> Редактировать
                        </button>
                        <button onclick="deleteFacade(${facade.id})" class="btn btn-delete">
                            <i class="fas fa-trash"></i> Удалить
                        </button>
                    </div>
                </div>
            </div>
        `;
    });
    
    container.innerHTML = html;
    
    // Добавляем кнопку добавления нового элемента
    const addButton = document.createElement('div');
    addButton.className = 'card add-card';
    addButton.innerHTML = `
        <div class="add-content" onclick="showAddFacadeForm()">
            <i class="fas fa-plus-circle"></i>
            <p>Добавить фасад</p>
        </div>
    `;
    container.appendChild(addButton);
}

function showAddFacadeForm() {
    const html = `
        <div class="form-group">
            <label>Название:</label>
            <input type="text" id="facadeName" class="form-input">
        </div>
        <div class="form-group">
            <label>Стоимость за м²:</label>
            <input type="number" id="facadePrice" class="form-input">
        </div>
        <div class="form-group">
            <label>URL изображения:</label>
            <input type="text" id="facadeImage" class="form-input">
        </div>
        <div class="form-group">
            <label>Описание:</label>
            <textarea id="facadeDescription" class="form-input"></textarea>
        </div>
        <div class="image-preview" id="imagePreview"></div>
    `;

    showModal('Добавить фасад', html, () => {
        const name = document.getElementById('facadeName').value;
        const price = parseFloat(document.getElementById('facadePrice').value);
        const image = document.getElementById('facadeImage').value;
        const description = document.getElementById('facadeDescription').value;

        if (name && price) {
            const newFacade = {
                id: Date.now(),
                name,
                price,
                image,
                description
            };
            adminData.facades.push(newFacade);
            saveData();
            renderFacades();
            closeModal();
        } else {
            showNotification('Заполните обязательные поля', 'error');
        }
    });

    addImagePreview('facadeImage', 'imagePreview');
}

function editFacade(id) {
    const facade = adminData.facades.find(f => f.id === id);
    if (!facade) return;

    const html = `
        <div class="form-group">
            <label>Название:</label>
            <input type="text" id="facadeName" class="form-input" value="${facade.name}">
        </div>
        <div class="form-group">
            <label>Стоимость за м²:</label>
            <input type="number" id="facadePrice" class="form-input" value="${facade.price}">
        </div>
        <div class="form-group">
            <label>URL изображения:</label>
            <input type="text" id="facadeImage" class="form-input" value="${facade.image || ''}">
        </div>
        <div class="form-group">
            <label>Описание:</label>
            <textarea id="facadeDescription" class="form-input">${facade.description || ''}</textarea>
        </div>
        <div class="image-preview" id="imagePreview">
            ${facade.image ? `<img src="${facade.image}" alt="Preview">` : ''}
        </div>
    `;

    showModal('Редактировать фасад', html, () => {
        const name = document.getElementById('facadeName').value;
        const price = parseFloat(document.getElementById('facadePrice').value);
        const image = document.getElementById('facadeImage').value;
        const description = document.getElementById('facadeDescription').value;

        if (name && price) {
            const index = adminData.facades.findIndex(f => f.id === id);
            adminData.facades[index] = { ...facade, name, price, image, description };
            saveData();
            renderFacades();
            closeModal();
        } else {
            showNotification('Заполните обязательные поля', 'error');
        }
    });

    addImagePreview('facadeImage', 'imagePreview');
}

function deleteFacade(id) {
    if (confirm('Вы уверены, что хотите удалить этот фасад?')) {
        adminData.facades = adminData.facades.filter(f => f.id !== id);
        saveData();
        renderFacades();
    }
}

function renderElectrical() {
    const container = document.getElementById('electricalContainer');
    if (!container) {
        console.error('Container for electrical not found');
        return;
    }
    
    container.innerHTML = '<div class="loading">Загрузка данных электрики...</div>';
    
    fetch('/api/calculator/electrical')
        .then(response => response.json())
        .then(data => {
            container.innerHTML = '';
            
            if (!data || data.length === 0) {
                container.innerHTML = '<div class="no-data">Нет данных об электрике</div>';
                return;
            }
            
            data.forEach(item => {
                const card = document.createElement('div');
                card.className = 'card';
                card.innerHTML = `
                    <div class="${item.image ? '' : 'no-image'}">
                        ${item.image 
                            ? `<img src="${item.image}" alt="${item.name}" class="card-image">` 
                            : 'Нет изображения'}
                    </div>
                    <div class="card-content">
                        <h3>${item.name}</h3>
                        <div class="price-tag">${item.price.toLocaleString()} ₽/м²</div>
                        <div class="description">${item.description || 'Нет описания'}</div>
                        
                        <div class="details">
                            <p><span>Розетки:</span> <span>${item.sockets || 0} шт.</span></p>
                            <p><span>Выключатели:</span> <span>${item.switches || 0} шт.</span></p>
                            <p><span>Точки освещения:</span> <span>${item.lights || 0} шт.</span></p>
                        </div>
                        
                        <div class="card-actions">
                            <button class="btn-edit" onclick="editElectrical(${item.id})">
                                <i class="fas fa-edit"></i> Редактировать
                            </button>
                            <button class="btn-delete" onclick="deleteElectrical(${item.id})">
                                <i class="fas fa-trash"></i> Удалить
                            </button>
                        </div>
                    </div>
                `;
                container.appendChild(card);
            });
            
            // Добавляем кнопку добавления нового электрического пакета
            const addButton = document.createElement('div');
            addButton.className = 'card add-card';
            addButton.innerHTML = `
                <div class="add-content" onclick="showAddElectricalForm()">
                    <i class="fas fa-plus-circle"></i>
                    <p>Добавить электрический пакет</p>
                </div>
            `;
            container.appendChild(addButton);
        })
        .catch(error => {
            console.error('Error loading electrical data:', error);
            container.innerHTML = '<div class="no-data">Ошибка загрузки данных</div>';
            showNotification('Ошибка при загрузке данных электрики', 'error');
        });
}

function renderWallFinishes() {
    const container = document.getElementById('wallFinishesContainer');
    if (!container) {
        console.error('Container for wall-finishes not found');
        return;
    }
    
    container.innerHTML = '<div class="loading">Загрузка данных отделки стен...</div>';
    
    fetch('/api/calculator/wall-finishes')
        .then(response => response.json())
        .then(data => {
            container.innerHTML = '';
            
            if (!data || data.length === 0) {
                container.innerHTML = '<div class="no-data">Нет данных об отделке стен</div>';
                return;
            }
            
            data.forEach(item => {
                const card = document.createElement('div');
                card.className = 'card';
                card.innerHTML = `
                    <div class="${item.image ? '' : 'no-image'}">
                        ${item.image 
                            ? `<img src="${item.image}" alt="${item.name}" class="card-image">` 
                            : 'Нет изображения'}
                    </div>
                    <div class="card-content">
                        <h3>${item.name}</h3>
                        <div class="price-tag">${item.price.toLocaleString()} ₽/м²</div>
                        <div class="description">${item.description || 'Нет описания'}</div>
                        
                        <div class="card-actions">
                            <button class="btn-edit" onclick="editWallFinish(${item.id})">
                                <i class="fas fa-edit"></i> Редактировать
                            </button>
                            <button class="btn-delete" onclick="deleteWallFinish(${item.id})">
                                <i class="fas fa-trash"></i> Удалить
                            </button>
                        </div>
                    </div>
                `;
                container.appendChild(card);
            });
            
            // Добавляем кнопку добавления новой отделки стен
            const addButton = document.createElement('div');
            addButton.className = 'card add-card';
            addButton.innerHTML = `
                <div class="add-content" onclick="showAddWallFinishForm()">
                    <i class="fas fa-plus-circle"></i>
                    <p>Добавить отделку стен</p>
                </div>
            `;
            container.appendChild(addButton);
        })
        .catch(error => {
            console.error('Error loading wall finishes data:', error);
            container.innerHTML = '<div class="no-data">Ошибка загрузки данных</div>';
            showNotification('Ошибка при загрузке данных отделки стен', 'error');
        });
}

function renderAdditions() {
    const container = document.getElementById('additionsContainer');
    if (!container) {
        console.error('Container for additions not found');
        return;
    }
    
    container.innerHTML = '<div class="loading">Загрузка данных дополнений...</div>';
    
    fetch('/api/calculator/additions')
        .then(response => response.json())
        .then(data => {
            container.innerHTML = '';
            
            if (!data || data.length === 0) {
                container.innerHTML = '<div class="no-data">Нет данных о дополнениях</div>';
                return;
            }
            
            data.forEach(item => {
                const card = document.createElement('div');
                card.className = 'card';
                card.innerHTML = `
                    <div class="${item.image ? '' : 'no-image'}">
                        ${item.image 
                            ? `<img src="${item.image}" alt="${item.name}" class="card-image">` 
                            : 'Нет изображения'}
                    </div>
                    <div class="card-content">
                        <h3>${item.name}</h3>
                        <div class="price-tag">${item.price.toLocaleString()} ₽</div>
                        <div class="description">${item.description || 'Нет описания'}</div>
                        
                        <div class="card-actions">
                            <button class="btn-edit" onclick="editAddition(${item.id})">
                                <i class="fas fa-edit"></i> Редактировать
                            </button>
                            <button class="btn-delete" onclick="deleteAddition(${item.id})">
                                <i class="fas fa-trash"></i> Удалить
                            </button>
                        </div>
                    </div>
                `;
                container.appendChild(card);
            });
            
            // Добавляем кнопку добавления нового дополнения
            const addButton = document.createElement('div');
            addButton.className = 'card add-card';
            addButton.innerHTML = `
                <div class="add-content" onclick="showAddAdditionForm()">
                    <i class="fas fa-plus-circle"></i>
                    <p>Добавить дополнение</p>
                </div>
            `;
            container.appendChild(addButton);
        })
        .catch(error => {
            console.error('Error loading additions data:', error);
            container.innerHTML = '<div class="no-data">Ошибка загрузки данных</div>';
            showNotification('Ошибка при загрузке данных дополнений', 'error');
        });
}

// Заглушки для функций электричества
function showAddElectricalForm() {
    showNotification('Функция добавления электрики будет реализована в следующем обновлении', 'info');
}

function editElectrical(id) {
    showNotification('Функция редактирования электрики будет реализована в следующем обновлении', 'info');
}

function deleteElectrical(id) {
    showNotification('Функция удаления электрики будет реализована в следующем обновлении', 'info');
}

// Заглушки для функций отделки стен
function showAddWallFinishForm() {
    showNotification('Функция добавления отделки стен будет реализована в следующем обновлении', 'info');
}

function editWallFinish(id) {
    showNotification('Функция редактирования отделки стен будет реализована в следующем обновлении', 'info');
}

function deleteWallFinish(id) {
    showNotification('Функция удаления отделки стен будет реализована в следующем обновлении', 'info');
}

// Заглушки для функций дополнений
function showAddAdditionForm() {
    const html = `
        <div class="form-group">
            <label>Название:</label>
            <input type="text" id="additionName" class="form-input">
        </div>
        <div class="form-group">
            <label>Стоимость:</label>
            <input type="number" id="additionPrice" class="form-input">
        </div>
        <div class="form-group">
            <label>Категория:</label>
            <input type="text" id="additionCategory" class="form-input" value="design">
        </div>
        <div class="form-group">
            <label>URL изображения:</label>
            <input type="text" id="additionImage" class="form-input">
        </div>
        <div class="form-group">
            <label>Описание:</label>
            <textarea id="additionDescription" class="form-input"></textarea>
        </div>
        <div class="image-preview" id="imagePreview"></div>
    `;

    showModal('Добавить дополнение', html, () => {
        const name = document.getElementById('additionName').value;
        const price = parseFloat(document.getElementById('additionPrice').value);
        const category = document.getElementById('additionCategory').value;
        const image = document.getElementById('additionImage').value;
        const description = document.getElementById('additionDescription').value;

        if (name && price && category) {
            const newAddition = {
                name,
                price,
                category,
                image,
                description
            };
            
            // Отправляем данные на сервер
            fetch('/additions', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                },
                body: JSON.stringify(newAddition)
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Ошибка при сохранении данных');
                }
                return response.json();
            })
            .then(data => {
                showNotification('Дополнение успешно создано', 'success');
                renderAdditions();
                closeModal();
            })
            .catch(error => {
                console.error('Error saving addition:', error);
                showNotification('Ошибка при сохранении данных: ' + error.message, 'error');
            });
        } else {
            showNotification('Заполните обязательные поля', 'error');
        }
    });

    addImagePreview('additionImage', 'imagePreview');
}

function editAddition(id) {
    fetch(`/additions/${id}/edit`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Не удалось получить данные для редактирования');
            }
            return response.json();
        })
        .then(addition => {
            const html = `
                <div class="form-group">
                    <label>Название:</label>
                    <input type="text" id="additionName" class="form-input" value="${addition.name}">
                </div>
                <div class="form-group">
                    <label>Стоимость:</label>
                    <input type="number" id="additionPrice" class="form-input" value="${addition.price}">
                </div>
                <div class="form-group">
                    <label>Категория:</label>
                    <input type="text" id="additionCategory" class="form-input" value="${addition.category || 'design'}">
                </div>
                <div class="form-group">
                    <label>URL изображения:</label>
                    <input type="text" id="additionImage" class="form-input" value="${addition.image || ''}">
                </div>
                <div class="form-group">
                    <label>Описание:</label>
                    <textarea id="additionDescription" class="form-input">${addition.description || ''}</textarea>
                </div>
                <div class="image-preview" id="imagePreview">
                    ${addition.image ? `<img src="${addition.image}" alt="${addition.name}">` : ''}
                </div>
            `;

            showModal('Редактировать дополнение', html, () => {
                const name = document.getElementById('additionName').value;
                const price = parseFloat(document.getElementById('additionPrice').value);
                const category = document.getElementById('additionCategory').value;
                const image = document.getElementById('additionImage').value;
                const description = document.getElementById('additionDescription').value;

                if (name && price && category) {
                    const updatedAddition = {
                        name,
                        price,
                        category,
                        image,
                        description
                    };
                    
                    fetch(`/additions/${id}`, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify(updatedAddition)
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Ошибка при обновлении данных');
                        }
                        return response.json();
                    })
                    .then(data => {
                        showNotification('Дополнение успешно обновлено', 'success');
                        renderAdditions();
                        closeModal();
                    })
                    .catch(error => {
                        console.error('Error updating addition:', error);
                        showNotification('Ошибка при обновлении данных: ' + error.message, 'error');
                    });
                } else {
                    showNotification('Заполните обязательные поля', 'error');
                }
            });

            addImagePreview('additionImage', 'imagePreview');
        })
        .catch(error => {
            console.error('Error loading addition data:', error);
            showNotification('Ошибка при загрузке данных: ' + error.message, 'error');
        });
}

function deleteAddition(id) {
    showConfirmationModal('Удалить дополнение', 'Вы уверены, что хотите удалить это дополнение?', () => {
        fetch(`/additions/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Ошибка при удалении');
            }
            return response.json();
        })
        .then(data => {
            showNotification('Дополнение успешно удалено', 'success');
            renderAdditions();
        })
        .catch(error => {
            console.error('Error deleting addition:', error);
            showNotification('Ошибка при удалении дополнения: ' + error.message, 'error');
        });
    });
}

// Функция для отображения уведомлений
function showNotification(message, type = 'error') {
    const notification = document.getElementById('notification');
    const notificationMessage = document.getElementById('notificationMessage');
    
    if (notification && notificationMessage) {
        notification.className = `notification ${type}`;
        notificationMessage.textContent = message;
        notification.classList.remove('hidden');
        
        setTimeout(() => {
            notification.classList.add('hidden');
        }, 5000);
    } else {
        // Если элементов нет, создаем их
        const newNotification = document.createElement('div');
        newNotification.id = 'notification';
        newNotification.className = `notification ${type}`;
        
        const newMessage = document.createElement('div');
        newMessage.id = 'notificationMessage';
        newMessage.textContent = message;
        
        newNotification.appendChild(newMessage);
        document.body.appendChild(newNotification);
        
        setTimeout(() => {
            newNotification.classList.add('hidden');
            
            // Удаляем элемент через 5.5 секунд
            setTimeout(() => {
                document.body.removeChild(newNotification);
            }, 500);
        }, 5000);
    }
}

// Инициализация при загрузке страницы
document.addEventListener('DOMContentLoaded', function() {
    // Инициализация модального окна уведомлений
    if (!document.getElementById('notification')) {
        const notification = document.createElement('div');
        notification.id = 'notification';
        notification.className = 'notification hidden';
        notification.innerHTML = '<div id="notificationMessage"></div>';
        document.body.appendChild(notification);
    }
    
    // Проверка авторизации админа
    checkAuth();
    
    // Загрузка данных для всех типов
    types.forEach(type => loadData(type));
});

function loadData(type) {
    // Преобразование kebab-case в camelCase для идентификаторов контейнеров
    const containerType = type.replace(/-([a-z])/g, function(match, p1) {
        return p1.toUpperCase();
    });
    const containerId = `${containerType}Container`;
    const container = document.getElementById(containerId);
    
    if (!container) {
        console.error(`Container for ${type} not found (ID: ${containerId})`);
        return;
    }

    // Преобразуем camelCase обратно в kebab-case для URL запросов
    let apiType = type;
    if (type === 'wallFinishes') {
        apiType = 'wall-finishes';
    } else if (type === 'houseTypes') {
        apiType = 'house-types';
    }

    // Показываем индикатор загрузки
    container.innerHTML = '<div class="loading">Загрузка данных...</div>';

    // Исправляем URL, добавляя префикс /api/calculator/
    fetch(`/api/calculator/${apiType}`, {
        headers: {
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        // Сохраняем данные в adminData
        adminData[containerType] = data;
        
        container.innerHTML = '';
        if (!data || data.length === 0) {
            container.innerHTML = '<div class="no-data">Нет данных</div>';
        } else {
            data.forEach(item => {
                const card = document.createElement('div');
                card.className = 'card';
                card.innerHTML = `
                    <div class="card-body">
                        <h5 class="card-title">${item.name}</h5>
                        ${item.price ? `<p class="card-text">Цена: ${item.price.toLocaleString()} ₽</p>` : ''}
                        ${item.multiplier ? `<p class="card-text">Множитель: ${item.multiplier}x</p>` : ''}
                        ${item.description ? `<p class="card-text">${item.description}</p>` : ''}
                        ${item.image ? `
                            <div class="card-img-container">
                                <img src="${item.image}" class="card-img-top" alt="${item.name}">
                            </div>
                        ` : ''}
                        <div class="btn-group mt-2">
                            <button class="btn btn-primary btn-sm" onclick="editItem('${apiType}', ${item.id})">
                                <i class="fas fa-edit"></i> Редактировать
                            </button>
                            <button class="btn btn-danger btn-sm" onclick="deleteItem('${apiType}', ${item.id})">
                                <i class="fas fa-trash"></i> Удалить
                            </button>
                        </div>
                    </div>
                `;
                container.appendChild(card);
            });
        }
        
        // Добавляем кнопку добавления нового элемента
        const addButton = document.createElement('div');
        addButton.className = 'card add-card';
        addButton.innerHTML = `
            <div class="add-content" onclick="showAddModal('${apiType}')">
                <i class="fas fa-plus-circle"></i>
                <p>Добавить элемент</p>
            </div>
        `;
        container.appendChild(addButton);
    })
    .catch(error => {
        console.error(`Error loading data for ${type}:`, error);
        container.innerHTML = `
            <div class="error-message">
                Ошибка загрузки данных: ${error.message}
                <button class="btn btn-sm btn-primary mt-2" onclick="loadData('${type}')">Повторить</button>
            </div>`;
        showNotification(`Ошибка при загрузке данных ${type}: ${error.message}`, 'error');
    });
}

function editItem(type, id) {
    // Показываем индикатор загрузки в модальном окне
    document.getElementById('modalBody').innerHTML = '<div class="loading">Загрузка данных...</div>';
    adminModal.show();
    
    // Используем единый формат URL для получения элемента
    const apiUrl = `/api/calculator/${type}/${id}`;
    
    fetch(apiUrl, {
        headers: {
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`Ошибка HTTP: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        // Заполняем модальное окно данными
        document.getElementById('modalTitle').textContent = `Редактировать ${data.name}`;
        
        const formHtml = `
            <form id="itemForm">
                <input type="hidden" id="itemId" value="${data.id}">
                <input type="hidden" id="itemType" value="${type}">
                
                <div class="form-group">
                    <label for="name" class="form-label">Название</label>
                    <input type="text" id="name" class="form-control" value="${data.name || ''}" required>
                </div>
                
                <div class="form-group ${type === 'floors' ? 'd-none' : ''}">
                    <label for="price" class="form-label">Цена</label>
                    <input type="number" id="price" class="form-control" value="${data.price || ''}" ${type === 'floors' ? '' : 'required'}>
                </div>
                
                <div class="form-group ${type === 'floors' ? '' : 'd-none'}">
                    <label for="multiplier" class="form-label">Множитель</label>
                    <input type="number" id="multiplier" class="form-control" step="0.1" value="${data.multiplier || ''}" ${type === 'floors' ? 'required' : ''}>
                </div>
                
                <div class="form-group">
                    <label for="description" class="form-label">Описание</label>
                    <textarea id="description" class="form-control">${data.description || ''}</textarea>
                </div>
                
                <div class="form-group">
                    <label for="image" class="form-label">URL изображения</label>
                    <input type="text" id="image" class="form-control" value="${data.image || ''}">
                </div>
                
                <div id="additionalFields">
                    ${type === 'electrical' ? `
                        <div class="form-group">
                            <label for="sockets" class="form-label">Количество розеток</label>
                            <input type="number" id="sockets" class="form-control" value="${data.sockets || 0}">
                        </div>
                        <div class="form-group">
                            <label for="switches" class="form-label">Количество выключателей</label>
                            <input type="number" id="switches" class="form-control" value="${data.switches || 0}">
                        </div>
                        <div class="form-group">
                            <label for="lights" class="form-label">Количество светильников</label>
                            <input type="number" id="lights" class="form-control" value="${data.lights || 0}">
                        </div>
                    ` : ''}
                    
                    ${type === 'additions' ? `
                        <div class="form-group">
                            <label for="category" class="form-label">Категория</label>
                            <select id="category" class="form-select">
                                <option value="design" ${data.category === 'design' ? 'selected' : ''}>Дизайн</option>
                                <option value="utility" ${data.category === 'utility' ? 'selected' : ''}>Утилиты</option>
                                <option value="comfort" ${data.category === 'comfort' ? 'selected' : ''}>Комфорт</option>
                            </select>
                        </div>
                    ` : ''}
                </div>
                
                <div class="image-preview mt-3 ${data.image ? '' : 'd-none'}" id="imagePreview">
                    ${data.image ? `<img src="${data.image}" alt="${data.name}" class="img-thumbnail">` : ''}
                </div>
            </form>
            
            <div class="mt-3">
                <button class="btn btn-primary" onclick="saveItem()">Сохранить</button>
                <button class="btn btn-secondary" onclick="adminModal.hide()">Отмена</button>
            </div>
        `;
        
        document.getElementById('modalBody').innerHTML = formHtml;
        
        // Добавляем обработчик изменения URL изображения
        const imageInput = document.getElementById('image');
        const imagePreview = document.getElementById('imagePreview');
        
        if (imageInput && imagePreview) {
            imageInput.addEventListener('input', function() {
                if (this.value) {
                    imagePreview.innerHTML = `<img src="${this.value}" alt="Preview" class="img-thumbnail">`;
                    imagePreview.classList.remove('d-none');
                } else {
                    imagePreview.innerHTML = '';
                    imagePreview.classList.add('d-none');
                }
            });
        }
    })
    .catch(error => {
        console.error('Error loading item:', error);
        document.getElementById('modalBody').innerHTML = `
            <div class="alert alert-danger">
                Ошибка загрузки данных: ${error.message}
            </div>
            <button class="btn btn-secondary" onclick="adminModal.hide()">Закрыть</button>
        `;
        showNotification('Ошибка загрузки данных: ' + error.message, 'error');
    });
}

function showAddModal(type) {
    document.getElementById('modalTitle').textContent = `Добавить новый элемент`;
    
    const formHtml = `
        <form id="itemForm">
            <input type="hidden" id="itemId" value="">
            <input type="hidden" id="itemType" value="${type}">
            
            <div class="form-group">
                <label for="name" class="form-label">Название</label>
                <input type="text" id="name" class="form-control" required>
            </div>
            
            <div class="form-group ${type === 'floors' ? 'd-none' : ''}">
                <label for="price" class="form-label">Цена</label>
                <input type="number" id="price" class="form-control" ${type === 'floors' ? '' : 'required'}>
            </div>
            
            <div class="form-group ${type === 'floors' ? '' : 'd-none'}">
                <label for="multiplier" class="form-label">Множитель</label>
                <input type="number" id="multiplier" class="form-control" step="0.1" value="1.0" ${type === 'floors' ? 'required' : ''}>
            </div>
            
            <div class="form-group">
                <label for="description" class="form-label">Описание</label>
                <textarea id="description" class="form-control"></textarea>
            </div>
            
            <div class="form-group">
                <label for="image" class="form-label">URL изображения</label>
                <input type="text" id="image" class="form-control">
            </div>
            
            <div id="additionalFields">
                ${type === 'electrical' ? `
                    <div class="form-group">
                        <label for="sockets" class="form-label">Количество розеток</label>
                        <input type="number" id="sockets" class="form-control" value="10">
                    </div>
                    <div class="form-group">
                        <label for="switches" class="form-label">Количество выключателей</label>
                        <input type="number" id="switches" class="form-control" value="5">
                    </div>
                    <div class="form-group">
                        <label for="lights" class="form-label">Количество светильников</label>
                        <input type="number" id="lights" class="form-control" value="8">
                    </div>
                ` : ''}
                
                ${type === 'additions' ? `
                    <div class="form-group">
                        <label for="category" class="form-label">Категория</label>
                        <select id="category" class="form-select">
                            <option value="design" selected>Дизайн</option>
                            <option value="utility">Утилиты</option>
                            <option value="comfort">Комфорт</option>
                        </select>
                    </div>
                ` : ''}
            </div>
            
            <div class="image-preview mt-3 d-none" id="imagePreview"></div>
        </form>
        
        <div class="mt-3">
            <button class="btn btn-primary" onclick="saveItem()">Сохранить</button>
            <button class="btn btn-secondary" onclick="adminModal.hide()">Отмена</button>
        </div>
    `;
    
    document.getElementById('modalBody').innerHTML = formHtml;
    
    // Добавляем обработчик изменения URL изображения
    const imageInput = document.getElementById('image');
    const imagePreview = document.getElementById('imagePreview');
    
    if (imageInput && imagePreview) {
        imageInput.addEventListener('input', function() {
            if (this.value) {
                imagePreview.innerHTML = `<img src="${this.value}" alt="Preview" class="img-thumbnail">`;
                imagePreview.classList.remove('d-none');
            } else {
                imagePreview.innerHTML = '';
                imagePreview.classList.add('d-none');
            }
        });
    }
    
    adminModal.show();
}

function saveItem() {
    // Получаем данные из формы
    const id = document.getElementById('itemId').value;
    const type = document.getElementById('itemType').value;
    const name = document.getElementById('name').value;
    const description = document.getElementById('description').value;
    const image = document.getElementById('image').value;
    
    // Проверяем обязательные поля
    if (!name) {
        showNotification('Название обязательно для заполнения', 'error');
        return;
    }
    
    // Собираем данные в объект
    const formData = {
        name: name,
        description: description,
        image: image
    };
    
    // Добавляем price или multiplier в зависимости от типа
    if (type === 'floors') {
        const multiplier = document.getElementById('multiplier').value;
        if (!multiplier) {
            showNotification('Множитель обязателен для заполнения', 'error');
            return;
        }
        formData.multiplier = parseFloat(multiplier);
    } else {
        const price = document.getElementById('price').value;
        if (!price) {
            showNotification('Цена обязательна для заполнения', 'error');
            return;
        }
        formData.price = parseFloat(price);
    }
    
    // Добавляем дополнительные поля для электрики
    if (type === 'electrical') {
        formData.sockets = parseInt(document.getElementById('sockets').value) || 0;
        formData.switches = parseInt(document.getElementById('switches').value) || 0;
        formData.lights = parseInt(document.getElementById('lights').value) || 0;
    }
    
    // Добавляем категорию для дополнений
    if (type === 'additions') {
        formData.category = document.getElementById('category').value || 'design';
    }
    
    // Определяем метод и URL в зависимости от наличия id
    const method = id ? 'PUT' : 'POST';
    let apiUrl;
    
    // Используем форму единственного числа для одиночных элементов
    if (id) {
        // При редактировании используем URL с идентификатором
        if (type === 'wall-finishes') {
            apiUrl = `/api/calculator/wall-finish/${id}`;
        } else if (type === 'house-types') {
            apiUrl = `/api/calculator/house-type/${id}`;
        } else {
            // Получаем форму единственного числа для других типов (удаляем 's' в конце)
            const singularType = type.endsWith('s') ? type.slice(0, -1) : type;
            apiUrl = `/api/calculator/${singularType}/${id}`;
        }
    } else {
        // При создании используем URL для создания
        if (type === 'wall-finishes') {
            apiUrl = `/api/calculator/wall-finish`;
        } else if (type === 'house-types') {
            apiUrl = `/api/calculator/house-type`;
        } else {
            // Получаем форму единственного числа для других типов (удаляем 's' в конце)
            const singularType = type.endsWith('s') ? type.slice(0, -1) : type;
            apiUrl = `/api/calculator/${singularType}`;
        }
    }
    
    // Показываем индикатор загрузки
    const modalBody = document.getElementById('modalBody');
    const originalContent = modalBody.innerHTML;
    modalBody.innerHTML += `
        <div class="loading-overlay">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Загрузка...</span>
            </div>
            <div class="mt-2">Сохранение...</div>
        </div>
    `;
    
    // Отправляем запрос на сервер
    fetch(apiUrl, {
        method: method,
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(formData)
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`Ошибка HTTP: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        // Скрываем модальное окно
        adminModal.hide();
        
        // Показываем уведомление об успехе
        showNotification(id ? 'Данные успешно обновлены' : 'Новый элемент успешно создан', 'success');
        
        // Перезагружаем данные
        // Преобразуем тип обратно в camelCase для loadData, если нужно
        let loadType = type;
        if (type === 'wall-finishes') {
            loadType = 'wallFinishes';
        } else if (type === 'house-types') {
            loadType = 'houseTypes';
        }
        
        loadData(loadType);
    })
    .catch(error => {
        console.error('Error saving item:', error);
        
        // Восстанавливаем содержимое модального окна
        modalBody.innerHTML = originalContent;
        
        // Добавляем сообщение об ошибке
        modalBody.innerHTML += `
            <div class="alert alert-danger mt-3">
                Ошибка сохранения: ${error.message}
            </div>
        `;
        
        showNotification('Ошибка сохранения: ' + error.message, 'error');
    });
}

function deleteItem(type, id) {
    if (!confirm('Вы уверены, что хотите удалить этот элемент?')) {
        return;
    }
    
    // Определяем URL для удаления
    let apiUrl;
    
    // Используем форму единственного числа для одиночных элементов
    if (type === 'wall-finishes') {
        apiUrl = `/api/calculator/wall-finish/${id}`;
    } else if (type === 'house-types') {
        apiUrl = `/api/calculator/house-type/${id}`;
    } else {
        // Получаем форму единственного числа для других типов (удаляем 's' в конце)
        const singularType = type.endsWith('s') ? type.slice(0, -1) : type;
        apiUrl = `/api/calculator/${singularType}/${id}`;
    }
    
    // Отправляем запрос на удаление
    fetch(apiUrl, {
        method: 'DELETE',
        headers: {
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`Ошибка HTTP: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        showNotification('Элемент успешно удален', 'success');
        
        // Перезагружаем данные
        // Преобразуем тип обратно в camelCase для loadData, если нужно
        let loadType = type;
        if (type === 'wall-finishes') {
            loadType = 'wallFinishes';
        } else if (type === 'house-types') {
            loadType = 'houseTypes';
        }
        
        loadData(loadType);
    })
    .catch(error => {
        console.error('Error deleting item:', error);
        showNotification('Ошибка удаления: ' + error.message, 'error');
    });
}

/**
 * Показывает модальное окно подтверждения действия
 * @param {string} title - Заголовок модального окна
 * @param {string} message - Сообщение подтверждения
 * @param {function} onConfirm - Функция, которая будет вызвана при подтверждении
 */
function showConfirmationModal(title, message, onConfirm) {
    const modalContent = `
        <div class="confirmation-message">
            <p>${message}</p>
        </div>
        <div class="mt-3">
            <button class="btn btn-danger" id="confirmDeleteBtn">Да, удалить</button>
            <button class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
        </div>
    `;
    
    document.getElementById('modalTitle').textContent = title;
    document.getElementById('modalBody').innerHTML = modalContent;
    
    // Добавляем обработчик для кнопки подтверждения
    document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
        adminModal.hide();
        onConfirm();
    });
    
    adminModal.show();
}
