<?php

/**
 * @var $this \yii\web\View
 * @var $model \frontend\models\ClientRegistration
 * @var $cities array
 */

use frontend\assets\InputmaskAsset;
use yii\helpers\Url;

InputmaskAsset::register($this);
?>
<main>
    <div class="container">
        <div class="enter_page">
            <div class="row">
                <div class="col-md-4 offset-md-4">
                    <h1>Регистрация</h1>
                </div>
            </div>
            <?= \frontend\widgets\SocialRegistrationWidget::widget(['userType' => 1 ]) ?>
            <form id="client-registration-form" action="<?= Url::to(['/registration/client']) ?>" method="post">
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <div class="f_group">
                            <label for="">Фамилия</label>
                            <input name="family" type="text" placeholder="Введите фамилию" required value="<?= $model->family ?>">
                        </div>
                        <?php $model->errorField('family') ?>
                    </div>
                    <div class="col-md-8 offset-md-2">
                        <div class="f_group">
                            <label for="">Имя</label>
                            <input name="firstname" type="text" placeholder="Введите имя" required value="<?= $model->firstname ?>">
                        </div>
                        <?php $model->errorField('firstname') ?>
                    </div>
                    <div class="col-md-8 offset-md-2">
                        <div class="f_group">
                            <label for="">Отчество</label>
                            <input name="lastname" type="text" placeholder="Введите отчество" required value="<?= $model->lastname ?>">
                        </div>
                        <?php $model->errorField('lastname') ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 offset-md-2">
                        <div class="f_group">
                            <label for="">Телефон</label>
                            <input name="phone" type="text" required value="<?= \common\classes\DataHelper::prettyPhone($model->phone) ?>">
                        </div>
                        <?php $model->errorField('phone') ?>
                    </div>
                    <div class="col-md-4">
                        <div class="f_group">
                            <label for="">Электронная почта</label>
                            <input name="email" type="text" placeholder="Введите e-mail" required value="<?= $model->email ?>">
                        </div>
                        <?php $model->errorField('email') ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <div class="f_group">
                            <label for="">Город</label>
                            <select name="city">
                            <?php foreach($cities as $city): ?>
                                <option value="<?= $city['id'] ?>"<?=  $city['id'] == $model->city ? " selected" : '' ?>><?= $city['name'] ?></option>
                            <?php endforeach; ?>
                            </select>
                        </div>
                        <?php $model->errorField('city') ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 offset-md-2">
                        <div class="f_group">
                            <label for="">Пароль</label>
                            <input name="password" type="password" required>
                        </div>
                        <?php $model->errorField('password') ?>
                    </div>
                    <div class="col-md-4">
                        <div class="f_group">
                            <label for="">Повторите пароль</label>
                            <input name="confirm" type="password" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <div class="f_group enterbut">
                            <button class="button button_orange button_top_img" href="">Зарегистрироваться</button>
                        </div>
                    </div>
                </div>
            </form>





        </div>

    </div>

</main>

<?php
if(!YII_ENV_TEST){

$script = <<< JS
$('input[name=phone]').inputmask("+9 (999) 999-99-99");
JS;
$this->registerJs($script, \yii\web\View::POS_READY, 'client-reg-form-script');

}

