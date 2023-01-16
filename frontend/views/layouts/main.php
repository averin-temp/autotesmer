<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use frontend\assets\AppAsset;
use frontend\widgets\IconsBar;
use frontend\widgets\CityLangWidget;

AppAsset::register($this);

?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="ru">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <link rel="shortcut icon" href="<?= Url::to('@web/img/tech_icons/favicon.png') ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
    <?php $this->beginBody() ?>
    <header class="main_header dark3">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <nav class="navbar navbar-expand-lg navbar-dark bg-light main-navigation">
                        <a class="navbar-brand" href="/">
                            <!--<img class="main_logo" src="img/logo.png" alt="">-->
                            <img class="main_logo" src="<?= Url::to('@web/img/logo.svg') ?>" alt="">
                        </a>

                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <?= CityLangWidget::widget() ?>


                            <ul class="navbar-nav mr-auto ml-auto main_menu_ul menul">
                                <li class="nav-item active">
                                    <a class="nav-link" href="<?= Url::to('/about') ?>">О проекте <span class="sr-only">(current)</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?= Url::to('/experts') ?>">Эксперты</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?= Url::to('/orders') ?>">Заказы</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?= Url::to('/help') ?>">Помощь</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?= Url::to('/contacts') ?>">Контакты</a>
                                </li>


                            </ul>

                            <?= IconsBar::widget() ?>

                        </div>


                    </nav>
                </div>
            </div>
        </div>
    </header>

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

    <div class="header_out"></div>

    <?php echo $content; ?>

    <?php include 'footer.php'; ?>

    <div class="preloader">
        <div class="prl_min"></div>
    </div>


    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>