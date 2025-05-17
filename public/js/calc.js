let currentStep = 1;
const totalSteps = 10;
let currentTotalPrice = 0;


let selections = {
    houseType: null,
    area: null,
    floor: null,
    roof: null,
    material: null,
    foundation: null,
    facade: null,
    electrical: null,
    wallFinish: null,
    additions: [],
    contact: {
        name: '',
        phone: '',
        email: '',
        comment: ''
    }
};

function setDefaultValues() {
    // Устанавливаем дефолтные значения для селекторов
    if (adminData.houseTypes && adminData.houseTypes.length > 0) {
        selections.houseType = adminData.houseTypes[0].id;
    }
    if (adminData.floors && adminData.floors.length > 0) {
        selections.floor = adminData.floors[0].id;
    }
    if (adminData.roofs && adminData.roofs.length > 0) {
        selections.roof = adminData.roofs[0].id;
    }
    if (adminData.materials && adminData.materials.length > 0) {
        selections.material = adminData.materials[0].id;
    }
    if (adminData.foundations && adminData.foundations.length > 0) {
        selections.foundation = adminData.foundations[0].id;
    }
    if (adminData.facades && adminData.facades.length > 0) {
        selections.facade = adminData.facades[0].id;
    }
    if (adminData.electrical && adminData.electrical.length > 0) {
        selections.electrical = adminData.electrical[0].id;
    }
    if (adminData.wallFinishes && adminData.wallFinishes.length > 0) {
        selections.wallFinish = adminData.wallFinishes[0].id;
    }
}

// Загрузка данных из API
function loadAdminData() {
    fetch('/api/calculator-data')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            adminData = data;
            
            // Устанавливаем дефолтные значения
            setDefaultValues();
            
            // Вызов функции отладки
            debugCalculator();
            renderCurrentStep(); // Обновляем текущий шаг после загрузки данных
            
            // Расчет стоимости после загрузки данных
            calculateTotal();
        })
        .catch(error => {
            console.error('Ошибка загрузки данных:', error);
            showNotification('Не удалось загрузить данные калькулятора. Попробуйте перезагрузить страницу.', 'error');
            
            // Пробуем загрузить данные из localStorage в случае ошибки как резервный вариант
            try {
                const savedData = localStorage.getItem('adminData');
                if (savedData) {
                    adminData = JSON.parse(savedData);
                    
                    // Устанавливаем дефолтные значения
                    setDefaultValues();
                    
                    debugCalculator();
                    renderCurrentStep();
                    calculateTotal();
                    
                    showNotification('Данные загружены из локального хранилища', 'info');
                }
            } catch (localError) {
                console.error('Ошибка при загрузке данных из хранилища:', localError);
                showNotification('Ошибка при загрузке данных', 'error');
            }
        });
}


document.addEventListener('DOMContentLoaded', function() {
    initializeCalculator();
    
    // Добавляем отложенный вызов calculateTotal для начального расчета
    setTimeout(() => {
        calculateTotal();
    }, 1000);
    
    const areaInput = document.getElementById('areaInput');
    if (areaInput) {
        areaInput.addEventListener('input', calculateTotal);
    }
});

document.addEventListener('DOMContentLoaded', function() {
    const contactName = document.getElementById('contactName');
    const contactPhone = document.getElementById('contactPhone');
    const contactEmail = document.getElementById('contactEmail');
    const contactComment = document.getElementById('contactComment');
    const phoneInputs = document.querySelectorAll('input[type="tel"]');
    phoneInputs.forEach(input => {
        // Фокус
        input.addEventListener('focus', function(e) {
            if (!e.target.value) {
                e.target.value = '+7 (';
            }
        });

        // Ввод
        input.addEventListener('input', function(e) {
            formatPhoneNumber(e.target);
            // Убираем проверку при вводе
            e.target.classList.remove('invalid');
        });

        // Потеря фокуса
        input.addEventListener('blur', function(e) {
            const digitsOnly = e.target.value.replace(/\D/g, '');
            // Проверяем только если поле не пустое
            if (digitsOnly.length > 0 && digitsOnly.length !== 11) {
                e.target.classList.add('invalid');
                showNotification('Введите номер телефона полностью', 'error');
            } else {
                e.target.classList.remove('invalid');
            }
        });
        
        // Обработка клавиш
        input.addEventListener('keydown', function(e) {
            // Разрешаем: backspace, delete, tab и escape
            if ([8, 9, 27, 46].indexOf(e.keyCode) !== -1 ||
                // Разрешаем: Ctrl+A
                (e.keyCode === 65 && e.ctrlKey === true) ||
                // Разрешаем: home, end, влево, вправо
                (e.keyCode >= 35 && e.keyCode <= 39)) {
                return;
            }
            // Запрещаем все, кроме цифр
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) &&
                (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });
    });

    if (contactName) {
        contactName.addEventListener('input', function(e) {
            const value = e.target.value.trim();
            if (value && !/^[а-яёА-ЯЁa-zA-Z\s-]+$/.test(value)) {
                e.target.classList.add('invalid');
                showNotification('Имя может содержать только буквы, пробелы и дефис', 'error');
            } else {
                e.target.classList.remove('invalid');
            }
        });
    }

    if (contactPhone) {
        contactPhone.addEventListener('input', function(e) {
            const value = e.target.value.trim();
            const phoneRegex = /^(\+7|8)?[\s\-]?\(?[489][0-9]{2}\)?[\s\-]?[0-9]{3}[\s\-]?[0-9]{2}[\s\-]?[0-9]{2}$/;
            if (value && !phoneRegex.test(value)) {
                e.target.classList.add('invalid');
            } else {
                e.target.classList.remove('invalid');
            }
        });
    }

    if (contactEmail) {
        contactEmail.addEventListener('input', function(e) {
            const value = e.target.value.trim();
            const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
            if (value && !emailRegex.test(value)) {
                e.target.classList.add('invalid');
            } else {
                e.target.classList.remove('invalid');
            }
        });
    }

    if (contactComment) {
        contactComment.addEventListener('input', function(e) {
            const value = e.target.value.trim();
            if (value.length > 1000) {
                e.target.classList.add('invalid');
                showNotification('Комментарий не должен превышать 1000 символов', 'error');
            } else {
                e.target.classList.remove('invalid');
            }
        });
    }
});

