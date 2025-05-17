<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Калькулятор стоимости дома</title>
    <script src="js/calc.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Questrial&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <header class="main-section header">
        <a href="{{ url('/') }}"><img class="logo" src="icons/logo.svg" alt="Логотип"></a>
        <div class="nav-menu">
            <nav>
                <a class="nav-menu__item" href="{{ url('/') }}">ГЛАВНАЯ</a>
                <a class="nav-menu__item" href="{{ url('/calc') }}">КАЛЬКУЛЯТОР</a>
                <a class="nav-menu__item" href="{{ url('/reviews') }}">ОТЗЫВЫ</a>
                <a class="nav-menu__item" href="{{ url('/galery') }}">ГАЛЕРЕЯ</a>
                <a class="nav-menu__item" href="{{ url('/contacts') }}">КОНТАКТЫ</a>
            </nav>
        </div>
    </header>
    <div class="calculator">
        <!-- Индикатор шагов -->
        <div class="steps-indicator">
            <div class="step-indicator active" data-step="1">1</div>
            <div class="step-indicator" data-step="2">2</div>
            <div class="step-indicator" data-step="3">3</div>
            <div class="step-indicator" data-step="4">4</div>
            <div class="step-indicator" data-step="5">5</div>
            <div class="step-indicator" data-step="6">6</div>
            <div class="step-indicator" data-step="7">7</div>
            <div class="step-indicator" data-step="8">8</div>
            <div class="step-indicator" data-step="9">9</div>
            <div class="step-indicator" data-step="10">10</div>
        </div>


        <!-- Шаг 1: Тип дома и площадь -->
        <div class="step-content active" id="step1">
            <h2 class="step-title">Выберите тип дома и укажите площадь</h2>
            <div id="houseTypesContainer" class="options-container"></div>
            <div class="area-input-container">
                <label for="areaInput">Введите площадь дома (м²):</label>
                <input type="number" 
                       id="areaInput" 
                       min="1" 
                       step="1"
                       value="${selections.area || ''}" 
                       class="form-input"
                       required>
                <p class="help-text">Минимальная площадь: 10 м²</p>
            </div>
        </div>

        <!-- Шаг 2: Этажность -->
        <div class="step-content" id="step2">
            <h2 class="step-title">Выберите этажность</h2>
            <div id="floorsContainer" class="options-container"></div>
        </div>

        <!-- Шаг 3: Крыша -->
        <div class="step-content" id="step3">
            <h2 class="step-title">Выберите тип крыши</h2>
            <div id="roofsContainer" class="options-container"></div>
        </div>

        <!-- Шаг 4: Материалы -->
        <div class="step-content" id="step4">
            <h2 class="step-title">Выберите материал стен</h2>
            <div id="materialsContainer" class="options-container"></div>
        </div>

        <!-- Шаг 5: Дополнительные опции -->
        <div class="step-content" id="step5">
            <h2 class="step-title">Выберите тип фундамента</h2>
            <div id="foundationsContainer" class="options-container"></div>
        </div>

        <!-- Шаг 6: Фасад -->
        <div class="step-content" id="step6">
            <h2 class="step-title">Выберите технологию фасада</h2>
            <div id="facadesContainer" class="options-container"></div>
        </div>

        <!-- Шаг 7: Электрика -->
        <div class="step-content" id="step7">
            <h2 class="step-title">Выберите вариант электрики</h2>
            <div id="electricalContainer" class="options-container"></div>
        </div>

        <!-- Шаг 8: Отделка стен -->
        <div class="step-content" id="step8">
            <h2 class="step-title">Выберите отделку стен</h2>
            <div id="wallFinishesContainer" class="options-container"></div>
        </div>

        <!-- Шаг 9: Дополнительные опции -->
        <div class="step-content" id="step9">
            <h2 class="step-title">Дополнительные опции</h2>
            <div id="additionsContainer" class="options-container"></div>
        </div>

        <!-- Шаг 10: Контактная форма и итог -->
        <div class="step-content" id="step10">
            <h2 class="step-title">Подтверждение заказа</h2>
    
            <div class="summary-section">
                <h3>Выбранные параметры:</h3>
                <table class="summary-table">
                    <tr>
                        <th>Тип дома:</th>
                        <td id="summaryHouseType">-</td>
                    </tr>
                    <tr>
                        <th>Площадь:</th>
                        <td id="summaryArea">-</td>
                    </tr>
                    <tr>
                        <th>Этажность:</th>
                        <td id="summaryFloors">-</td>
                    </tr>
                    <tr>
                        <th>Тип крыши:</th>
                        <td id="summaryRoof">-</td>
                    </tr>
                    <tr>
                        <th>Материал стен:</th>
                        <td id="summaryMaterial">-</td>
                    </tr>
                    <tr>
                        <th>Фундамент:</th>
                        <td id="summaryFoundation">-</td>
                    </tr>
                    <tr>
                        <th>Фасад:</th>
                        <td id="summaryFacade">-</td>
                    </tr>
                    <tr>
                        <th>Электрика:</th>
                        <td id="summaryElectrical">-</td>
                    </tr>
                    <tr>
                        <th>Отделка стен:</th>
                        <td id="summaryWallFinish">-</td>
                    </tr>
                    <tr>
                        <th>Дополнительные опции:</th>
                        <td id="summaryAdditions">-</td>
                    </tr>
                    <tr>
                        <th>Итоговая стоимость:</th>
                        <td id="summaryPrice">-</td>
                    </tr>
                </table>
            </div>

            <div class="contact-form">
                <h3>Ваши контактные данные:</h3>
                <div class="form-group">
                    <label>Ваше имя *</label>
                    <input type="text" id="contactName" class="form-input" required>
                </div>
                <div class="form-group">
                    <label>Телефон *</label>
                <input type="tel" id="contactPhone" class="form-input" required>
                </div>
                <div class="form-group">
                    <label>Email *</label>
                    <input type="email" id="contactEmail" class="form-input" required>
                </div>
                <div class="form-group">
                    <label>Комментарий</label>
                    <textarea id="contactComment" class="form-input"></textarea>
                </div>
            </div>
        </div>

        <!-- Навигационные кнопки -->
        <div class="navigation-buttons">
            <button class="btn btn-secondary" id="prevBtn" onclick="prevStep()" enabled>Назад</button>
            <button class="btn btn-primary" id="nextBtn" onclick="nextStep()">Далее</button>
        </div>
    </div>


    <footer class="footer">
        <div class="footer__container">
            <div class="footer-info__contacts">
                <a href="tel:+7(920)908-95-40" class="footer-info__number">+7 (920) 908-95-40</a>
                <a href="tel:+7(910)098-88-16" class="footer-info__number">+7 (910) 098-88-16</a>
                <div class="footer-info__items">
                    <p class="footer-info__social">Соц.сети</p>
                    <a href="https://www.instagram.com/stroyedom/"><img class="footer-info__social-icon" src="img/inst.png" alt=""></a>
                    <a href="https://vk.com/stroyedom"><img class="footer-info__social-icon" src="img/vk.png" alt=""></a>
                </div>
            </div>
    
            <div class="footer-info__elements">
                <h2 class="footer-info__title">НАШ АДРЕС</h2>
                    <p class="footer-info__text">Владимирская область, г. Александров, ул. Перфильева, д. 2, 2-й этаж, офис №1. (напротив 14 школы)</p>
            </div>
    
            <div class="footer-info__elements">
                <h2 class="footer-info__title">О НАС</h2>
                    <a href="" class="footer-info__text-1">Дома из бруса</a>
                    <a href="" class="footer-info__text-1">Каркасные дома</a>
                    <a href="" class="footer-info__text-1">Дачные бытовки</a>
            </div>
    
            <div class="footer-info__elements">
                <h2 class="footer-info__title">УСЛУГИ</h2>
                    <a href="#" class="footer-info__text-1">Ремонт квартир</a>
                    <a href="#" class="footer-info__text-1">Монтаж Сайдинга</a>
                    <a href="#" class="footer-info__text-1">Кровельные работы</a>
                    <a href="#" class="footer-info__text-1">Реконструкция домов</a>
            </div>
        </div>
    </footer>
    <div id="notification" class="notification hidden">
        <div class="notification-content">
            <span id="notificationMessage"></span>
            <button class="notification-close" onclick="closeNotification()">×</button>
        </div>
    </div>
</body>
</html>