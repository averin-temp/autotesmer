<?php

/** @var $this \yii\web\View */

use yii\helpers\Url;

?>

<main>
    <div class="welcome_page">
        <div class="container h-100">
            <div class="row h-100 justify-content-center align-items-center">
                <div class="col-md-12 text-center">
                    <img  class="welimg" src="/img/icons/general/reg_activate.png" alt="">
                    <div class="wspam1">Вы успешно активировали ваш аккаунт Autotesmer</div>
                    <div class="wspam2">
                        <a class="button button_orange button_top_img" href="<?= Url::to(['/orders/create']) ?>">создать заявку на подбор</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