function formatPhoneNumber(input) {
    let value = input.value.replace(/\D/g, ''); // Оставляем только цифры
    let formattedValue = '';

    if (value.length === 0) {
        formattedValue = '';
    } else {
        // Если первая цифра 7 или 8, убираем её
        if (value[0] === '7' || value[0] === '8') {
            value = value.substring(1);
        }
        value = value.substring(0, 10); // Ограничиваем до 10 цифр

        // Форматируем как +7 (XXX) XXX-XX-XX
        formattedValue = '+7 (';
        if (value.length > 0) {
            formattedValue += value.substring(0, 3);
        }
        if (value.length > 3) {
            formattedValue += ') ' + value.substring(3, 6);
        }
        if (value.length > 6) {
            formattedValue += '-' + value.substring(6, 8);
        }
        if (value.length > 8) {
            formattedValue += '-' + value.substring(8);
        }
    }

    input.value = formattedValue;
}

function validatePhone(phone) {
    const digitsOnly = phone.replace(/\D/g, '');
    // Проверяем, что номер состоит из 11 цифр и начинается с 7 или 8
    return digitsOnly.length === 11 && (digitsOnly[0] === '7' || digitsOnly[0] === '8');
}

window.addEventListener('storage', function(e) {
    if (e.key === 'adminData') {
        loadAdminData();
        renderCurrentStep();
    }
});


function nextStep() {
    if (currentStep < totalSteps) {
        if (validateCurrentStep()) {
            currentStep++;
            updateStepDisplay();
            renderCurrentStep();
            updateNavigationButtons();
            
            // Пересчитываем общую стоимость при переходе на новый шаг
            calculateTotal();
        }
    } else if (currentStep === totalSteps) {
        // Заменяем submitRequest() на submitForm()
        if (validateContactForm()) {
            submitForm();
        }
    }
}

function prevStep() {
    if (currentStep > 1) {
        currentStep--;
        updateStepDisplay();
        renderCurrentStep();
        updateNavigationButtons(); 
    }
}


function validateCurrentStep() {
    switch(currentStep) {
        case 1:
            const areaInput = document.getElementById('areaInput');
            const areaValue = areaInput ? parseFloat(areaInput.value) : 0;
            
            if (!selections.houseType) {
                showNotification('Пожалуйста, выберите тип дома', 'error');
                return false;
            }
            if (!areaValue || areaValue <= 0) {
                showNotification('Пожалуйста, укажите корректную площадь дома', 'error');
                return false;
            }
            selections.area = areaValue;
            break;
        case 2:
            if (!selections.floor) {
                showNotification('Пожалуйста, выберите этажность', 'error');
                return false;
            }
            break;
        case 3:
            if (!selections.roof) {
                showNotification('Пожалуйста, выберите тип крыши', 'error');
                return false;
            }
            break;
        case 4:
            if (!selections.material) {
                showNotification('Пожалуйста, выберите материал', 'error');
                return false;
            }
            break;
        case 5:
            if (!selections.foundation) {
                showNotification('Пожалуйста, выберите тип фундамента', 'error');
                return false;
            }
            break;
        case 6:
            if (!selections.facade) {
                showNotification('Пожалуйста, выберите технологию фасада', 'error');
                return false;
            }
            break;
        case 7:
            if (!selections.electrical) {
                showNotification('Пожалуйста, выберите вариант электрики', 'error'  );
                return false;
            }
            break;
        case 8:
            if (!selections.wallFinish) {
                showNotification('Пожалуйста, выберите отделку стен', 'error');
                return false;
            }
            break;
        case 9:
            
            return true;
        case 10:
            return validateContactForm();
    }
    return true;
}

function validateContactForm() {
    const name = document.getElementById('contactName')?.value.trim();
    const phone = document.getElementById('contactPhone')?.value.trim();
    const email = document.getElementById('contactEmail')?.value.trim();
    const comment = document.getElementById('contactComment')?.value.trim();

    // Валидация имени
    if (!name) {
        showNotification('Пожалуйста, введите ваше имя', 'error');
        return false;
    }
    if (name.length < 2) {
        showNotification('Имя должно содержать минимум 2 символа', 'error');
        return false;
    }
    if (!/^[а-яёА-ЯЁa-zA-Z\s-]+$/.test(name)) {
        showNotification('Имя может содержать только буквы, пробелы и дефис', 'error');
        return false;
    }

    // Валидация телефона
    if (!phone) {
        showNotification('Пожалуйста, введите номер телефона', 'error');
        return false;
    }
    // Формат: +7(XXX)XXX-XX-XX или 8XXXXXXXXXX
    const phoneRegex = /^(\+7|8)?[\s\-]?\(?[489][0-9]{2}\)?[\s\-]?[0-9]{3}[\s\-]?[0-9]{2}[\s\-]?[0-9]{2}$/;
    if (!phoneRegex.test(phone)) {
        showNotification('Пожалуйста, введите корректный номер телефона в формате +7(XXX)XXX-XX-XX или 8XXXXXXXXXX', 'error');
        return false;
    }

    // Валидация email
    if (!email) {
        showNotification('Пожалуйста, введите email', 'error');
        return false;
    }
    const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    if (!emailRegex.test(email)) {
        showNotification('Пожалуйста, введите корректный email адрес', 'error');
        return false;
    }

    // Валидация комментария (необязательное поле)
    if (comment && comment.length > 1000) {
        showNotification('Комментарий не должен превышать 1000 символов', 'error');
        return false;
    }

    // Если все проверки пройдены, сохраняем данные
    selections.contact = {
        name,
        phone,
        email,
        comment
    };

    return true;
}


function updateStepDisplay() {
    document.querySelectorAll('.step-content').forEach(step => {
        step.classList.remove('active');
    });

    const currentStepElement = document.getElementById(`step${currentStep}`);
    if (currentStepElement) {
        currentStepElement.classList.add('active');
    }

    document.querySelectorAll('.step-indicator').forEach((indicator, index) => {
        if (index + 1 < currentStep) {
            indicator.classList.add('completed');
            indicator.classList.remove('active');
        } else if (index + 1 === currentStep) {
            indicator.classList.add('active');
            indicator.classList.remove('completed');
        } else {
            indicator.classList.remove('active', 'completed');
        }
    });

    renderCurrentStep();
}


