<?php
/** @var $this \yii\web\View */
/** @var $model \common\models\Advertising */

use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

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
<div class="header_image" style="background-image: url(<?=  Url::to('@web/img/types/8.jpg')  ?>);">
    <div class="header_image_inner">
        <div class="container h-100">
            <div class="row h-100 justify-content-center align-items-center">
                <div class="col-12 text-center">

                    <div class="breads_wrapper">
                        <ul>
                            <li><a href="/">Главная</a></li>
                            <li><span>></span></li>
                            <li><span>Реклама на сайте</span></li>
                        </ul>
                        <h1>Реклама на сайте</h1>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


<main>
    <div class="content" style="padding: 50px 0;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p>
                        Autotesmer — первый он-лайн сервис рунета объединяющий экспертов по все всем видам транспорта:
                        от легкового до коммерческого, от ретроавтомобилей до суперкаров.<br>
                        Тысячи людей ежедневно приходят к нам, чтобы найти себе качественную технику на вторичном рынке.
                    </p>
                    <br>
                    <p>
                        Для  размещения баннерной рекламы на Autotesmer обращайтесь offer@autotesmer.ru
                    </p>
                </div>
            </div>
        </div>
        <div class="adv_block">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="reg_exp_page_3">
                            <h2>Социальные сети </h2>
                        </div>
                    </div>
                </div>

                <?php if($message = \Yii::$app->session->getFlash('advertising-message')) : ?>
                    <div class="advertising-message"><?= $message ?></div>
                <?php else: ?>

                <?php $form = ActiveForm::begin( [
                        'action' => Url::to(['/advertising/send']) ,
                        'method' => 'POST',
                        'fieldConfig' => [ 'template' => "{label}\n{input}\n{error}" ],
                ]) ?>

                <div class="row">
                    <div class="col-md-4">
                        <div class="f_group">
                            <?= $form->field($model, 'name') ?>

                            <!--label for=""> Ваше имя</label>
                            <input type="text" placeholder="Ваше имя" required=""-->
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="f_group">
                            <?= $form->field($model, 'phone') ?>
                            <!--label for=""> Телефон</label>
                            <input type="text" placeholder="+ 7 (___) ___-__-__" required=""-->
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="f_group">
                            <?= $form->field($model, 'email') ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="f_group">
                            <?= $form->field($model, 'website') ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 offset-md-5">
                        <?= Html::submitButton("Отправить заявку", ['id' => "send-request",  'class' => "but-wifth button button_orange button_top_img"]) ?>
                    </div>
                </div>


                <?php ActiveForm::end() ?>

                <?php endif; ?>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Партнерская программа (Нативная реклама). Что мы предлагаем? </h1>
                    <h2>Доступ к целевой аудитории</h2>
                    <p>Потребители взаимодействуют с брендом напрямую, что помогает решать имиджевые задачи и повышать лояльность целевой аудитории.

                    <ul class="ulora">
                        <li>(Пример: Закажите подбор под ключ и получите антикоррозийную обработку кузова вашего автомобиля в подарок от Ruststop)</li>
                        <li>1)Разместите заявку на подбор под ключ</li>
                        <li>2)Выберите эксперта со специальным значком Ruststop</li>
                        <li>3)Получите бесплатно антикоррозийную обработку и подарок от компании Ruststop)</li>
                    </ul>
                    </p>
                    <br>
                    <h2>Тест драйв продукции</h2>
                    <p>Эксперты и заказчики пользуются товарами бренда для своего транспорта или во время работы. Положительные эмоции от подарков оказывают влияние на выбор продукции при последующих покупках.</p>
                    <br>
                    <h2>Рекомендации экспертов</h2>
                    <p>Участие в cовместных рекламных проектах помогает экспертам повысить рейтинг Autotesmer. Они с большей вероятностью будут рекомендовать продукцию бренда своим клиентам.</p>
                </div>
            </div>
        </div>
    </div>
</main>
