<?php

/** @var $this \yii\web\View */
/** @var $user \common\models\User */

use yii\helpers\Url;

?>
<main>
    <div class="container">
        <div class="reg_exp_page">
            <div class="row">
                <div class="col-md-12">
                    <div class="reg_top_string clearfix active_3">
                        <div class="reg_top_string_item reg_top_string_item_1">
                            <img src="<?= Url::to('@web/img/icons/steps/ok.jpg') ?>" alt=""><span>1. Регистрация учётной записи</span></div>
                        <div class="reg_top_string_item reg_top_string_item_2">
                            <img src="<?= Url::to('@web/img/icons/steps/ok.jpg') ?>" alt=""><span>2. Подтверждение личных данных<br>
                    и создание профиля</span></div>
                        <div class="reg_top_string_item reg_top_string_item_3"><span>3. Подтверждение личности</span></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="reg_exp_page_last">
                        <div class="reg_exp_page_last_1">
                            <img src="<?= Url::to('@web/img/icons/steps/grac.png') ?>" alt="">
                        </div>
                        <div class="reg_exp_page_last_2">Поздравляем!</div>
                        <div class="reg_exp_page_last_3">Вы стали экспертом Autotesmer!</div>
                        <div class="reg_exp_page_last_4">Осталось заполнить профиль, после этого вы сможете бесплатно активировать пакет безлимитного доступа.<br>
                            Он позволит без ограничений откликаться на интересующие вас задания в любой категории.</div>
                        <div class="reg_exp_page_last_5">
                            <a class="button button_orange button_top_img" href="<?= Url::to(['/lk/settings']) ?>">ЗАПОЛНИТЬ ПРОФИЛЬ</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>