function renderCurrentStep() {
    // Вызов функции отладки
    debugCalculator();
    
    // Проверяем, загружены ли данные
    if (!adminData) {
        loadAdminData();
        return;
    }

    switch(currentStep) {
        case 1:
            renderHouseTypes();
            break;
        case 2:
            renderFloors();
            break;
        case 3:
            renderRoofs();
            break;
        case 4:
            renderMaterials();
            break;
        case 5:
            renderFoundations();
            break;
        case 6:
            renderFacades();
            break;
        case 7:
            renderElectrical();
            break;
        case 8:
            renderWallFinishes();
            break;
        case 9:
            renderAdditions();
            break;
        case 10:
            renderSummary();
            break;
    }
    updateTotalPrice();
}



function renderHouseTypes() {
    const container = document.getElementById('houseTypesContainer');
    if (!container) {
        console.warn('Контейнер для типов домов не найден');
        return;
    }

    if (!adminData.houseTypes || !Array.isArray(adminData.houseTypes) || adminData.houseTypes.length === 0) {
        console.error('Нет данных о типах домов или данные в неправильном формате', adminData.houseTypes);
        container.innerHTML = '<p class="error-message">Ошибка загрузки данных о типах домов</p>';
        return;
    }

    console.log('Rendering house types:', adminData.houseTypes);

    container.innerHTML = adminData.houseTypes.map(house => {
        const isSelected = parseInt(selections.houseType) === parseInt(house.id);
        return `
            <div class="option-card ${isSelected ? 'selected' : ''}" onclick="selectHouseType(${house.id})">
                <div class="option-image">
                    <img src="${house.image}" alt="${house.name}">
                </div>
                <div class="option-details">
                    <h3>${house.name}</h3>
                    <p>${house.description}</p>
                    <div class="option-price">${parseInt(house.price).toLocaleString()} ₽/м²</div>
                </div>
                <div class="option-selected-indicator"><i class="fas fa-check"></i></div>
            </div>
        `;
    }).join('');

    // Восстанавливаем введенную площадь
    const areaInput = document.getElementById('areaInput');
    if (areaInput) {
        areaInput.value = selections.area || '';
        areaInput.addEventListener('input', function() {
            selections.area = parseFloat(this.value) || 0;
            calculateTotal();
        });
    }
}

function renderAreaStep() {
    const container = document.getElementById('areaContainer');
    console.log('Area container:', container); 

    if (!container) {
        console.error('Area container not found!');
        return;
    }

    container.innerHTML = `
        <div class="area-input-container">
            <label for="areaInput">Введите площадь дома (м²):</label>
            <input type="number" 
                   id="areaInput" 
                   min="1" 
                   step="1"
                   value="${selections.area || ''}" 
                   class="form-input"
                   required>
            <p class="help-text">Минимальная площадь: 1 м²</p>
        </div>
    `;

    const input = document.getElementById('areaInput');
    console.log('Area input:', input); 

    if (input) {
        input.addEventListener('input', function(e) {
            const value = parseFloat(e.target.value);
            console.log('Input value:', value); 
            
            if (!isNaN(value) && value > 0) {
                selections.area = value;
                console.log('Area saved:', selections.area); 
                updateTotalPrice();
            }
        });
    }
}

function renderFloors() {
    const container = document.getElementById('floorsContainer');
    if (!container) {
        console.warn('Контейнер для этажей не найден');
        return;
    }

    if (!adminData.floors || !Array.isArray(adminData.floors) || adminData.floors.length === 0) {
        console.error('Нет данных об этажах или данные в неправильном формате', adminData.floors);
        container.innerHTML = '<p class="error-message">Ошибка загрузки данных об этажах</p>';
        return;
    }

    console.log('Rendering floors:', adminData.floors);

    container.innerHTML = '';
    adminData.floors.forEach(floor => {
        const isSelected = parseInt(selections.floor) === parseInt(floor.id);
        const card = document.createElement('div');
        card.className = `option-card ${isSelected ? 'selected' : ''}`;
        card.setAttribute('data-id', floor.id);
        card.onclick = () => selectFloor(floor.id);
        
        card.innerHTML = `
            <div class="option-image">
                <img src="${floor.image}" alt="${floor.name}">
            </div>
            <div class="option-details">
                <h3>${floor.name}</h3>
                <p>${floor.description}</p>
                <div class="option-price">Коэффициент: ${floor.multiplier}x</div>
            </div>
            <div class="option-selected-indicator"><i class="fas fa-check"></i></div>
        `;
        
        container.appendChild(card);
    });
}

function renderRoofs() {
    const container = document.getElementById('roofsContainer');
    if (!container) {
        console.warn('Контейнер для крыш не найден');
        return;
    }

    if (!adminData.roofs || !Array.isArray(adminData.roofs) || adminData.roofs.length === 0) {
        console.error('Нет данных о крышах или данные в неправильном формате', adminData.roofs);
        container.innerHTML = '<p class="error-message">Ошибка загрузки данных о крышах</p>';
        return;
    }

    console.log('Rendering roofs:', adminData.roofs);

    container.innerHTML = adminData.roofs.map(roof => {
        const isSelected = parseInt(selections.roof) === parseInt(roof.id);
        return `
            <div class="option-card ${isSelected ? 'selected' : ''}" onclick="selectRoof(${roof.id})">
                <div class="option-image">
                    <img src="${roof.image || 'img/image_placeholder.png'}" alt="${roof.name}">
                </div>
                <div class="option-details">
                    <h3>${roof.name}</h3>
                    <p>${roof.description || ''}</p>
                    <div class="option-price">${parseInt(roof.price).toLocaleString()} ₽</div>
                </div>
                <div class="option-selected-indicator"><i class="fas fa-check"></i></div>
            </div>
        `;
    }).join('');
}

function renderMaterials() {
    const container = document.getElementById('materialsContainer');
    if (!container) {
        console.warn('Контейнер для материалов не найден');
        return;
    }

    if (!adminData.materials || !Array.isArray(adminData.materials) || adminData.materials.length === 0) {
        console.error('Нет данных о материалах или данные в неправильном формате', adminData.materials);
        container.innerHTML = '<p class="error-message">Ошибка загрузки данных о материалах</p>';
        return;
    }

    console.log('Rendering materials:', adminData.materials);

    container.innerHTML = adminData.materials.map(material => {
        const isSelected = parseInt(selections.material) === parseInt(material.id);
        return `
            <div class="option-card ${isSelected ? 'selected' : ''}" onclick="selectMaterial(${material.id})">
                <div class="option-image">
                    <img src="${material.image || 'img/image_placeholder.png'}" alt="${material.name}">
                </div>
                <div class="option-details">
                    <h3>${material.name}</h3>
                    <p>${material.description || ''}</p>
                    <div class="option-price">${parseInt(material.price).toLocaleString()} ₽/м²</div>
                </div>
                <div class="option-selected-indicator"><i class="fas fa-check"></i></div>
            </div>
        `;
    }).join('');
}

