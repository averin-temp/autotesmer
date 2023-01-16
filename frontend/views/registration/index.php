<?php

use yii\helpers\Url;

?>
<main>
    <div class="register_page clearfix">
        <div class="register_page_left">
            <div class="register_page_left_top">Я клиент</div>
            <div class="register_page_left_bot">
                <a class="button button_orange button_top_img" href="<?= Url::to('/registration/client') ?>">Регистрация</a>
            </div>
        </div>
        <div class="register_page_right">
            <div class="register_page_right_top">Я эксперт</div>
            <div class="register_page_right_bot">
                <a class="button button_orange button_top_img" href="<?= Url::to('/registration/expert') ?>">Регистрация</a>
            </div>
        </div>
    </div>
</main>
