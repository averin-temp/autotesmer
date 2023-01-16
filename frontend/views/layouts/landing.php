<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use frontend\assets\AppAsset;
use frontend\widgets\IconsBar;
use frontend\widgets\MainMenu;
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
<header class="main_header">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <nav class="navbar navbar-expand-lg navbar-dark bg-light main-navigation">
                    <a class="navbar-brand" href="/">
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



<div class="header_height_main scroll_height">
    <div class="video_bg_header">
        <div id="trailer" class="is_overlay">
            <video id="video" width="100%" height="auto" autoplay="autoplay" loop="loop" muted>
                <source src="<?= Url::to('@web/video/video.mp4') ?>" type="video/mp4">
                <source src="<?= Url::to('@web/video/video.webm') ?>" type="video/webm">
                <source src="<?= Url::to('@web/video/video.ogv') ?>" type="video/ogg"/>
            </video>
        </div>
        <div class="vidercross"></div>
    </div>
    <div class="video_bg_content">
        <div class="container">
            <div class="mp_main_top">
                <div class="mp_main_top_header">
                    <span style="font-size: 24px">Помощь в покупке авто с пробегом</span><br>
                    <span style="font-size: 16px">с юридической проверкой, полной диагностикой, гарантией в договоре и электронным отчетом</span><br>
                    <span style="font-size: 14px">Поможем найти надежного эксперта для подбора любого автомобиля с пробегом в РФ</span><br>
                </div>
            </div>
            <div class="mp_main_middle d-none d-lg-block">
                <div class="mp_main_middle_top"   style="display: none">
                    <ul class="mp_main_middle_top_top  ttp justify-content-center d-flex align-items-center" id="category">
                        <li data-category="2" class="active">
                            <img class="a" src="<?= Url::to('@web/img/icons/main_top/icon1.png') ?>" alt="">
                            <img class="na" src="<?= Url::to('@web/img/icons/main_top/icon1_h.png') ?>" alt="">
                            <span>Грузовая</span>
                        </li>
                        <li data-category="3">
                            <img class="a" src="<?= Url::to('@web/img/icons/main_top/icon2.png') ?>" alt="">
                            <img class="na" src="<?= Url::to('@web/img/icons/main_top/icon2_h.png') ?>" alt="">
                            <span>Мото</span>
                        </li>
                        <li data-category="1">
                            <img class="a" src="<?= Url::to('@web/img/icons/main_top/icon3.png') ?>" alt="">
                            <img class="na" src="<?= Url::to('@web/img/icons/main_top/icon3_h.png') ?>" alt="">
                            <span>Легковая</span>
                        </li>
                        <li data-category="4">
                            <img class="a" src="<?= Url::to('@web/img/icons/main_top/icon4.png') ?>" alt="">
                            <img class="na" src="<?= Url::to('@web/img/icons/main_top/icon4_h.png') ?>" alt="">
                            <span> Коммерческий <br>транспорт</span>
                        </li>
                        <li data-category="5">
                            <img class="a" src="<?= Url::to('@web/img/icons/main_top/icon5.png') ?>" alt="">
                            <img class="na" src="<?= Url::to('@web/img/icons/main_top/icon5_h.png') ?>" alt="">
                            <span>Водный <br> транспорт</span>
                        </li>
                    </ul>
                </div>
                <div class="mp_main_middle_bot mp_main_middle_top">
                    <ul class="mp_main_middle_top_top mp_main_middle_top_bot justify-content-center d-flex align-items-center"  id="type">
                        <li data-type="1">
                            <img class="a" src="<?= Url::to('@web/img/icons/main_top/icon6.png') ?>" alt="">
                            <img class="na" src="<?= Url::to('@web/img/icons/main_top/icon6_h.png') ?>" alt="">
                            <span>Разовый осмотр</span>
                        </li>
                        <li data-type="2" class="active">
                            <img class="a" src="<?= Url::to('@web/img/icons/main_top/icon7.png') ?>" alt="">
                            <img class="na" src="<?= Url::to('@web/img/icons/main_top/icon7_h.png') ?>" alt="">
                            <span>Эксперт на день</span>
                        </li>
                        <li data-type="3">
                            <img class="a" src="<?= Url::to('@web/img/icons/main_top/icon8.png') ?>" alt="">
                            <img class="na" src="<?= Url::to('@web/img/icons/main_top/icon8_h.png') ?>" alt="">
                            <span>Подбор под ключ</span>
                        </li>

                    </ul>
                </div>
            </div>
            <div class="mp_main_bot">
                <a id="create_order" class="button button_orange button_top_img" href="<?= Url::to(['//orders/create']) ?>">создать заявку на подбор</a>
            </div>
            <?php if(\Yii::$app->user->isGuest || !\Yii::$app->user->can('Эксперт')) : ?>
            <div class="mp_main_bot_bot">
                <a href="<?= Url::to(['/registration/expert']) ?>" class="mp_main_bot_bot_button">
                    <img src="<?= Url::to('@web/img/icons/general/key.png') ?>" alt="">
                    <span>стать экспертом</span>
                </a>
            </div>
            <?php endif; ?>

            <div class="mp_main_top_header">
                <span style="font-size: 12px">Сайт работает в тестовом режиме</span><br>
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

<script>
    $(document).ready(function(){
        $('#create_order').on('click', function(e){
            e.preventDefault();
            let category = 1;//$('#category li.active').attr('data-category');
            let type = $('#type li.active').attr('data-type');
            window.location = $(this).attr('href') + "?category=" + category + "&type=" + type;
        });
    })
</script>

</body>
</html>
<?php $this->endPage() ?>