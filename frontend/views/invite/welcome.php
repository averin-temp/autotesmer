<?php

/**
 * @var string $key
 */

use yii\helpers\Url;

?>

<div class="background-image">


    <div class="content">

        <div class="logo"></div>

        <h2>Попробуйте бесплатно</h2>
        <h2>Облачная CRM система <br>для автоподбора</h2>

        <div class="icons">
            <div class="icon">
                <img src="<?= Url::to('@web/img/invite/team.svg') ?>" alt="">
                <span>Увеличение<br> потока<br> клиентов</span>

            </div>
            <div class="icon">
                <img src="<?= Url::to('@web/img/invite/card.svg') ?>" alt="">
                <span>Безопасная сделка</span>
            </div>

            <div class="icon">
                <img src="<?= Url::to('@web/img/invite/review.svg') ?>" alt="">
                <span>Рейтинги от<br> клиентов</span>
            </div>

            <div class="icon">
                <img src="<?= Url::to('@web/img/invite/mobile.svg') ?>" alt="">
                <span>Отчет осмотра <br>автомобиля в <br>электронном виде</span>
            </div>
        </div>

        <a href="<?= Url::to(['enter_by_email', 'key' => $key ]) ?>" class="button">Попробовать бесплатно</a>

    </div>



</div>