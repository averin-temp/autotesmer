<?php
/**
 * Created by PhpStorm.
 * User: hustler
 * Date: 27.03.2019
 * Time: 12:11
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
<div class="header_image" style="background-image: url(<?=  Url::to('@web/img/types/6.jpg')  ?>);">
    <div class="header_image_inner">
        <div class="container h-100">
            <div class="row h-100 justify-content-center align-items-center">
                <div class="col-12 text-center">

                    <div class="breads_wrapper">
                        <ul>
                            <li><a href="/">Главная</a></li>
                            <li><span>></span></li>
                            <li><span>Безопасность</span></li>
                        </ul>
                        <h1>Безопасность</h1>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


<main>
    <div class="container">
        <div class="row" style="padding: 50px 0;">
            <div class="col-md-12">
                <div class="content">
                    <p>Важнейшей задачей нашего сервиса является создание сообщества технических экспертов и заказчиков,
                        которые друг другу доверяют. Мы делаем все, для того чтобы поиск качественной техники на
                        вторичном рынке был максимально удобным, безопасным и быстрым.</p>
                    <h2>Безопасная сделка</h2>
                    <p>Сервис «Безопасная сделка» дает возможность безопасно оплачивать услуги экспертов и получать
                        деньги на банковскую карту. После выбора эксперта оплата резервируется на специальном счете и
                        хранится там до успешного завершения работ.</p>
                    <p>При оплате услуг через Безопасную сделку Autotesmer гарантирует возврат денег, если что-то пойдет
                        не по плану, а эксперт может быть уверен, что получит согласованную сумму без задержек.
                    </p>
                    <h2>Проверка экспертов</h2>
                    <p>Все эксперты проходят специальную верификацию и онлайн-тест.
                        Также, эксперт может получить значок «Проверенный». Этот статус присваивается тем, кто прошел
                        автоматическую проверку документов Autotesmer
                    </p>
                    <h2>
                        Отзывы и рейтинг
                    </h2>
                    <p>После завершения задания мы просим заказчика оставить отзыв об эксперте. Отзывы о каждом эксперте
                        можно увидеть в его профиле. Мы проверяем их достоверность, а также блокируем экспертов, которые
                        оказывают некачественные услуги.<br>
                        Кроме отзывов, оценить уровень эксперта помогает рейтинг, который рассчитывается в каждой
                        категории.</p>
                    <h2>Рекомендации по безопасности</h2>
                    <p>
                        Эксперты не являются сотрудниками Autotesmer и несут персональную ответственность за качество
                        выполненной работы. При сотрудничестве с любым экспертом, даже если он подтвердил паспорт или вы
                        нашли его в другом месте, мы рекомендуем всегда соблюдать базовые правила безопасности.

                    </p>
                    <ul>
                        <li>- Внимательно изучите отзывы и примеры выполненных заданий.</li>
                        <li>-   Перед началом работы попросите исполнителя показать паспорт, сверьте имя в профиле Autotesmer и в документе.</li>
                        <li>-   Прописывайте все условия и этапы сотрудничества в договоре или смете (скачать образец договора), составляйте расписки о передаче денег (скачать
                            образец расписки).</li>
                        <li>-   Autotesmer рекомендует выбирать работу с экспертом через безопасную сделку и получать отчет по утвержденной форме
                        </li>
                    </ul>
                    <h2>Служба поддержки</h2>
                    <p>Наша служба поддержки ежедневно работает с обращениями пользователей.<br>
                        Специалисты отдела мониторинга готовы помочь в любой сложной ситуации и сделать все возможное, чтобы пользователи ее разрешили.
                    </p>
                    <!--p>
                        <b>8 495 405 55 45</b> (Москва)<br>
                        <b>8 800 753 45 65</b> (для других городов)<br>
                        Поддержка пользователей с 9:00 до 21:00 по московскому времени, без выходных.
                    </p-->
                    <p>
                        Технические проблемы: <a href="mailto:help@autotesmer.ru">help@autotesmer.ru</a><br>
                        Пожелания, предложения: <a href="mailto:offer@autotesmer.ru">offer@autotesmer.ru</a><br>
                        Все вопросы связанные с верификацией экспертов: <a href="mailto:expert@autotesmer.ru">expert@autotesmer.ru</a><br>
                        Проблемы c вводом/выводом денег: <a href="mailto:money@autotesmer.ru">money@autotesmer.ru</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</main>
