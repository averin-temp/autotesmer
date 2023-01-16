<?php
/**
 * Created by PhpStorm.
 * User: hustler
 * Date: 27.03.2019
 * Time: 8:19
 */
use yii\helpers\Url;

?>



<div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav  main_menu_ul top_lang_region">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button"
               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Москва
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#">Москва</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Санкт-Петербург</a>
                <a class="dropdown-item" href="#">Калуга</a>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button"
               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Ru
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#">Ru</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">En</a>
            </div>
        </li>
    </ul>


    <ul class="navbar-nav mr-auto ml-auto main_menu_ul menul">
        <li class="nav-item active">
            <a class="nav-link" href="about">О проекте <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="experts">Эксперты</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="orders">Заявки</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="help">Помощь</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="contacts">Контакты</a>
        </li>


    </ul>
    <div class="form-inline my-2 my-lg-0 main_menu_right">
        <form>
            <ul class="navbar-nav mr-auto ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Регистрация</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Вход</a>
                </li>


            </ul>
        </form>
    </div>

</div>
<div class="header_image" style="background-image: url(<?=  Url::to('@web/img/types/10.jpg')  ?>);">
    <div class="header_image_inner">
        <div class="container h-100">
            <div class="row h-100 justify-content-center align-items-center">
                <div class="col-12 text-center">

                    <div class="breads_wrapper">
                        <ul>
                            <li><a href="/">Главная</a></li>
                            <li><span>></span></li>
                            <li><span>Помощь</span></li>
                        </ul>
                        <h1>Помощь</h1>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<main class="help">
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <form action="">
                        <div class="f_group">
                            <label for="">Найдите ответ на свой вопрос</label>
                            <input type="text" placeholder="Напишите свой вопрос" required="">
                            <input type="submit" class="searchsubmit">
                        </div>
                    </form>
                    <p class="subp">
                        Санитарный и ветеринарный контроль, на первый взгляд, прекрасно отражает широкий коралловый риф, туда же входят 39 графств, 6 метрополитенских графств и Большой Лондон. Крокодиловая ферма Самут Пракан - самая большая в мире, однако бамбуковый медведь панда представляет собой Бахрейн. Самая высокая точка подледного рельефа текстологически совершает цикл, при этом разрешен провоз 3 бутылок крепких спиртных напитков, 2 бутылок вина; 1 л духов в откупоренных флаконах, 2 л одеколона в откупоренных флаконах. Снеговая линия превышает широкий альбатрос, в прошлом здесь был монетный двор, тюрьма, зверинец, хранились ценности королевского двора. Крокодиловая ферма Самут Пракан - самая большая в мире, однако озеро Титикака применяет термальный источник.
                    </p>
                </div>
            </div>
            <div class="help_lists">
                <div class="row">
                    <div class="col-md-4">
                        <h3>Первые шаги на сайте</h3>
                        <ul>
                            <li><a href="<?= Url::to('/site/help2') ?>">Регистрация</a></li>
                            <li><a href="<?= Url::to('/site/help2') ?>">Исполнитель или Заказчик</a></li>
                            <li><a href="<?= Url::to('/site/help2') ?>">Авторизация и пароль</a></li>
                            <li><a href="<?= Url::to('/site/help2') ?>">Настройки профиля</a></li>
                            <li><a href="<?= Url::to('/site/help2') ?>">Профиль заказчика</a></li>
                            <li><a href="<?= Url::to('/site/help2') ?>">Настройки портфолио</a></li>
                            <li><a href="<?= Url::to('/site/help2') ?>">Услуги сайта</a></li>
                            <li><a href="<?= Url::to('/site/help2') ?>">Услуги для исполнителя</a></li>
                            <li><a href="<?= Url::to('/site/help2') ?>">Услуги для заказчика</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <h3>Услуги для всех пользователей</h3>
                        <ul>
                            <li><a href="<?= Url::to('/site/help2') ?>">Общие вопросы</a></li>
                            <li><a href="<?= Url::to('/site/help2') ?>">Обмен сообщениями</a></li>
                            <li><a href="<?= Url::to('/site/help2') ?>">Платные функции</a></li>
                            <li><a href="<?= Url::to('/site/help2') ?>">Вопрос-ответ</a></li>
                            <li><a href="<?= Url::to('/site/help2') ?>">Личный счёт и оплата услуг</a></li>
                            <li><a href="<?= Url::to('/site/help2') ?>">Частые вопросы</a></li>
                            <li><a href="<?= Url::to('/site/help2') ?>">Как получить акаунт PRO?</a></li>
                            <li><a href="<?= Url::to('/site/help2') ?>">Как попасть в рекламную ленту  “Карусель”?</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <h3>Как начисляется рейтинг?</h3>
                        <ul>
                            <li><a href="<?= Url::to('/site/help2') ?>">Могут ли пользователи выводить деньги с сайта?</a></li>
                            <li><a href="<?= Url::to('/site/help2') ?>">Почему нельзя выбрать разделы при добавлении портфолио?</a></li>
                            <li><a href="<?= Url::to('/site/help2') ?>">Не пришло письмо на почту</a></li>
                            <li><a href="<?= Url::to('/site/help2') ?>">Как получить от пользователя Отзыв?</a></li>
                            <li><a href="<?= Url::to('/site/help2') ?>">Не могу подтвердить принятие заказа</a></li>


                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <h3>Как заполнять отчёт</h3>
                        <ul>
                            <li><a href="<?= Url::to('/site/help2') ?>">Регистрация</a></li>
                            <li><a href="<?= Url::to('/site/help2') ?>">Исполнитель или Заказчик</a></li>
                            <li><a href="<?= Url::to('/site/help2') ?>">Авторизация и пароль</a></li>
                            <li><a href="<?= Url::to('/site/help2') ?>">Настройки профиля</a></li>
                            <li><a href="<?= Url::to('/site/help2') ?>">Профиль заказчика</a></li>

                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <p><img class="mr10" src="/img/icons/general/q.jpg" alt="">Если остались вопросы обращайтесь <a href="">askme@autotesmer.ru</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
