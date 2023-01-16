<?php

/**
 * @var \common\models\User $user
 * @var string $key
 * @var \frontend\models\InviteForm $model
 */

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;


?>

<div class="background-car">

    <div class="form-container">

        <div class="form-head">
            <img src="<?= Url::to('@web/img/invite/path4.svg') ?>" alt="">
            <img src="<?= Url::to('@web/img/invite/path8.svg') ?>" alt="" style="margin-left: 10px">
        </div>

        <div class="form-content">

            <h2>Добрый день, <?= $user->firstname ?>!</h2>
            <h3> Вы успешно зашли в свой аккаунт сервиса Autotesmer, для завершения введите e-mail</h3>

            <?php $form = ActiveForm::begin([
                'method' => 'post',
                'action' => Url::to(['enter_by_email']),
            ]); ?>
            <?= Html::activeHiddenInput($model,'key') ?>
            <?= $form->field($model, 'email')->textInput(['placeholder' => 'Введите свой email'])->label(false) ?>
            <button class="submit-button">Продолжить</button>
            <?php ActiveForm::end(); ?>



            <span>или используйте</span>

            <div class="socials">
                <a href="<?= Url::to(['enter_by_social', 'social' => 'vk', 'key' => $model->key ]) ?>" class="social vk"></a>
                <a href="<?= Url::to(['enter_by_social', 'social' => 'fb', 'key' => $model->key  ]) ?>" class="social fb"></a>
                <a href="<?= Url::to(['enter_by_social', 'social' => 'mail', 'key' => $model->key  ]) ?>" class="social mail"></a>
                <a href="<?= Url::to(['enter_by_social', 'social' => 'g', 'key' => $model->key  ]) ?>" class="social g"></a>
            </div>

        </div>
    </div>
</div>