function renderFoundations() {
    console.log('Starting renderFoundations'); 
    
    const container = document.getElementById('foundationsContainer');
    console.log('Container:', container); 
    
    if (!container) {
        console.error('Foundations container not found');
        return;
    }

    if (!adminData.foundations || !Array.isArray(adminData.foundations)) {
        console.error('Foundations data is invalid:', adminData.foundations);
        return;
    }

    console.log('Foundations data:', adminData.foundations); 

    const html = adminData.foundations.map(foundation => `
        <div class="option-card ${selections.foundation === foundation.id ? 'selected' : ''}"
             onclick="selectFoundation(${foundation.id})">
            <div class="option-image">
                <img src="${foundation.image || 'img/image_placeholder.png'}" 
                     alt="${foundation.name}"
                     onerror="this.src='img/image_placeholder.png'">
            </div>
            <div class="option-info">
                <h3>${foundation.name}</h3>
                <p class="price">Стоимость: ${foundation.price.toLocaleString()} ₽/м²</p>
                <p class="description">${foundation.description || ''}</p>
            </div>
        </div>
    `).join('');

    console.log('Generated HTML:', html); 
    container.innerHTML = html;
}

function renderFacades() {
    const container = document.getElementById('facadesContainer');
    if (!container) {
        showNotification('Контейнер для фасадов не найден', 'error');
        return;
    }

    if (!adminData.facades || !Array.isArray(adminData.facades) || adminData.facades.length === 0) {
        showNotification('Нет данных о фасадах', 'error');
        container.innerHTML = '<p class="error-message">Ошибка загрузки данных о фасадах</p>';
        return;
    }

    container.innerHTML = adminData.facades.map(facade => {
        const isSelected = parseInt(selections.facade) === parseInt(facade.id);
        return `
            <div class="option-card ${isSelected ? 'selected' : ''}" onclick="selectFacade(${facade.id})">
                <div class="option-image">
                    <img src="${facade.image || 'img/image_placeholder.png'}" alt="${facade.name}">
                </div>
                <div class="option-details">
                    <h3>${facade.name}</h3>
                    <p>${facade.description || ''}</p>
                    <div class="option-price">${parseInt(facade.price).toLocaleString()} ₽/м²</div>
                </div>
                <div class="option-selected-indicator"><i class="fas fa-check"></i></div>
            </div>
        `;
    }).join('');
}

function renderElectrical() {
    const container = document.getElementById('electricalContainer');
    if (!container) {
        showNotification('Контейнер для электрики не найден', 'error');
        return;
    }

    if (!adminData.electrical || !Array.isArray(adminData.electrical) || adminData.electrical.length === 0) {
        showNotification('Нет данных об электрике', 'error');
        container.innerHTML = '<p class="error-message">Ошибка загрузки данных об электрике</p>';
        return;
    }

    // Удаляем дубликаты по имени (берем только первый вариант для каждого имени)
    const seen = new Set();
    const uniqueElectricalOptions = adminData.electrical.filter(item => {
        if (seen.has(item.name)) {
            return false;
        }
        seen.add(item.name);
        return true;
    });

    container.innerHTML = uniqueElectricalOptions.map(item => {
        const isSelected = parseInt(selections.electrical) === parseInt(item.id);
        
        // Проверяем и формируем путь к изображению
        const imagePath = item.image || '/img/electrical/basic.jpg';
        
        return `
            <div class="option-card ${isSelected ? 'selected' : ''}" onclick="selectElectrical(${item.id})">
                <div class="option-image">
                    <img src="${imagePath}" 
                         alt="${item.name}" 
                         onerror="this.src='/img/electrical/basic.jpg'; this.onerror=null;">
                </div>
                <div class="option-details">
                    <h3>${item.name}</h3>
                    <p>${item.description || 'Электрические точки и проводка'}</p>
                    <ul class="electrical-specs">
                        <li>Розетки: ${parseInt(item.sockets) || 0} шт.</li>
                        <li>Выключатели: ${parseInt(item.switches) || 0} шт.</li>
                        <li>Светильники: ${parseInt(item.lights) || 0} шт.</li>
                    </ul>
                    <div class="option-price">${parseInt(item.price).toLocaleString()} ₽/точка</div>
                    <div class="option-total-price">Всего точек: ${(parseInt(item.sockets) + parseInt(item.switches) + parseInt(item.lights))} шт.</div>
                    <div class="option-total-price">Общая стоимость: ${parseInt(item.price * (parseInt(item.sockets) + parseInt(item.switches) + parseInt(item.lights))).toLocaleString()} ₽</div>
                </div>
                <div class="option-selected-indicator"><i class="fas fa-check"></i></div>
            </div>
        `;
    }).join('');
}

function renderWallFinishes() {
    const container = document.getElementById('wallFinishesContainer');
    if (!container) {
        console.warn('Контейнер для отделок стен не найден');
        return;
    }

    if (!adminData.wallFinishes || !Array.isArray(adminData.wallFinishes) || adminData.wallFinishes.length === 0) {
        console.error('Нет данных об отделках стен или данные в неправильном формате', adminData.wallFinishes);
        container.innerHTML = '<p class="error-message">Ошибка загрузки данных об отделках стен</p>';
        return;
    }

    console.log('Rendering wall finishes:', adminData.wallFinishes);

    container.innerHTML = adminData.wallFinishes.map(finish => {
        const isSelected = parseInt(selections.wallFinish) === parseInt(finish.id);
        return `
            <div class="option-card ${isSelected ? 'selected' : ''}" onclick="selectWallFinish(${finish.id})">
                <div class="option-image">
                    <img src="${finish.image || 'img/image_placeholder.png'}" alt="${finish.name}">
                </div>
                <div class="option-details">
                    <h3>${finish.name}</h3>
                    <p>${finish.description || ''}</p>
                    <div class="option-price">${parseInt(finish.price).toLocaleString()} ₽/м²</div>
                </div>
                <div class="option-selected-indicator"><i class="fas fa-check"></i></div>
            </div>
        `;
    }).join('');
}

