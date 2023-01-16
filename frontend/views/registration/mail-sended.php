<?php
/** @var $this \yii\web\View */
/** @var $key string */

use yii\helpers\Url;

?>
<main>
    <div class="welcome_page">
        <div class="container h-100">
            <div class="row h-100 justify-content-center align-items-center">
                <div class="col-md-12 text-center">
                    <img  class="welimg" src="<?= Url::to('@web/img/icons/general/reg_activate.png') ?>" alt="">
                    <div class="wspam1">Письмо со ссылкой для активации аккаунта выслано на Ваш почтовый ящик.
                        <?php if(YII_ENV_TEST): ?>
                            <p>
                                <a href="<?= Url::to(['/registration/activate', 'key' => $key]) ?>">ссылка для активации</a>
                            </p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
