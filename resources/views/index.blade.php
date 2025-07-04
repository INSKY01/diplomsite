<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/normilize.css">
    <link rel="stylesheet" href="css/style.css">
    <script defer src="js/script.js"></script>
    <link rel="shortcut icon" href="icons/logo.svg">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Questrial&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>

    <!--Header-->
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

    <!--Main Content-->
    <main>
        <!--First Section-->
        <section class="first-section__index">
            <img class="first-section__background" src="img/fon.png" alt="Фон">
            <div class="first-section__text">
                <h1 class="first-section__title">СТРОИТЕЛЬСТВО ДАЧНЫХ ДОМОВ И КОТТЕДЖЕЙ ПОД КЛЮЧ «СТРОЙЭКОДОМ»</h1>
                <p>Строительная компания «СтройЭкоДом» осуществляет качественное строительство дачных домов и коттеджей по доступным ценам в Александрове и других районах Владимирской области. Мы как никто другой знаем, что натуральность материалов ценилась во все времена, а сегодня привлекает людей еще больше.</p>
                <p class="first-section__text-2">Именно деревянный дом, дача, коттеджи строятся нашей бригадой из экологически чистых материалов, дарят тепло в стужу, прохладу — в жару, а семейный уют и свежий аромат леса — ежедневно. Владельцем фамильного особняка или уютного дачного домика можно стать уже сегодня благодаря мастерам компании «СтройЭкоДом».</p>
            </div>
        </section>

        <!--Second Section-->
        <section class="second-section">
            <div class="slider_main">
                <div class="wrapper">
                    <input type="radio" name="point" id="slide1" checked />
                    <input type="radio" name="point" id="slide2" />
                    <input type="radio" name="point" id="slide3" />
                    <input type="radio" name="point" id="slide4" />
                    <div class="slider">
                        <div class="slides slide1">
                            <h1 class="slider__title">Дома из бруса</h1>
                        </div>
                        <div class="slides slide2">
                            <h1 class="slider__title">Каркасные дома</h1>
                        </div>
                        <div class="slides slide3">
                            <h1 class="slider__title">Конюшни</h1>
                        </div>
                        <div class="slides slide4">
                            <h1 class="slider__title">Лестницы</h1>
                        </div>
                    </div>
                    <div class="controls">
                        <label for="slide1"></label>
                        <label for="slide2"></label>
                        <label for="slide3"></label>
                        <label for="slide4"></label>
                    </div>
                </div>
            </div>
            <div class="calc_readress">
                <h2 class="calc_readress__title">КАЛЬКУЛЯТОР РАССЧЕТА СТОИМОСТИ СТРОИТЕЛЬСТВА</h2>
                <div class="calc_readress__row">
                    <div class="calc_readress__input-group">
                        <label for="width">Ширина</label>
                        <input type="text" id="width" name="width" placeholder="Ширина (м.)">
                    </div>
                    <div class="calc_readress__input-group">
                        <label for="length">Длина</label>
                        <input type="text" id="length" name="length" placeholder="Длина (м.)">
                    </div>
                    <div class="calc_readress__floors">
                        <label for="floors">Этажность</label>
                        <select id="floors" name="floors">
                            <option value="1">1 этаж</option>
                            <option value="2">2 этажа</option>
                            <option value="3"> > 2</option>
                        </select>
                    </div>
                </div>
                <div class="calc_readress__row">
                    <div id="perimetr_params">
                        <span>Периметр дома:</span>
                    </div>
                    <div id="area_params">
                        <span>Площадь дома:</span>
                    </div>
                </div>
                <div class="calc_readress__steps">
                    <h2 class="calc_readress__title">Шаг 1: Фундамент</h2>
                    <div class="calc_readress__steps_settings">
                        <div class="step-row" onclick="selectFoundation(this)">
                            <div>
                                <img src="img/calculator/foundations/concrete_slab.jpeg" alt="Монолитная плита">
                                <p>Монолитная плита</p>
                            </div>
                        </div>
                        <div class="step-row" onclick="selectFoundation(this)">
                            <div>
                                <img src="img/calculator/foundations/screw_pile.jpg" alt="Свайный">
                                <p>Свайный</p>
                            </div>
                        </div>
                        <div class="step-row" onclick="selectFoundation(this)">
                            <div>
                                <img src="img/calculator/foundations/deep_strip.jpg" alt="Цокольный этаж">
                                <p>Цокольный этаж</p>
                            </div>
                        </div>
                        <div class="step-row" onclick="selectFoundation(this)">
                            <div>
                                <img src="img/calculator/foundations/shallow_strip.jpg" alt="Ленточный">
                                <p>Ленточный</p>
                            </div>
                        </div>
                    </div>
                </div>
                <a class="cta" href="{{ url('/calc') }}">
                    <p class="calc_readress__btn_span">Рассчитать дальше</p>
                    <span>
                      <svg width="36px" height="23px" viewBox="0 0 66 43" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g id="arrow" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                          <path class="one" d="M40.1543933,3.89485454 L43.9763149,0.139296592 C44.1708311,-0.0518420739 44.4826329,-0.0518571125 44.6771675,0.139262789 L65.6916134,20.7848311 C66.0855801,21.1718824 66.0911863,21.8050225 65.704135,22.1989893 C65.7000188,22.2031791 65.6958657,22.2073326 65.6916762,22.2114492 L44.677098,42.8607841 C44.4825957,43.0519059 44.1708242,43.0519358 43.9762853,42.8608513 L40.1545186,39.1069479 C39.9575152,38.9134427 39.9546793,38.5968729 40.1481845,38.3998695 C40.1502893,38.3977268 40.1524132,38.395603 40.1545562,38.3934985 L56.9937789,21.8567812 C57.1908028,21.6632968 57.193672,21.3467273 57.0001876,21.1497035 C56.9980647,21.1475418 56.9959223,21.1453995 56.9937605,21.1432767 L40.1545208,4.60825197 C39.9574869,4.41477773 39.9546013,4.09820839 40.1480756,3.90117456 C40.1501626,3.89904911 40.1522686,3.89694235 40.1543933,3.89485454 Z" fill="#FFFFFF"></path>
                          <path class="two" d="M20.1543933,3.89485454 L23.9763149,0.139296592 C24.1708311,-0.0518420739 24.4826329,-0.0518571125 24.6771675,0.139262789 L45.6916134,20.7848311 C46.0855801,21.1718824 46.0911863,21.8050225 45.704135,22.1989893 C45.7000188,22.2031791 45.6958657,22.2073326 45.6916762,22.2114492 L24.677098,42.8607841 C24.4825957,43.0519059 24.1708242,43.0519358 23.9762853,42.8608513 L20.1545186,39.1069479 C19.9575152,38.9134427 19.9546793,38.5968729 20.1481845,38.3998695 C20.1502893,38.3977268 20.1524132,38.395603 20.1545562,38.3934985 L36.9937789,21.8567812 C37.1908028,21.6632968 37.193672,21.3467273 37.0001876,21.1497035 C36.9980647,21.1475418 36.9959223,21.1453995 36.9937605,21.1432767 L20.1545208,4.60825197 C19.9574869,4.41477773 19.9546013,4.09820839 20.1480756,3.90117456 C20.1501626,3.89904911 20.1522686,3.89694235 20.1543933,3.89485454 Z" fill="#FFFFFF"></path>
                          <path class="three" d="M0.154393339,3.89485454 L3.97631488,0.139296592 C4.17083111,-0.0518420739 4.48263286,-0.0518571125 4.67716753,0.139262789 L25.6916134,20.7848311 C26.0855801,21.1718824 26.0911863,21.8050225 25.704135,22.1989893 C25.7000188,22.2031791 25.6958657,22.2073326 25.6916762,22.2114492 L4.67709797,42.8607841 C4.48259567,43.0519059 4.17082418,43.0519358 3.97628526,42.8608513 L0.154518591,39.1069479 C-0.0424848215,38.9134427 -0.0453206733,38.5968729 0.148184538,38.3998695 C0.150289256,38.3977268 0.152413239,38.395603 0.154556228,38.3934985 L16.9937789,21.8567812 C17.1908028,21.6632968 17.193672,21.3467273 17.0001876,21.1497035 C16.9980647,21.1475418 16.9959223,21.1453995 16.9937605,21.1432767 L0.15452076,4.60825197 C-0.0425130651,4.41477773 -0.0453986756,4.09820839 0.148075568,3.90117456 C0.150162624,3.89904911 0.152268631,3.89694235 0.154393339,3.89485454 Z" fill="#FFFFFF"></path>
                        </g>
                      </svg>
                    </span> 
                </a>
            </div>
        </section>

        <!--Third Section-->
        <section class="therd-section">
            <div class="therd-section__text">
                <h1>НАШИ ПРЕИМУЩЕСТВА</h1>
                <p>Разрабатываем индивидуальное комплексное решение для вашего плана и подбираем для него уникальный набор услуг, объединяя их единой стратегией и целью.</p>
            </div>
            <div class="therd-section__items">
                <div class="therd-section__item">
                    <img class="therd-section__item-icon" src="img/Group1.png" alt="Иконка">
                    <h4 class="therd-section__item-name">​Реализация проектов в кротчайшие сроки</h4>
                    <p class="therd-section__item-text">Нужно срочно построить бытовку/баню/сарай или что-то ещё? Обсудим детали, приступим к выполнению, и вы даже не успеете моргнуть как всё будет готово</p>
                </div>
                <div class="therd-section__item">
                    <img class="therd-section__item-icon" src="img/Group2.png" alt="Иконка">
                    <h4 class="therd-section__item-name">​Индивидуальные и типовые проекты</h4>
                    <p class="therd-section__item-text">Мы предоставляем возможность согласования и выбора собственного проекта по своим деталям и представлениям</p>
                </div>
                <div class="therd-section__item">
                    <img class="therd-section__item-icon" src="img/Group3.png" alt="Иконка">
                    <h4 class="therd-section__item-name">​Отличное качество и долговечность домов</h4>
                    <p class="therd-section__item-text">Гарантируем долговечность наших построек и качество предоставляемых услуг на долгие годы</p>
                </div>
                <div class="therd-section__item">
                    <img class="therd-section__item-icon" src="img/Group4.png" alt="Иконка">
                    <h4 class="therd-section__item-name">​Профессиональные бригады строителей</h4>
                    <p class="therd-section__item-text">​Каким бы ни был масштаб ваших проектов, наши специалисты обладают навыками, необходимыми для успешного решения ваших задач</p>
                </div>
            </div>
        </section>

        <!--Fourth Section-->
        <section class="fourth-section">
            <button class="toggle-button">Показать/Скрыть больше информации о Нас</button>
            <div class="fourth-section__left-side">
                <h1 class="fourth-section__left-side-title">ПОСТРОИТЬ ДОМ С КОМПАНИЕЙ «СТРОЙЭКОДОМ» В ТРИ ЭТАПА</h1>
                <p class="fourth-section__left-side-text">
                    <strong> Проекты домов </strong><br> 
                    Первым этапом строительства деревянных домов считается именно <span class="fourth-section__left-side-text__orange">создание макета</span>. 
                    Взглянув на проекты домов, клиент сразу же сможет оценить не только их внешний вид, но и внутреннюю планировку, затраты на материалы и стоимость всех необходимых работ. Разработка проекта — это немаловажный этап в самом начале строительства домов, при котором клиент может представить дом своей мечты и понять, соответствует ли этому бюджет. <span class="fourth-section__left-side-text__orange">Также с первого же дня сотрудничества с клиентом мы согласовываем все его пожелания и разъясняем выбор материалов</span>.
                    Если вас заинтересовал некий выполненный проект среди уже существующих в разделе «ГАЛЕРЕЯ», то наш специалист сможет дать объяснение цене возведенного дома, опишет его достоинства и недостатки, оправдает выбор материалов при их невысокой стоимости. Обратите внимание и на проекты деревянных домов — «золотой запас» нашей строительной компании, наработанный за годы деятельности. Новые клиенты всегда стимулируют «СтройЭкоДом» к развитию, а потому наша коллекция проектов активно пополняется все новыми макетами коттеджей и дачных домов. Найдите наиболее интересное по собственному вкусу и оптимальное согласно финансовым возможностям решение! <span class="fourth-section__left-side-text__orange">Качество и надежность нашего строительства мы можем гарантировать</span>.
                    <br>
                    <br>
                    <br>
                    <strong> Строительство фундамента </strong><br>
                    Вторым важным этапом при строительстве дома под ключ считается <span class="fourth-section__left-side-text__orange">возведение фундамента</span>. Качественный фундамент мы умеем делать быстро, уделяя пристальное внимание каждому заложенному «кирпичику»: основание деревянного дома должно быть надежным, хоть и не нуждается в дополнительном усилении.Фирма «СтройЭкоДом» специализируется на свайно-винтовых, столбчатых и ленточных фундаментах. Выбор типа фундамента мы делаем исключительно после знакомства с грунтом участков, на которых будет происходить строительство домов. <span class="fourth-section__left-side-text__orange">Если клиент намерен строиться самостоятельно, на этом этапе компания может остановиться</span>.
                    <br>
                    <br>
                    <br>
                    <strong> Строительство домов под ключ </strong><br>
                    Завершающий и, пожалуй, наиболее длительный этап — <span class="fourth-section__left-side-text__orange">непосредственное строительство домов под ключ, коттеджей, бань и дачных домов из дерева, а также их отделка и ряд комплексных услуг</span>. Строительство во Владимирской области всё больше развивается благодаря популярным и современным. Их дополнительная усадка и отделка не требуют длительного времени, а потому жилье под ключ вроде дачи вы сможете получить сравнительно быстро: через 3-4 недели. <span class="fourth-section__left-side-text__orange">Строительство под ключ дачных домов и коттеджей не обходится без поиска всех необходимых материалов</span>, которые были бы покрыты защитными средствами, обладали надежным замковым соединением и отличались сухостью. Иногда, еще на этапе проектирования деревянного дома, материал могут пересмотреть для поиска наиболее оптимального варианта.</p>
            </div>
            <div class="fourth-section__right-side">
                <h1 class="fourth-section__right-side-title">СТРОИТЕЛЬНАЯ КОМПАНИЯ «СТРОЙЭКОДОМ»:</h1>
                <ol class="fourth-section__right-side-text">
                    <li>Мы в точности следуем графику строительных работ сдаем объект в срок, поскольку при строительстве дачных домов мы поддерживаем с бригадой тесный контакт.</li>
                    <br>
                    <li>Компания бережет ваше время и нервы: клиента не беспокоят даже при строительстве коттеджей большого масштаба, контроль над проделанными работами ведет специалист, а вы занимаетесь своими делами, знакомясь с периодическими отчетами о ходе строительства под ключ.</li>
                    <br>
                    <li>Экономно расходуем ваши средства, т.к. наши сотрудники умеют подбирать у постоянных и проверенных поставщиков максимально качественные материалы по минимальной стоимости.</li>
                    <br>
                    <li>Наша строительная фирма позволяет клиентам выбрать существующий проект либо отдать предпочтение индивидуальному, в котором мы предложим наиболее оригинальные идеи для воплощения.</li>
                    <br>
                    <li>Наши мастера выполняют широкий спектр строительных услуг: это не только дома и коттеджи, но бытовки и бани, а также возведение фундаментов и реконструкция строений.</li>
                </ol>
                <div class="fourth-section__image"></div>
            </div>
        </section>

        <!--Fifth Section-->
        <section class="fifth-section">
            <h1 class="fifth-section__title">ЧаВо</h1>
            <p class="fifth-section__text">Возникли некоторые вопросы? Предлагаем их решение ниже!</p>
            <div class="fifth-section__questions">
                <input type="checkbox" name="chacor" id="chacor1" checked="checked" />
                <label for="chacor1">Как рассчитывается стоимость строительства?</label>
                <div class="acor-body">
                    <p>Этот вопрос считается определяющим для многих заказчиков, а потому мы часто идем вам навстречу в поиске наиболее приемлемых по цене материалов и находим наилучшие расценки на услуги «СтройЭкоДома».<br>Строительство от нашей компании может стоить совсем немного:</p><br>
                    <ul>
                        <li class="fifth-section__questions-li">Дачные дома от 8 000 руб\м2.</li>
                        <li class="fifth-section__questions-li">Коттеджи 10 000 руб\м2.</li>
                    </ul>
                </div>
                        
                <input type="checkbox" name="chacor" id="chacor2" />
                <label for="chacor2">Какие кровли мы применяем?</label>
                <div class="acor-body">
                    <ul class="acor-list">
                        <li>плоская кровля (эксплуатируемая)</li>
                        <li>фальц</li>
                        <li>мягкая кровля (гибкая черепица)</li>
                        <li>модульная черепица</li>
                        <li>металлочерепица</li>
                        <li>керамическая черепица</li>
                    </ul>
                </div>
                        
                <input type="checkbox" name="chacor" id="chacor3" />
                <label for="chacor3">Где мы работаем?</label>
                <div class="acor-body">
                    <p>Наш адрес: Владимирская область, г. Александров, ул. Перфильева, д. 2, 2-й этаж, офис №1. (напротив 14 школы)</p>
                </div>

                <input type="checkbox" name="chacor" id="chacor4" />
                <label for="chacor4">Какой график работы?</label>
                <div class="acor-body">
                    <p>​Вт-пт c 10:00 до 17:00; сб с 10:00 до 15:00</p>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer__container">
            <div class="footer-info__contacts">
                <a href="tel:+7(920)908-95-40" class="footer-info__number">+7 (920) 908-95-40</a>
                <a href="tel:+7(910)098-88-16" class="footer-info__number">+7 (910) 098-88-16</a>
                <div class="footer-info__items">
                    <p class="footer-info__social">Соц.сети</p>
                    <a href="https://www.instagram.com/stroyedom/"><img class="footer-info__social-icon" src="img/inst.png" alt="Instagram"></a>
                    <a href="https://vk.com/stroyedom"><img class="footer-info__social-icon" src="img/vk.png" alt="VK"></a>
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
</body>
</html>