function renderAdditions() {
    const container = document.getElementById('additionsContainer');
    if (!container) {
        console.warn('Контейнер для дополнений не найден');
        return;
    }

    if (!adminData.additions || !Array.isArray(adminData.additions) || adminData.additions.length === 0) {
        console.error('Нет данных о дополнениях или данные в неправильном формате', adminData.additions);
        container.innerHTML = '<p class="error-message">Ошибка загрузки данных о дополнениях</p>';
        return;
    }

    console.log('Rendering additions:', adminData.additions);

    container.innerHTML = adminData.additions.map(addition => {
        const isSelected = selections.additions.includes(addition.id);
        return `
            <div class="option-card ${isSelected ? 'selected' : ''}" onclick="toggleAddition(${addition.id})">
                <div class="option-image">
                    <img src="${addition.image || 'img/image_placeholder.png'}" alt="${addition.name}">
                </div>
                <div class="option-details">
                    <h3>${addition.name}</h3>
                    <p>${addition.description || ''}</p>
                    <div class="option-price">${parseInt(addition.price).toLocaleString()} ₽ ${addition.perMeter ? '/м²' : ''}</div>
                </div>
                <div class="option-selected-indicator"><i class="fas fa-check"></i></div>
            </div>
        `;
    }).join('');
}


function renderSummary() {
    
    document.getElementById('summaryHouseType').textContent = getSelectedName(adminData.houseTypes, selections.houseType);
    document.getElementById('summaryArea').textContent = selections.area ? `${selections.area} м²` : '-';
    document.getElementById('summaryFloors').textContent = getSelectedName(adminData.floors, selections.floor);
    document.getElementById('summaryRoof').textContent = getSelectedName(adminData.roofs, selections.roof);
    document.getElementById('summaryMaterial').textContent = getSelectedName(adminData.materials, selections.material);
    document.getElementById('summaryFoundation').textContent = getSelectedName(adminData.foundations, selections.foundation);
    document.getElementById('summaryFacade').textContent = getSelectedName(adminData.facades, selections.facade);
    
    // Обновленный блок отображения электрики с проверкой типов
    const electricalSummaryElement = document.getElementById('summaryElectrical');
    if (selections.electrical && adminData.electrical) {
        const electrical = adminData.electrical.find(e => parseInt(e.id) === parseInt(selections.electrical));
        if (electrical) {
            // Преобразуем все значения в числа
            const sockets = parseInt(electrical.sockets) || 0;
            const switches = parseInt(electrical.switches) || 0;
            const lights = parseInt(electrical.lights) || 0;
            const pricePerPoint = parseFloat(electrical.price) || 0;
            
            const totalPoints = sockets + switches + lights;
            const totalElectricalPrice = pricePerPoint * totalPoints;
            
            electricalSummaryElement.innerHTML = `${electrical.name} <br>
                <small>(Розетки: ${sockets} шт., Выключатели: ${switches} шт., Светильники: ${lights} шт.)<br>
                Всего точек: ${totalPoints} шт. - ${Math.round(totalElectricalPrice).toLocaleString()} ₽</small>`;
        } else {
            electricalSummaryElement.textContent = '-';
        }
    } else {
        electricalSummaryElement.textContent = '-';
    }
    
    document.getElementById('summaryWallFinish').textContent = getSelectedName(adminData.wallFinishes, selections.wallFinish);
    
    const additionsText = selections.additions.length > 0 
        ? selections.additions.map(id => getSelectedName(adminData.additions, id)).join(', ')
        : '-';
    document.getElementById('summaryAdditions').textContent = additionsText;

    // Обновляем итоговую стоимость напрямую
    const summaryPriceElement = document.getElementById('summaryPrice');
    if (summaryPriceElement) {
        // Проверяем, что currentTotalPrice - число
        const displayPrice = !isNaN(currentTotalPrice) ? currentTotalPrice : 0;
        summaryPriceElement.textContent = displayPrice.toLocaleString() + ' ₽';
    } else {
        showNotification('Элемент для отображения цены не найден', 'error');
    }
}


function selectHouseType(id) {
    selections.houseType = id;
    
    // Обновляем классы выбора
    document.querySelectorAll('#houseTypesContainer .option-card').forEach(card => {
        let cardId;
        const onclickAttr = card.getAttribute('onclick');
        
        if (onclickAttr) {
            const matches = onclickAttr.match(/\d+/);
            cardId = matches ? parseInt(matches[0]) : null;
        } else {
            // Альтернативный способ получения ID
            cardId = card.dataset.id ? parseInt(card.dataset.id) : null;
        }
        
        if (cardId === id) {
            card.classList.add('selected');
        } else {
            card.classList.remove('selected');
        }
    });
    
    updateTotalPrice();
    // Вызов функции отладки
    debugCalculator();
}

function updateNavigationButtons() {
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');

    
    if (prevBtn) {
        if (currentStep === 1) {
            prevBtn.disabled = true;
        } else {
            prevBtn.disabled = false;
        }
    }

    
    if (nextBtn) {
        if (currentStep === totalSteps) {
            nextBtn.textContent = 'Отправить';
            nextBtn.classList.add('submit-btn'); 
        } else {
            nextBtn.textContent = 'Далее';
            nextBtn.classList.remove('submit-btn');
        }
    }

    
    document.querySelectorAll('.step-indicator').forEach((indicator, index) => {
        if (index + 1 === currentStep) {
            indicator.classList.add('active');
        } else {
            indicator.classList.remove('active');
        }
    });
}

function initializeCalculator() {
    loadAdminData();
    setDefaultValues();
    
    const areaInput = document.getElementById('areaInput');
    if (areaInput) {
        areaInput.addEventListener('input', calculateTotal);
    }

    renderCurrentStep();
    updateStepDisplay();
    updateNavigationButtons();
}

function selectFloor(id) {
    selections.floor = id;
    
    // Добавляем код для визуального отображения выбора
    document.querySelectorAll('#floorsContainer .option-card').forEach(card => {
        let cardId;
        const onclickAttr = card.getAttribute('onclick');
        
        if (onclickAttr) {
            const matches = onclickAttr.match(/\d+/);
            cardId = matches ? parseInt(matches[0]) : null;
        } else {
            // Альтернативный способ получения ID
            cardId = card.dataset.id ? parseInt(card.dataset.id) : null;
        }
        
        if (cardId === id) {
            card.classList.add('selected');
        } else {
            card.classList.remove('selected');
        }
    });
    
    updateTotalPrice();
    debugCalculator();
}

