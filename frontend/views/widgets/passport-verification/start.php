<?php

/** @var $this \yii\web\View */
/** @var $verification \common\models\PassportVerification */

use frontend\assets\VerificationAsset;
use yii\helpers\Url;
VerificationAsset::register($this);

?>

<div class="verification-block">
    <div class="row steps_lk">
        <div class="col-md-12">
            <div class="reg_top_string clearfix active_1">

                <div class="reg_top_string_item reg_top_string_item_2">
                    <span>1. Подтверждение личности</span></div>
                <div class="reg_top_string_item reg_top_string_item_3"><span>2. Селфи с документом</span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 steps_lk_spabs">
            Выполнять задания Autotesmer могут только эксперты, которые прошли процедуру
            верификации.<br>
            Чтобы подтвердить аккаунт, следуйте инструкциям на экране.
        </div>
    </div>

    <br>

    <div class="row">


        <div class="col-md-12">
            <div class="reg_exp_page_3332 ccheck">

                <div class="field-checkbox">
                    <input type="checkbox" id="user_agreement" name="user_agreement" <?= $verification->user_agreement ? 'checked' : '' ?>>
                    <label for="user_agreement"></label>
                    <span>Нажимая "Дальше", я принимаю условия
                        <a href="<?= Url::to(['/page']) ?>">Пользовательского соглашения</a></span>
                </div>

                <?php if($verification->hasErrors('user_agreement')) echo $verification->getFirstError('user_agreement') ?>

                <div class="field-checkbox">
                    <input type="checkbox" id="data_processing" name="data_processing" <?= $verification->data_processing ? 'checked' : '' ?>>
                    <label for="data_processing"></label>
                    <span>Я даю согласие на обработку моих персональных данных в соответствии с
                        <a href="<?= Url::to(['/page']) ?>">Политикой конфиденциальности</a></span>
                </div>

                <?php if($verification->hasErrors('data_processing')) echo $verification->getFirstError('data_processing') ?>

            </div>
        </div>

    </div>



    <br>
    <?php if(isset($errors)) echo $errors ?>
    <br>
    <div class="row">
        <div class="col-md-12 text-center">
            <button id="verification-next" type="button" class="button button_orange button_top_img">дальше</button>
        </div>
    </div>




</div>
