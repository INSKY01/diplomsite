<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Отзывы</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/normilize.css">
    <link rel="stylesheet" href="css/style.css">
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

    <!--Главная секция-->
    <section class="main-section__reviews">
        <div class="reviews">
            <div class="review">
                <img class="review-icon" src="img/Test Account.png" alt="">
                <img class="review-icon" src="img/5star.png" alt="">
                <h4 class="review-name">Мария</h4>
                <p class="review-text">Заходила на ваш сайт и мне понравился широкий выбор проектов на любой кошелёк. Читала много положительных отзывов о вашей компании, и это радует. Жить в деревянном доме – просто мечта!</p>
            </div>
            <div class="review">
                <img class="review-icon" src="img/Test Account.png" alt="">
                <img class="review-icon" src="img/5star.png" alt="">
                <h4 class="review-name">Наталия</h4>
                <p class="review-text">Всем Здравствуйте, хочу оставить отзыв о бригаде из двух человек, которых зовут Михаил Силуянов и Михаил Сластухин. Эти два человека сделали нам отличный ремонт. Работа была выполнена прекрасно, никаких нареканий не возникло.</p>
            </div>
            <div class="review">
                <img class="review-icon" src="img/Test Account.png" alt="">
                <img class="review-icon" src="img/5star.png" alt="">
                <h4 class="review-name">Станислав</h4>
                <p class="review-text">Обратился в фирму со своими рисованными от руки чертежами, На первой встрече мне все рассказали, внесли конструктивные изменения техническим заданием на строительство и соответственно стоимость. Выражаю благодарность!!!</p>
            </div>
            <div class="review">
                <img class="review-icon" src="img/Test Account.png" alt="">
                <img class="review-icon" src="img/5star.png" alt="">
                <h4 class="review-name">Роман</h4>
                <p class="review-text">Заказал дом из каркаса 6х6 Достоинства: Быстро посчитали стоимость дома Цена оказалась ниже чем у других стройфирм - это тоже + Заключили договор, все официально. Никаких дополнительных цен в процессе стройки не появилось.</p>
            </div>
            <div class="review">
                <img class="review-icon" src="img/Test Account.png" alt="">
                <img class="review-icon" src="img/5star.png" alt="">
                <h4 class="review-name">Елена</h4>
                <p class="review-text">Выражаем благодарность строительной фирме! Долго искали проект дома, который будет идеален для нашей семьи. Но в итоге решили построить дом по своему проекту. Обратились в стрoйэкодом и не пожалели, рекомендуем!</p>
            </div>
            <div class="review">
                <img class="review-icon" src="img/Test Account.png" alt="">
                <img class="review-icon" src="img/5star.png" alt="">
                <h4 class="review-name">Андрей</h4>
                <p class="review-text">17 марта 2014 года заключили договор о строительстве дома из профилированного бруса (150х150) 8x8 по моему проекту. 11 апреля дом был принят. Качество бруса выглядит идеально, обработали его антисептиком, результатом очень доволен.</p>
            </div>
        </div>
    </section>

    <!-- Footer -->
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

</body>
</html> 