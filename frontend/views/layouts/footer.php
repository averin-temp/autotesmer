<?php

use yii\helpers\Url;
use frontend\widgets\FooterMenuWidget;

?>

<footer>
    <div class="container">
        <div class="row">
            <div class="footer_1 col-md-3">
                <div class="footer_1_top"><a href="/"><img class="main_logo" src="<?= Url::to('@web/img/logo.svg') ?>" alt=""></a></div>
                <div class="footer_1_middle">

                </div>
                <div class="footer_1_bot  d-flex " style="display: none !important;">
                    <ul class=" main_menu_ul top_lang_region">
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
                </div>
            </div>
            <div class="footer_2 col-md-2 offset-md-1 footer_min_menu">

                <?= FooterMenuWidget::widget([
                        'position' => 'footer_1'
                ]); ?>

                <!--ul>
                    <li><a href="<?= Url::to('/about') ?>"><i class="fa fa-angle-right"></i> <span>О проекте</span></a></li>
                    <li><a href="<?= Url::to('/help') ?>"><i class="fa fa-angle-right"></i> <span>Помощь</span></a></li>
                    <li><a href="<?= Url::to('/safety') ?>"><i class="fa fa-angle-right"></i> <span>Безопасность</span></a></li>
                    <li><a href="<?= Url::to('/adv') ?>"><i class="fa fa-angle-right"></i> <span>Реклама на сайте</span></a></li>
                </ul-->
            </div>
            <div class="footer_3 col-md-2    footer_min_menu">
                <?= FooterMenuWidget::widget([
                    'position' => 'footer_2'
                ]); ?>
                <!--ul>
                    <li><a href="<?= Url::to('/contacts') ?>"><i class="fa fa-angle-right"></i><span>Контакты</span></a></li>
                    <li><a href="<?= Url::to('/videos') ?>"><i class="fa fa-angle-right"></i><span>Видео</span></a></li>
                    <li><a href="<?= \Yii::$app->user->isGuest ? Url::to(['/login']) : Url::to('/lk') ?>"><i class="fa fa-angle-right"></i><span>Личный кабинет</span></a></li>
                    <li><a href="<?= Url::to('/politic') ?>"><i class="fa fa-angle-right"></i><span>Политика конфиденциальности</span></a></li>
                </ul-->
            </div>
            <div class="footer_4 col-md-3 offset-md-1 ">
                <ul>
                    <li><a href="https://google.com"><i class="fa fa-google-plus"></i></a></li>
                    <li><a href="https://facebook.com"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="https://instagram.com"><i class="fa fa-instagram"></i></a></li>
                </ul>
                <div class="footer_4_bot">
                    <a target="_blank" href="https://www.payu.ru"><img src="/img/icons/Payu.png" alt=""></a>
                </div>
            </div>
        </div>
    </div>
</footer>
