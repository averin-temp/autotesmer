<?php
use yii\helpers\Url;

?>


<div class="row">
    <div class="col-md-12">
        <div class="lk_expert_body_acts_item_rew">
            <div class="lk_expert_body_acts_item_rew_brief">
                <h5>Ваш ответ по проекту</h5>
                <form action="<?= Url::to(['/requests/save']) ?>" method="post">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="f_group">
                                <label>Стоимость</label>
                                <input name="price" type="text" placeholder="Стоимость">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="f_group">
                                <label></label>
                                <input name="currency" type="text" placeholder="Руб.">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="f_group">
                                <label>Срок</label>
                                <input name="period_from" type="text" placeholder="Срок">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="f_group">
                                <label></label>
                                <input name="metric" type="text" placeholder="Дней">
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="f_group">
                                <label for="">Ваш ответ</label>
                                <textarea name="content" placeholder="Введите текст" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="f_group text-right">
                                <a class="button button_orange button_top_img send-request-button"
                                   href="">Отправить</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

