<?php

/** @var $this \yii\web\View */
/** @var $verification \common\models\PassportVerification */

use frontend\assets\VerificationAsset;
use yii\helpers\Url;
VerificationAsset::register($this);

?>
<div class="verification-block">

    <div class="row steps_lk actaaa">
        <div class="col-md-12">
            <div class="reg_top_string clearfix active_1">
                <div class="reg_top_string_item reg_top_string_item_2 act">
                    <span>1. Подтверждение личности</span></div>
                <div class="reg_top_string_item reg_top_string_item_3">
                    <span>2. Селфи с документом</span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 steps_lk_spabs">
            Поздравляем! Вы успешно прошли верификацию.<br>
            Теперь вы можете загрузить дополнительные документы (сертификаты об образованиее, лицензии, награды)
        </div>
    </div>
    <br>
</div>