function selectRoof(id) {
    selections.roof = id;
    
    // Добавляем код для визуального отображения выбора
    document.querySelectorAll('#roofsContainer .option-card').forEach(card => {
        let cardId;
        const onclickAttr = card.getAttribute('onclick');
        
        if (onclickAttr) {
            const matches = onclickAttr.match(/\d+/);
            cardId = matches ? parseInt(matches[0]) : null;
        } else {
            // Альтернативный способ получения ID
            cardId = card.dataset.id ? parseInt(card.dataset.id) : null;
        }
        
        if (cardId === id) {
            card.classList.add('selected');
        } else {
            card.classList.remove('selected');
        }
    });
    
    updateTotalPrice();
    debugCalculator();
}

function selectMaterial(id) {
    selections.material = id;
    
    // Добавляем код для визуального отображения выбора
    document.querySelectorAll('#materialsContainer .option-card').forEach(card => {
        let cardId;
        const onclickAttr = card.getAttribute('onclick');
        
        if (onclickAttr) {
            const matches = onclickAttr.match(/\d+/);
            cardId = matches ? parseInt(matches[0]) : null;
        } else {
            // Альтернативный способ получения ID
            cardId = card.dataset.id ? parseInt(card.dataset.id) : null;
        }
        
        if (cardId === id) {
            card.classList.add('selected');
        } else {
            card.classList.remove('selected');
        }
    });
    
    updateTotalPrice();
    debugCalculator();
}

function selectFoundation(id) {
    selections.foundation = id;
    
    // Добавляем код для визуального отображения выбора
    document.querySelectorAll('#foundationsContainer .option-card').forEach(card => {
        let cardId;
        const onclickAttr = card.getAttribute('onclick');
        
        if (onclickAttr) {
            const matches = onclickAttr.match(/\d+/);
            cardId = matches ? parseInt(matches[0]) : null;
        } else {
            // Альтернативный способ получения ID
            cardId = card.dataset.id ? parseInt(card.dataset.id) : null;
        }
        
        if (cardId === id) {
            card.classList.add('selected');
        } else {
            card.classList.remove('selected');
        }
    });
    
    updateTotalPrice();
    debugCalculator();
}

function selectFacade(id) {
    selections.facade = id;
    
    // Добавляем код для визуального отображения выбора
    document.querySelectorAll('#facadesContainer .option-card').forEach(card => {
        let cardId;
        const onclickAttr = card.getAttribute('onclick');
        
        if (onclickAttr) {
            const matches = onclickAttr.match(/\d+/);
            cardId = matches ? parseInt(matches[0]) : null;
        } else {
            // Альтернативный способ получения ID
            cardId = card.dataset.id ? parseInt(card.dataset.id) : null;
        }
        
        if (cardId === id) {
            card.classList.add('selected');
        } else {
            card.classList.remove('selected');
        }
    });
    
    updateTotalPrice();
    debugCalculator();
}

function selectElectrical(id) {
    selections.electrical = id;
    
    // Добавляем код для визуального отображения выбора
    document.querySelectorAll('#electricalContainer .option-card').forEach(card => {
        let cardId;
        const onclickAttr = card.getAttribute('onclick');
        
        if (onclickAttr) {
            const matches = onclickAttr.match(/\d+/);
            cardId = matches ? parseInt(matches[0]) : null;
        } else {
            // Альтернативный способ получения ID
            cardId = card.dataset.id ? parseInt(card.dataset.id) : null;
        }
        
        if (cardId === id) {
            card.classList.add('selected');
        } else {
            card.classList.remove('selected');
        }
    });
    
    updateTotalPrice();
    debugCalculator();
}

function selectWallFinish(id) {
    selections.wallFinish = id;
    
    // Добавляем код для визуального отображения выбора
    document.querySelectorAll('#wallFinishesContainer .option-card').forEach(card => {
        let cardId;
        const onclickAttr = card.getAttribute('onclick');
        
        if (onclickAttr) {
            const matches = onclickAttr.match(/\d+/);
            cardId = matches ? parseInt(matches[0]) : null;
        } else {
            // Альтернативный способ получения ID
            cardId = card.dataset.id ? parseInt(card.dataset.id) : null;
        }
        
        if (cardId === id) {
            card.classList.add('selected');
        } else {
            card.classList.remove('selected');
        }
    });
    
    updateTotalPrice();
    debugCalculator();
}

function toggleAddition(id) {
    const index = selections.additions.indexOf(id);
    if (index === -1) {
        selections.additions.push(id);
    } else {
        selections.additions.splice(index, 1);
    }
    
    // Обновляем визуальное отображение
    document.querySelectorAll('#additionsContainer .option-card').forEach(card => {
        let cardId;
        const onclickAttr = card.getAttribute('onclick');
        
        if (onclickAttr) {
            const matches = onclickAttr.match(/\d+/);
            cardId = matches ? parseInt(matches[0]) : null;
        } else {
            // Альтернативный способ получения ID
            cardId = card.dataset.id ? parseInt(card.dataset.id) : null;
        }
        
        if (cardId === id) {
            card.classList.toggle('selected', selections.additions.includes(id));
        }
    });
    
    updateTotalPrice();
    debugCalculator();
}




function updateTotalPrice() {
    calculateTotal();
    if (currentStep === totalSteps) {
        renderSummary();
    }
}


