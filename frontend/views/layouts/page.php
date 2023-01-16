<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use frontend\assets\AppAsset;
use frontend\widgets\CityLangWidget;
use frontend\widgets\IconsBar;
use frontend\widgets\MainMenu;

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
                            <?= MainMenu::widget(['position' => 'main_menu']) ?>
                            <?= IconsBar::widget() ?>
                        </div>


                    </nav>
                </div>
            </div>
        </div>
    </header>

    <?php $style = isset($this->params['image']) ? 'style="background-image: url(' . Url::to($this->params['image']) . ')"' : '' ?>

    <div class="header_image" <?= $style ?>>
        <div class="header_image_inner">
            <div class="container h-100">
                <div class="row h-100 justify-content-center align-items-center">
                    <div class="col-12 text-center">
                        <div class="breads_wrapper dark3">
                            <ul>
                                <li><a href="/">Главная</a></li>
                                <li><span>></span></li>
                                <li><span><?= Html::encode($this->title) ?></span></li>
                            </ul>
                            <h1><?= Html::encode($this->title) ?></h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php echo $content; ?>

    <?php include 'footer.php'; ?>

    <div class="preloader">
        <div class="prl_min"></div>
    </div>

    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>