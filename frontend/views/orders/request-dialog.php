<?php
/** @var $this \yii\web\View */
/** @var $request \common\models\Request */
/** @var $id int */
/** @var $currencies array */
/** @var $category string */

use yii\helpers\Url;

?>

<div id="<?= $id ?>" class="row request-dialog">
    <div class="col-md-12">
        <div class="lk_expert_body_acts_item_rew">
            <div class="lk_expert_body_acts_item_rew_brief">
                <h5>Ваш ответ по проекту</h5>

                <form action="<?= Url::to(["/orders/index", 'category' => $category]) ?>" method="post">
                    <input name="id" type="hidden" value="<?= $request->id ?>">
                    <input name="request[expert_id]" type="hidden" value="<?= $request->expert_id ?>">
                    <input name="request[order_id]" type="hidden" value="<?= $request->order_id ?>">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="f_group">
                                <label>Стоимость за услугу</label>
                                <input name="request[price]" type="text" placeholder="Стоимость" value="<?= $request->price ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="f_group">
                                <label></label>
                                <select name="request[currency_id]" disabled>
                                    <option value="1" selected>RUB</option>";
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="f_group">
                                <label>Срок подбора</label>
                                <input name="request[period]" type="text" placeholder="Кол-во" value="<?= $request->period ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="f_group">
                                <label></label>
                                <select name="request[metric]">
                                    <?php foreach( array( /*1 => 'Часов' ,*/ 2 => 'Дней' /*, 3 => 'Недель'*/) as $value => $label){
                                        $selected = $request->metric == $value ? "selected" : '' ;
                                        echo "<option value=\"$value\" $selected>$label</option>";
                                    } ?>
                                </select>


                            </div>
                        </div>
                    </div>

                    <?php if($request->hasErrors()):

                        foreach($request->getErrors() as $field => $messages){
                            foreach($messages as $message)
                                echo "<div>$field : $message</div>";
                        }

                    endif; ?>


                    <div class="row">
                        <div class="col-md-12">
                            <div class="f_group">
                                <label for="">Ваш ответ</label>
                                <textarea name="request[content]" placeholder="Введите текст" cols="30" rows="10"><?= $request->content ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="f_group text-right">
                                <button class="button button_orange button_top_img send-request-button" type="submit">Отправить</button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