function submitForm() {
    try {
        // Проверяем, что все поля заполнены корректно
        if (!validateContactForm()) {
            return false;
        }

        // Создаем объект данных для отправки
        const requestData = {
            houseType: selections.houseType,
            area: selections.area,
            floor: selections.floor,
            roof: selections.roof,
            material: selections.material,
            foundation: selections.foundation,
            facade: selections.facade,
            electrical: selections.electrical,
            wallFinish: selections.wallFinish,
            additions: selections.additions,
            name: document.getElementById('contactName').value.trim(),
            phone: document.getElementById('contactPhone').value.trim(),
            email: document.getElementById('contactEmail').value.trim(),
            comment: document.getElementById('contactComment')?.value.trim() || '',
            totalPrice: currentTotalPrice
        };

        // Показываем индикатор загрузки
        showNotification('Отправка заявки...', 'info');

        // Отправка данных на сервер
        fetch('/api/requests', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
            },
            body: JSON.stringify(requestData)
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Ошибка при отправке заявки');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                // Показываем уведомление об успехе
                showNotification('Ваша заявка успешно отправлена! Мы свяжемся с вами в ближайшее время.', 'success');
                
                // Сбрасываем калькулятор и возвращаемся на первый шаг через 2 секунды
                setTimeout(() => {
                    // Сбрасываем форму
                    document.getElementById('contactName').value = '';
                    document.getElementById('contactPhone').value = '';
                    document.getElementById('contactEmail').value = '';
                    if (document.getElementById('contactComment')) {
                        document.getElementById('contactComment').value = '';
                    }
                    
                    // Сбрасываем калькулятор
                    resetCalculator();
                    
                    // Возвращаемся на первый шаг
                    currentStep = 1;
                    updateStepDisplay();
                    renderCurrentStep();
                }, 2000);
            } else {
                throw new Error(data.message || 'Ошибка при сохранении заявки');
            }
        })
        .catch(error => {
            console.error('Ошибка:', error);
            showNotification('Произошла ошибка при отправке заявки. Пожалуйста, попробуйте еще раз.', 'error');
            
            // Резервный вариант - сохранение в localStorage, если сервер недоступен
            try {
                const backupRequest = {
                    id: Date.now(),
                    date: new Date().toISOString(),
                    status: 'new',
                    type: 'calculator',
                    ...requestData
                };
                
                // Получаем существующие данные
                let savedAdminData = JSON.parse(localStorage.getItem('adminData') || '{"requests":[]}');
                if (!savedAdminData.requests) {
                    savedAdminData.requests = [];
                }
                
                // Добавляем новый запрос
                savedAdminData.requests.push(backupRequest);
                
                // Сохраняем обновленные данные
                localStorage.setItem('adminData', JSON.stringify(savedAdminData));
                
                showNotification('Заявка сохранена локально и будет отправлена позже.', 'info');
            } catch (localError) {
                console.error('Ошибка локального сохранения:', localError);
            }
        });
        
        return true;
    } catch (error) {
        console.error('Критическая ошибка:', error);
        showNotification('Произошла ошибка при обработке заявки. Пожалуйста, попробуйте еще раз.', 'error');
        return false;
    }
}

function resetCalculator() {
    currentStep = 1;
    selections = {
        houseType: null,
        area: null,
        floor: null,
        roof: null,
        material: null,
        foundation: null,
        facade: null,
        electrical: null,
        wallFinish: null,
        additions: [],
        contact: {
            name: '',
            phone: '',
            email: '',
            comment: ''
        }
    };
    
    updateStepDisplay();
    renderCurrentStep();
    updateNavigationButtons();
}


function setArea(value) {
    const numValue = parseFloat(value);
    if (!isNaN(numValue) && numValue > 0) {
        selections.area = numValue;
        updateTotalPrice();
    }
}


let selectedHouseType = null;
let selectedFloor = null;
let selectedRoof = null;
let selectedMaterial = null;
let selectedFoundation = null;
let selectedFacade = null;
let selectedElectrical = null;
let selectedWallFinish = null;
let selectedAdditions = [];
let currentHousePrice = 0;
let currentArea = 0;

function calculateTotal() {
    try {
        // Получаем площадь
        const areaInput = document.getElementById('areaInput');
        const areaValue = areaInput ? parseFloat(areaInput.value) : 0;

        if (!areaValue || isNaN(areaValue)) {
            currentTotalPrice = 0;
            updatePriceDisplay(0);
            return;
        }

        // Начинаем с нуля
        let totalPrice = 0;

        // Расчет стоимости типа дома
        if (selections.houseType && adminData.houseTypes) {
            const houseType = adminData.houseTypes.find(h => parseInt(h.id) === parseInt(selections.houseType));
            if (houseType) {
                const housePrice = parseFloat(houseType.price) || 0;
                totalPrice = housePrice * areaValue;
            }
        }

        // Расчет стоимости этажности
        if (selections.floor && adminData.floors) {
            const floor = adminData.floors.find(f => parseInt(f.id) === parseInt(selections.floor));
            if (floor && floor.multiplier) {
                const multiplier = parseFloat(floor.multiplier) || 1;
                totalPrice *= multiplier;
            }
        }

        // Расчет стоимости крыши
        if (selections.roof && adminData.roofs) {
            const roof = adminData.roofs.find(r => parseInt(r.id) === parseInt(selections.roof));
            if (roof) {
                const roofPrice = parseFloat(roof.price) || 0;
                totalPrice += roofPrice;
            }
        }

        // Расчет стоимости материала
        if (selections.material && adminData.materials) {
            const material = adminData.materials.find(m => parseInt(m.id) === parseInt(selections.material));
            if (material) {
                const materialPrice = parseFloat(material.price) || 0;
                totalPrice += materialPrice * areaValue;
            }
        }

        // Расчет стоимости фундамента
        if (selections.foundation && adminData.foundations) {
            const foundation = adminData.foundations.find(f => parseInt(f.id) === parseInt(selections.foundation));
            if (foundation) {
                const foundationPrice = parseFloat(foundation.price) || 0;
                totalPrice += foundationPrice * areaValue;
            }
        }

        // Расчет стоимости фасада
        if (selections.facade && adminData.facades) {
            const facade = adminData.facades.find(f => parseInt(f.id) === parseInt(selections.facade));
            if (facade) {
                const facadePrice = parseFloat(facade.price) || 0;
                totalPrice += facadePrice * areaValue;
            }
        }

        // Расчет стоимости электрики
        if (selections.electrical && adminData.electrical) {
            const electrical = adminData.electrical.find(e => parseInt(e.id) === parseInt(selections.electrical));
            if (electrical) {
                // Преобразуем все значения в числа
                const sockets = parseInt(electrical.sockets) || 0;
                const switches = parseInt(electrical.switches) || 0;
                const lights = parseInt(electrical.lights) || 0;
                const pricePerPoint = parseFloat(electrical.price) || 0;
                
                const totalPoints = sockets + switches + lights;
                const addedPrice = pricePerPoint * totalPoints;
                
                if (!isNaN(addedPrice)) {
                    totalPrice += addedPrice;
                }
            }
        }

        // Расчет стоимости отделки стен
        if (selections.wallFinish && adminData.wallFinishes) {
            const wallFinish = adminData.wallFinishes.find(w => parseInt(w.id) === parseInt(selections.wallFinish));
            if (wallFinish) {
                const wallFinishPrice = parseFloat(wallFinish.price) || 0;
                // Подсчет площади стен
                const wallHeight = 2.7; // стандартная высота потолков
                const perimeter = Math.ceil(Math.sqrt(areaValue) * 4);
                let floors = 1;
                
                // Получаем количество этажей из выбранного значения
                if (selections.floor && adminData.floors) {
                    const floorObj = adminData.floors.find(f => parseInt(f.id) === parseInt(selections.floor));
                    if (floorObj && floorObj.value) {
                        floors = parseInt(floorObj.value) || 1;
                    }
                }
                
                const wallArea = perimeter * wallHeight * floors;
                const addedPrice = wallFinishPrice * wallArea;
                
                if (!isNaN(addedPrice)) {
                    totalPrice += addedPrice;
                }
            }
        }

        // Расчет стоимости дополнений
        if (selections.additions && adminData.additions) {
            selections.additions.forEach(additionId => {
                const addition = adminData.additions.find(a => parseInt(a.id) === parseInt(additionId));
                if (addition) {
                    const additionPrice = parseFloat(addition.price) || 0;
                    let addedPrice = 0;
                    
                    if (addition.perMeter) {
                        addedPrice = additionPrice * areaValue;
                    } else {
                        addedPrice = additionPrice;
                    }
                    
                    if (!isNaN(addedPrice)) {
                        totalPrice += addedPrice;
                    }
                }
            });
        }
        
        // Проверяем финальную цену
        if (isNaN(totalPrice)) {
            totalPrice = 0;
        }
        
        // Округляем до целого числа
        totalPrice = Math.round(totalPrice);
        
        currentTotalPrice = totalPrice;
        updatePriceDisplay(totalPrice);

    } catch (error) {
        currentTotalPrice = 0;
        updatePriceDisplay(0);
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const areaInput = document.getElementById('areaInput');
    if (areaInput) {
        areaInput.addEventListener('input', calculateTotal);
    }
});

