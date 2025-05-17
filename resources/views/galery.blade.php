<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Галерея</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/normilize.css">
    <link rel="stylesheet" href="css/style.css">
    <script defer src="js/script.js"></script>
    <link rel="shortcut icon" href="icons/logo.svg">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Questrial&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Infant:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Play:wght@400;700&family=Questrial&display=swap" rel="stylesheet">
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

    <div class="galery-container">
        <!--Главная часть-->
        <div class="container">
            <h1 class="gallery-title">
                ГАЛЕРЕЯ НАШИХ ПРОЕКТОВ
            </h1>
        <div class="gallery">
            <div class="gallery-item" onclick="openModal('img/galery1.jpg')">
                <img alt="Wooden house with stairs leading to the entrance" height="150" src="img/galery1.jpg" width="200"/>
                <div class="zoom-icon">
                    <i class="fas fa-search"></i>
                </div>
            </div>
            <div class="gallery-item" onclick="openModal('img/galery2.jpg')">
                <img alt="Wooden house with stairs leading to the entrance" height="150" src="img/galery2.jpg" width="200"/>
                <div class="zoom-icon">
                    <i class="fas fa-search"></i>
                </div>
            </div>
            <div class="gallery-item" onclick="openModal('img/galery3.jpg')">
                <img alt="Wooden house with stairs leading to the entrance" height="150" src="img/galery3.jpg" width="200"/>
                <div class="zoom-icon">
                    <i class="fas fa-search"></i>
                </div>
            </div>
            <div class="gallery-item" onclick="openModal('img/galery4.jpg')">
                <img alt="Wooden house with stairs leading to the entrance" height="150" src="img/galery4.jpg" width="200"/>
                <div class="zoom-icon">
                    <i class="fas fa-search"></i>
                </div>
            </div>
            <div class="gallery-item" onclick="openModal('img/galery5.jpg')">
                <img alt="Wooden house with stairs leading to the entrance" height="150" src="img/galery5.jpg" width="200"/>
                <div class="zoom-icon">
                    <i class="fas fa-search"></i>
                </div>
            </div>
            <div class="gallery-item" onclick="openModal('img/galery6.jpg')">
                <img alt="Wooden house with stairs leading to the entrance" height="150" src="img/galery6.jpg" width="200"/>
                <div class="zoom-icon">
                    <i class="fas fa-search"></i>
                </div>
            </div>
            <div class="gallery-item" onclick="openModal('img/galery7.jpg')">
                <img alt="Wooden house with stairs leading to the entrance" height="150" src="img/galery7.jpg" width="200"/>
                <div class="zoom-icon">
                    <i class="fas fa-search"></i>
                </div>
            </div>
            <div class="gallery-item" onclick="openModal('img/galery8.jpg')">
                <img alt="Wooden house with stairs leading to the entrance" height="150" src="img/galery8.jpg" width="200"/>
                <div class="zoom-icon">
                    <i class="fas fa-search">
                    </i>
                </div>
            </div>

            <div class="gallery-item hidden" onclick="openModal('img/galery9.jpg')">
                <img alt="Small wooden house with grey roof" height="150" src="img/galery9.jpg" width="200"/>
                <div class="zoom-icon">
                    <i class="fas fa-search"></i>
                </div>
            </div>
            <div class="gallery-item hidden" onclick="openModal('img/galery10.jpg')">
                <img alt="Small wooden house with grey roof" height="150" src="img/galery10.jpg" width="200"/>
                <div class="zoom-icon">
                    <i class="fas fa-search"></i>
                </div>
            </div>
            <div class="gallery-item hidden" onclick="openModal('img/galery11.jpg')">
                <img alt="Small wooden house with grey roof" height="150" src="img/galery11.jpg" width="200"/>
                <div class="zoom-icon">
                    <i class="fas fa-search"></i>
                </div>
            </div>
            <div class="gallery-item hidden" onclick="openModal('img/galery12.jpg')">
                <img alt="Small wooden house with grey roof" height="150" src="img/galery12.jpg" width="200"/>
                <div class="zoom-icon">
                    <i class="fas fa-search"></i>
                </div>
            </div>
            <div class="gallery-item hidden" onclick="openModal('img/galery13.jpg')">
                <img alt="Small wooden house with grey roof" height="150" src="img/galery13.jpg" width="200"/>
                <div class="zoom-icon">
                    <i class="fas fa-search"></i>
                </div>
            </div>
            <div class="gallery-item hidden" onclick="openModal('img/galery14.jpg')">
                <img alt="Small wooden house with grey roof" height="150" src="img/galery14.jpg" width="200"/>
                <div class="zoom-icon">
                    <i class="fas fa-search"></i>
                </div>
            </div>
            <div class="gallery-item hidden" onclick="openModal('img/galery15.jpg')">
                <img alt="Small wooden house with grey roof" height="150" src="img/galery15.jpg" width="200"/>
                <div class="zoom-icon">
                    <i class="fas fa-search"></i>
                </div>
            </div>
            <div class="gallery-item hidden" onclick="openModal('img/galery16.jpg')">
                <img alt="Small wooden house with grey roof" height="150" src="img/galery16.jpg" width="200"/>
                <div class="zoom-icon">
                    <i class="fas fa-search"></i>
                </div>
            </div>
            <div class="gallery-item hidden" onclick="openModal('img/galery17.jpg')">
                <img alt="Small wooden house with grey roof" height="150" src="img/galery17.jpg" width="200"/>
                <div class="zoom-icon">
                    <i class="fas fa-search"></i>
                </div>
            </div>
            <div class="gallery-item hidden" onclick="openModal('img/galery18.jpg')">
                <img alt="Small wooden house with grey roof" height="150" src="img/galery18.jpg" width="200"/>
                <div class="zoom-icon">
                    <i class="fas fa-search"></i>
                </div>
            </div>
            
        </div>
        <button class="show-all" onclick="showAllImages()">
            ПОКАЗАТЬ ВСЕ
        </button>
        <div class="modal" id="myModal" onclick="closeModal()">
            <div class="modal-content">
                <img alt="Enlarged view" id="modalImage" src=""/>
            </div>
        </div>
        </div>
    </div>
    
          <!-- Footer -->
  <footer class="footer-gallery">
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