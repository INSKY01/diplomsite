<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Контакты</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/normilize.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        .alert {
            padding: 10px 15px;
            margin: 10px 0;
            border-radius: 5px;
            font-weight: bold;
        }
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
    <script defer src="js/script.js"></script>
    <link rel="shortcut icon" href="icons/logo.svg">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Play:wght@400;700&family=Questrial&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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

<div class="contacts">
    <!-- Первая секция -->
    <section class="main-section__contacts">
        <h3 class="title-contacts">ХОТИТЕ СОЗДАТЬ СВОЙ ПРОЕКТ?<br>ДАВАЙТЕ ОБГОВОРИМ!</h3>
        <div class="cards">
            <div class="card">
                <i class="fas fa-map-marker-alt fa-3x card-icon-1"></i>
                <h3 class="card-title">Мы находимся:</h3>
                <p class="card-text-1">Владимирская область, г. Александров, ул. Перфильева, д.2, 2-й этаж, офис №1</p>
            </div>
            <div class="card">
                <i class="fas fa-phone-alt fa-3x card-icon-2"></i>
                <h3 class="card-title">Наш номер:</h3>
                <p class="card-text-2">+7 (920) 908-95-40<br>+7 (910) 098-88-16</p>
            </div>
            <div class="card">
                <i class="fas fa-envelope fa-3x card-icon-3"></i>
                <h3 class="card-title">Наша почта и соц.сети:</h3>
                <a href="mailto:stroyedom@mail.ru" class="card-text-3">stroyedom@mail.ru</a>
                <div class="soc-med-icon">
                    <a href="https://vk.com/stroyedom"><img width="60px" height="60px" src="img/vk.png" alt="ВКонтакте"></a>
                    <a href="https://www.instagram.com/stroyedom/"><img width="60px" height="60px" src="img/inst.png" alt="Инстаграм"></a>
                </div>
            </div> 
        </div>
    </section>  

    <!-- Форма обратной связи -->
    <div class="feedback-main">
        <div class="feedback">
            <p class="feedback__title">ОБРАТНАЯ СВЯЗЬ</p>
            <p class="feedback__text">ДОСТУПНО 24 ЧАСА</p>
            
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            
            @if(session('error'))
                <div class="alert alert-error">
                    {{ session('error') }}
                </div>
            @endif
            
            @if($errors->any())
                <div class="alert alert-error">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
            
            <form action="{{ route('send.feedback') }}" method="POST" class="feedback__form">
                @csrf
                <div class="col-25">
                    <label class="label-name" for="firstname">Имя:</label>
                </div>
                <div>
                    <input class="feedback__input" type="text" id="firstname" name="firstname" placeholder="Введите Ваше имя" value="{{ old('firstname') }}" required>
                </div>
    
                <div class="col-25">
                    <label class="label-name" for="tel">Телефон:</label>
                </div>
                <div>
                    <input class="feedback__input" type="tel" id="tel" name="tel" placeholder="Введите Ваш телефон" value="{{ old('tel') }}" required>
                </div>
    
                <div class="col-25">
                    <label class="label-name" for="email">Почта:</label>
                </div>
                <div>
                    <input class="feedback__input" type="email" id="email" name="email" placeholder="Введите Вашу эл. почту" value="{{ old('email') }}" required>
                </div>
    
                <div class="col-25">
                    <label class="label-name" for="subject">Сообщение:</label>
                </div>
    
                <div>
                    <textarea class="feedback__big-msg" id="subject" name="subject" placeholder="Введите Ваше сообщение">{{ old('subject') }}</textarea>
                </div>
                <input class="feedback__button" type="submit" value="Отправить">
            </form>
        </div>
    </div>
    
    <!-- Карта -->
    <section class='cont_box'>
        <h2 class='cont_box__title'>Вт-пт с 10:00 до 17:00; сб с 10:00 до 15:00</h2>
        <div>
            <iframe src='https://www.google.com/maps/embed?pb=!4v1730728902088!6m8!1m7!1sb8Z_50o05z3r6ULfqivgCw!2m2!1d56.39463719483964!2d38.70346511996117!3f247.67491!4f0!5f0.7820865974627469'
                    width='1000'
                    height='450'
                    style='border:0; bottom: 100px;'
                    allowfullscreen=''
                    loading='lazy'
                    referrerpolicy='no-referrer-when-downgrade'></iframe>
        </div>
    </section>

</div>

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
    <div id="notification" class="notification hidden">
        <div class="notification-content">
            <span id="notificationMessage"></span>
            <button class="notification-close" onclick="closeNotification()">×</button>
        </div>
    </div>
</body>
</html> 