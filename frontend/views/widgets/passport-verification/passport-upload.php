<?php

/** @var $this \yii\web\View */
/** @var $verification \common\models\PassportVerification */

use frontend\assets\VerificationAsset;
use yii\helpers\Url;
VerificationAsset::register($this);

?>
<div class="verification-block" >
<div class="row steps_lk actaaa">
    <div class="col-md-12">
        <div class="reg_top_string clearfix active_1">

            <div class="reg_top_string_item reg_top_string_item_2 act">
                <span>1. Подтверждение личности</span></div>
            <div class="reg_top_string_item reg_top_string_item_3"><span>2. Селфи с документом</span>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 steps_lk_spabs">
        Сфотографируйте паспорт. Нам понадобится светлый четкий снимок, на котором видны все углы документа
    </div>
</div>
<br>
<div class="row  align-items-center">
    <div class="col-md-4">
        <form>
            <input type="hidden" name="verification_id" value="<?= $verification->id ?>">

            <div class="f_group labelfrout">
                <label for=""> Фотография </label>
            </div>

            <label for="photo-upload" class="steps_lk_upload text-center">
                <input id="photo-upload" type="file" name="passport_photo">
                <img src="/img/icons/steps/upload.png" alt="">
                <div>
                    Хорошее качество.<br>
                    .jpg или .png<br>
                    Минимальный размер:  600 x 600
                </div>
            </label>
        </form>
    </div>
    <div class="col-md-4">

        <div class="f_group labelfrout">
            <label for=""> Пример </label>
        </div>

        <div class="steps_lk_upload text-center lk_photopr">

        </div>
    </div>
</div>


<br>

<div class="row">
    <div class="col-md-12 text-center">
        <button class="button button_orange button_top_img" type="button" id="to_selfie">Дальше</button>
    </div>
</div>
</div>