<?php

/** @var $loginForm frontend\models\LoginForm */
/** @var $socials array */

use yii\helpers\Url;
use yii\helpers\Html;
?>
<main>
    <div class="container">
        <div class="enter_page">
            <div class="row">
                <div class="col-md-4 offset-md-4">
                    <h1>
                        <?php if(\Yii::$app->session->hasFlash('order_saved'))
                            echo \Yii::$app->session->getFlash('order_saved');
                            else echo "Вход";
                        ?>
                    </h1>
                    <form name="login-form" action="<?= Url::to(['/login']) ?>" method="post">
                        <?= Html :: hiddenInput(\Yii :: $app->getRequest()->csrfParam, \Yii :: $app->getRequest()->getCsrfToken(), []); ?>
                        <div class="f_group">
                            <label for="">Email</label>
                            <input name="email" type="text" placeholder="Введите email" value="<?= $loginForm->email ?>">
                            <?php if($errors = $loginForm->getErrors('login')) {
                                echo "<div class=\"form-error\">";
                                foreach ($errors as $error) echo "<p>$error</p>";
                                echo "</div>";
                            }
                            ?>
                        </div>
                        <div class="f_group">
                            <label for="">Пароль</label>
                            <input name="password" type="password" placeholder="Введите пароль" value="<?= $loginForm->password ?>">
                            <?php if($errors = $loginForm->getErrors('password')) {
                                echo "<div class=\"form-error\">";
                                foreach ($errors as $error) echo "<p>$error</p>";
                                echo "</div>";
                            }
                            ?>
                            <a href="" class="textcenter">Забыли пароль?</a>
                        </div>
                        <div class="f_group enterbut">
                            <button class="button button_orange button_top_img" style="border: 0;cursor: pointer;" type="submit">ВОЙТИ</button>
                        </div>
                    </form>
                </div>
            </div>


            <?php if(!empty($socials)): ?>

            <div class="row">
                <div class="col-md-4 offset-md-4 orimg">
                    <img src="<?= Url::to('@web/img/common/or.jpg') ?>" alt="">
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 offset-md-4">
                    <div class="enter_socs">
                        <h2>Вход через соц. сети</h2>
                        <div class="com_enters">
                            <?php $images = [
                                'mail.ru' => Url::to('@web/img/common/en_3.jpg'),
                                'vk' => Url::to('@web/img/common/en_1.jpg'),
                                'facebook' => Url::to('@web/img/common/en_2.jpg'),
                            ];

                            foreach($socials as $network): /** @var $social \common\interfaces\OauthInterface */ ?>
                                <a class="<?= 'social-login-' . str_replace('.','_', $network->name) ?>" href="<?= Url::to(['/oauth/login', 'network' =>  $network->name]) ?>">
                                    <img src="<?= $images[$network->name] ?>" alt="">
                                </a>
                            <?php endforeach; ?>

                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>

        </div>
    </div>
</main>
