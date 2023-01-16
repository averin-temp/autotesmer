<?php
/**
 * Created by PhpStorm.
 * User: hustler
 * Date: 27.03.2019
 * Time: 7:49
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
<div class="header_image" style="background-image: url(<?=  Url::to('@web/img/types/1.jpg')  ?>);">
    <div class="header_image_inner">
        <div class="container h-100">
            <div class="row h-100 justify-content-center align-items-center">
                <div class="col-12 text-center">

                    <div class="breads_wrapper">
                        <ul>
                            <li><a href="/">Главная</a></li>
                            <li><span>></span></li>
                            <li><span>О проекте</span></li>
                        </ul>
                        <h1>О проекте</h1>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<main class="request_page">
    <div class="container">
        <div class="row ">
            <div class="col-md-2">
                <div class="f_group">
                    <span class="f_group_labl">Категория</span>
                </div>
            </div>
            <div class="col-md-10">
                <div class="form_catli_top">
                    <ul>
                        <li><img src="/img/icons/ccats/1.png" alt=""><img src="/img/icons/ccats/1_h.png" alt=""><span>Легковая</span></li>
                        <li class="active"><img src="/img/icons/ccats/2.png" alt=""><img src="/img/icons/ccats/2_h.png" alt=""><span>Грузовая</span></li>
                        <li><img src="/img/icons/ccats/3.png" alt=""><img src="/img/icons/ccats/3_h.png" alt=""><span>Мото</span></li>
                        <li><img src="/img/icons/ccats/4.png" alt=""><img src="/img/icons/ccats/4_h.png" alt=""><span> Коммерческий транспорт</span></li>
                        <li><img src="/img/icons/ccats/5.png" alt=""><img src="/img/icons/ccats/5_h.png" alt=""><span>Водный транспорт</span></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row ">
            <div class="col-md-2">
                <div class="f_group">
                    <span class="f_group_labl">Тип подбора</span>
                </div>
            </div>
            <div class="col-md-10">
                <div class="form_catli_top">
                    <ul>
                        <li class="active"><img src="/img/icons/ccats2/1.png" alt=""><img src="/img/icons/ccats2/1_h.png" alt=""><span>Разовый осмотр<img src="/img/icons/ccats2/que.png" alt=""></span></li>
                        <li><img src="/img/icons/ccats2/2.png" alt=""><img src="/img/icons/ccats2/2_h.png" alt=""><span>Эксперт на день<img src="/img/icons/ccats2/que.png" alt=""></span></li>
                        <li><img src="/img/icons/ccats2/3.png" alt=""><img src="/img/icons/ccats2/3_h.png" alt=""><span>Подбор под ключ<img src="/img/icons/ccats2/que.png" alt=""></span></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="rdevid"></div>
        <form action="">
            <div class="row">
                <div class="col-md-2">
                    <div class="f_group">
                        <span class="f_group_labl"><img src="/img/icons/money.png" alt="">Бюджет *</span>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="f_group">
                        <input type="text" placeholder="От" required="">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="f_group">
                        <input type="text" placeholder="До" required="">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="f_group">
                        <input type="text" placeholder="Руб." required="">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <div class="f_group">
                        <span class="f_group_labl">Марка</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="f_group">
                        <input type="text" placeholder="Введите e-mail" required="">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="f_group">
                        <a href="" class="suba suba2">+ добавить еще марку</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <div class="f_group">
                        <span class="f_group_labl">ыпуска</span>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="f_group">
                        <input type="text" placeholder="От" required="">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="f_group">
                        <input type="text" placeholder="До" required="">
                    </div>
                </div>
            </div>



            <div class="row">
                <div class="col-md-2">
                    <div class="f_group">
                        <span class="f_group_labl">Кузов</span>
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="form_catli">
                        <ul>
                            <li class="active"><img src="/img/icons/icon_cats/16.png" alt="">Седан</li>
                            <li><img src="/img/icons/icon_cats/17.png" alt="">Хэтчбек</li>
                            <li><img src="/img/icons/icon_cats/18.png" alt="">Лифтбек</li>
                            <li><img src="/img/icons/icon_cats/19.png" alt="">Внедорожник</li>
                            <li><img src="/img/icons/icon_cats/20.png" alt="">Универсал</li>
                            <li><img src="/img/icons/icon_cats/21.png" alt="">Купе</li>
                            <li><img src="/img/icons/icon_cats/22.png" alt="">Минивэн</li>
                            <li><img src="/img/icons/icon_cats/23.png" alt="">Пикап</li>
                            <li><img src="/img/icons/icon_cats/24.png" alt="">Лимузин</li>
                            <li><img src="/img/icons/icon_cats/25.png" alt="">Фургон</li>
                            <li><img src="/img/icons/icon_cats/26.png" alt="">Кабриолет</li>
                        </ul>
                    </div>
                </div>

            </div>



            <div class="row">
                <div class="col-md-2">
                    <div class="f_group">
                        <span class="f_group_labl"><img src="/img/icons/privod.png" alt="">Привод</span>
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="form_catli">
                        <ul>
                            <li class="active">Задний</li>
                            <li>Передний</li>
                            <li>Полный</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <div class="f_group">
                        <span class="f_group_labl"><img src="/img/icons/korobka.png" alt="">Коробка</span>
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="form_catli">
                        <ul>
                            <li>Ручная</li>
                            <li>Автомат</li>
                            <li>Вариатор</li>
                            <li>Робот</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <div class="f_group">
                        <span class="f_group_labl"><img src="/img/icons/dvig.png" alt="">Двигатель</span>
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="form_catli">
                        <ul>
                            <li>Дизельный</li>
                            <li>Электрически</li>
                            <li>Бензиновый</li>
                            <li>Гибридный</li>
                            <li class="chbx_li">
                                <div class="ccheck">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck11">
                                        <label class="custom-control-label" for="customCheck11">Оборудован ГБО</label>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-2">
                    <div class="f_group">
                        <span class="f_group_labl">Мощность</span>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="f_group">
                        <input type="text" placeholder="От" required="">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="f_group">
                        <input type="text" placeholder="До" required="">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-2">
                    <div class="f_group">
                        <span class="f_group_labl">Объем двигателя</span>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="f_group">
                        <input type="text" placeholder="От" required="">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="f_group">
                        <input type="text" placeholder="До" required="">
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-12">
                    <div class="reg_exp_page_3332 ccheck">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="customCheck1">
                            <label class="custom-control-label" for="customCheck1">Оригинал ПТС</label>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12 text-center">
                    <a class="button button_orange button_top_img" href="">создать заявку на подбор</a>
                </div>
            </div>
        </form>
    </div>
</main>
