<?php
/** @var $this \yii\web\View*/
/** @var $from \common\models\User*/
/** @var $to \common\models\User*/
/** @var $order_id \common\models\Order*/
/** @var $button_text string*/

use yii\helpers\Url;

?>


<form action="<?= Url::to(['/reviews/send']) ?>" method="post">
    <input type="hidden" name="from" value="<?= $from ?>">
    <input name="order_id" type="hidden" value="<?= $order_id ?>">
    <input name="to" type="hidden" value="<?= $to ?>">
    <div class="lk_user_body_chat">
        <div class="row">
            <div class="col-md-12">
                <div class="f_group mb10">
                    <label for="">Оставить отзыв</label>
                    <textarea name="review" placeholder="Введите текст" required=""></textarea>
                </div>
            </div>
        </div>
        <div class="c_body_message_send">
            <div class="row">
                <div class="col-md-6 text-left">
                    <div class="revs_check">
                        <label><input name="evaluation" type="radio" value="1" checked><span>+</span></label>
                        <label><input name="evaluation" type="radio" value="-1"><span>-</span></label>
                    </div>
                </div>
                <div class="col-md-6 text-right">
                    <button class="button button_orange button_top_img submit_close_form" href=""><?= $button_text ?></button>
                </div>
            </div>
        </div>
    </div>
</form>