function updateAreaDisplay() {
    const areaDisplay = document.getElementById('area_params');
    
    if (areaDisplay) {
        areaDisplay.textContent = `Площадь дома: ${currentArea.toFixed(1)} м²`;
    }
}
function updateAreaDisplay() {
    const areaDisplay = document.getElementById('area_params');
    const perimeterDisplay = document.getElementById('perimetr_params');
    
    if (areaDisplay) {
        areaDisplay.textContent = `Площадь дома: ${currentArea.toFixed(1)} м²`;
    }
    
    if (perimeterDisplay) {
        const width = parseFloat(document.getElementById('width')?.value) || 0;
        const length = parseFloat(document.getElementById('length')?.value) || 0;
        const perimeter = 2 * (width + length);
        perimeterDisplay.textContent = `Периметр дома: ${perimeter.toFixed(1)} м`;
    }
}


document.getElementById('width')?.addEventListener('input', calculateTotal);
document.getElementById('length')?.addEventListener('input', calculateTotal);



function submitRequest() {
    
    selections.contact = {
        name: document.getElementById('contactName').value,
        phone: document.getElementById('contactPhone').value,
        email: document.getElementById('contactEmail').value,
        comment: document.getElementById('contactComment').value
    };

    if (!validateContactForm()) return;

    
    const request = {
        id: Date.now(),
        date: new Date().toISOString(),
        status: 'new',
        type: 'calculator', 
        name: selections.contact.name,
        phone: selections.contact.phone,
        email: selections.contact.email,
        comment: selections.contact.comment,
        
        selections: {
            houseType: getSelectedName(adminData.houseTypes, selections.houseType),
            area: selections.area,
            floor: getSelectedName(adminData.floors, selections.floor),
            roof: getSelectedName(adminData.roofs, selections.roof),
            material: getSelectedName(adminData.materials, selections.material),
            foundation: getSelectedName(adminData.foundations, selections.foundation),
            facade: getSelectedName(adminData.facades, selections.facade),
            electrical: getSelectedElectricalDetails(adminData.electrical, selections.electrical),
            wallFinish: getSelectedName(adminData.wallFinishes, selections.wallFinish),
            additions: selections.additions.map(id => 
                getSelectedName(adminData.additions, id)
            )
        },
    };

    console.log('Sending request:', request); 

    try {
        
        const savedData = JSON.parse(localStorage.getItem('adminData') || '{}');
        if (!savedData.requests) savedData.requests = [];
        
        
        savedData.requests.push(request);
        
        
        localStorage.setItem('adminData', JSON.stringify(savedData));

        showNotification('Ваша заявка успешно отправлена! Мы свяжемся с вами в ближайшее время.', 'success');
        resetCalculator();
    } catch (error) {
        console.error('Error saving request:', error);
        showNotification('Произошла ошибка при сохранении заявки. Пожалуйста, попробуйте еще раз.', 'error');
    }
}

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
    }
}

function getSelectedName(array, id) {
    if (!array || !id) return '-';
    const item = Array.isArray(array) ? array.find(i => parseInt(i.id) === parseInt(id)) : null;
    return item ? item.name : '-';
}

function getSelectedElectricalDetails(array, id) {
    if (!array || !id) return '-';
    const item = Array.isArray(array) ? array.find(i => parseInt(i.id) === parseInt(id)) : null;
    if (!item) return '-';
    
    // Преобразуем все значения в числа
    const sockets = parseInt(item.sockets) || 0;
    const switches = parseInt(item.switches) || 0;
    const lights = parseInt(item.lights) || 0;
    const pricePerPoint = parseFloat(item.price) || 0;
    
    const totalPoints = sockets + switches + lights;
    const totalPrice = pricePerPoint * totalPoints;
    
    return {
        name: item.name,
        sockets: sockets,
        switches: switches,
        lights: lights,
        totalPoints: totalPoints,
        pricePerPoint: pricePerPoint,
        totalPrice: totalPrice
    };
}

function updatePriceDisplay(price) {
    // Убеждаемся, что цена - валидное число
    if (isNaN(price)) {
        price = 0;
    }
    
    const priceDisplay = document.getElementById('summaryPrice');
    if (priceDisplay) {
        priceDisplay.textContent = price.toLocaleString() + ' ₽';
    }
}

// Упрощенная версия для отладки
function debugCalculator() {
    return true;
}