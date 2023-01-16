<?php

/**
 * @var \yii\web\View $this
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
                    <form action="<?= Url::to(['help/search']) ?>">
                        <div class="f_group">
                            <label for="">Найдите ответ на свой вопрос</label>
                            <input name="search" type="text" placeholder="Напишите свой вопрос" required value="<?= $search ?>">
                            <input type="submit" class="searchsubmit">
                        </div>
                    </form>
                    <p class="subp">

                    </p>
                </div>
            </div>
            <div class="help_search_results">




                <div class="row">

                    <?php if(empty($results)): ?>
                    <p>Нет результатов</p>
                    <?php endif; ?>

                    <?php foreach($results as $result): ?>
                        <div class="col-md-12">
                            <a href="<?= $result['page']->url ?>"><h4><?= $result['page']->name ?></h4></a>
                            <p  style="background-color: #f2f2f2"><span style="font-size: 18px; font-weight: bold; color: black">"</span>
                                <?= $result['text'] ?>   <span style="font-size: 18px; font-weight: bold; color: black">"</span>
                            </p>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!--ul class="pagination">
                    <li class="active"><a href="">1</a></li>
                    <li><a href="">2</a></li>
                    <li><a href="">3</a></li>
                    <li><a href="">4</a></li>
                    <li><a href="">5</a></li>
                </ul-->

            </div>
        </div>
    </div>
</main>
