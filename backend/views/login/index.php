<?php

/** @var $this \yii\web\View */
/** @var $model app\models\LoginModel */
/** @var $networks \common\interfaces\OauthInterface[] */

use yii\helpers\Html;
use \yii\web\View;
use yii\helpers\Url;
use \backend\assets\ICheckAsset;
ICheckAsset::register($this);

$request = \Yii::$app->getRequest();

?>

    <div class="login-box">
        <div class="login-logo">
            <a href="<?= Url::to('@frontend') ?>"><b>AUTOTESMER</b> </a>
        </div><!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">Sign in to start your session</p>
            <form action="<?= Url::to(['login']) ?>" method="post">
                <?= Html :: hiddenInput($request->csrfParam, $request->getCsrfToken(), []); ?>
                <?php if($model->hasErrors('email')): ?>
                <div class="form-error clearfix"><?= $model->getFirstError('email') ?></div>
                <?php endif; ?>
                <div class="form-group has-feedback">

                    <input name="email" type="email" class="form-control" placeholder="Email" value="<?= $model->email ?>">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <?php if($model->hasErrors('password')): ?>
                <div class="form-error"><?= $model->getFirstError('password') ?></div>
                <?php endif; ?>
                <div class="form-group has-feedback">
                    <input name="password" type="password" class="form-control" placeholder="Пароль" value="">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-8">
                        <div class="checkbox icheck">
                            <!--label>
                                <input name="rememberMe" type="checkbox"> Запомнить меня
                            </label-->
                        </div>
                    </div><!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Войти</button>
                    </div><!-- /.col -->
                </div>
            </form>

            <div class="social-auth-links text-center">



            <?php if(count($networks)): ?>
                <p>- OR -</p>
                <?php $class = [
                    'mail.ru' => ['btn-dropbox', 'fa-envelope'],
                    'google' => ['btn-google', 'fa-google'],
                    'vk' => ['btn-vk', 'fa-vk'],
                    'facebook' => ['btn-facebook', 'fa-facebook']
                ];
                foreach($networks as $network): if($network->name == 'mail.ru') continue;?>
                <a href="<?= Url::to(['/oauth/login', 'network' =>  $network->name]) ?>" class="btn btn-block btn-social <?= $class[$network->name][0] ?> btn-flat">
                    <i class="fa <?= $class[$network->name][1] ?>"></i> Войти через <?= ucfirst($network->name) ?>
                </a>
                <?php endforeach; ?>
            <?php endif; ?>
            </div><!-- /.social-auth-links -->

            <!--a href="#" id="remindPassword" >Я забыл пароль</a><br-->

        </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->


<?php


$script = <<< JS
$(function () {
    $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' // optional
    });
});

$('#remindPassword').click(function(e){
    e.preventDefault();
    alert(1);
});


JS;
$this->registerJs($script, View::POS_READY);
