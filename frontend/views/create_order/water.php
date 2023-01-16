<?php


/** @var $this \yii\web\View */
/** @var $model common\models\Order */

use yii\helpers\Url;
use yii\web\View;
use common\models\Order;

?>
    <main class="request_page">
        <div class="container">

            <?php include 'common-fields.php'?>

            <div class="row">
                <div class="col-md-2">
                    <div class="f_group">
                        <span class="f_group_labl">Категория</span>
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="form_catli" id="water_category">
                        <?php foreach( Order::subcategories($model->category) as $sub_id => $label ): ?>
                            <li data-category="<?= $sub_id ?>"<?= $sub_id == $model->water_category ? " class=\"active\"" : '' ?>>
                                <i></i> <?= $label ?>
                            </li>
                        <?php endforeach; ?>
                    </div>
                </div>

            </div>

            <?php $model->errorField('water_category') ?>

            <div class="row">
                <div class="col-md-2">
                    <div class="f_group">
                        <span class="f_group_labl notop">Количество моточасов</span>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="f_group">
                        <input type="text" placeholder="От" id="moto_hours_from" value="<?= $model->moto_hours_from ?>">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="f_group">
                        <input type="text" placeholder="До" id="moto_hours_to" value="<?= $model->moto_hours_to ?>">
                    </div>
                </div>
            </div>

            <?php $model->errorField('moto_hours_from') ?>
            <?php $model->errorField('moto_hours_to') ?>

            <div class="row">
                <div class="col-md-2">
                    <div class="f_group">
                        <span class="f_group_labl">Мощность</span>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="f_group">
                        <input id="power_from" type="text" placeholder="От" value="<?= $model->power_from ?>">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="f_group">
                        <input id="power_to" type="text" placeholder="До" value="<?= $model->power_to ?>">
                    </div>
                </div>
            </div>

            <?php $model->errorField('power_from') ?>
            <?php $model->errorField('power_to') ?>

            <div class="row">
                <div class="col-md-12">
                    <div class="reg_exp_page_3332 ccheck">
                        <div class="custom-control custom-checkbox">
                            <input id="original_pts" type="checkbox" class="custom-control-input"<?= $model->original_pts ? ' checked' : '' ?>>
                            <label class="custom-control-label" for="original_pts">Оригинал ПТС</label>
                        </div>
                    </div>
                </div>
            </div>

            <br>

            <div class="row">
                <div class="col-md-2">
                    <div class="f_group">
                        <span class="f_group_labl">Комментарий</span>
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="f_group">
                        <textarea name="comment" id="comment" cols="30" rows="10"><?= $model->comment ?></textarea>
                    </div>
                </div>
            </div>

            <?php $model->errorField('comment') ?>



            <br>

            <div class="row">
                <div class="col-md-12 text-center">
                    <form id="order_form" action="<?= Url::to(['/orders/save']) ?>" method="post">
                        <input type="hidden" name="id" value="<?= $model->id ?>">
                        <input type="hidden" name="category" value="<?= $model->category ?>">
                        <input type="hidden" name="type" value="<?= $model->type ?>">

                        <input type="hidden" name="budget_from" value="">
                        <input type="hidden" name="budget_to" value="">
                        <input type="hidden" name="currency_id" value="">

                        <input type="hidden" name="water_category" value="">

                        <input type="hidden" name="year_to" value="">
                        <input type="hidden" name="year_from" value="">
                        <input type="hidden" name="mark" value="">

                        <input type="hidden" name="power_from" value="">
                        <input type="hidden" name="power_to" value="">

                        <input type="hidden" name="moto_hours_from" value="">
                        <input type="hidden" name="moto_hours_to" value="">
                        <input type="hidden" name="original_pts" value="">
                        <input type="hidden" name="comment" value="">
                        <button id="send" type="button" class="button button_orange button_top_img">создать заявку на подбор</button>
                    </form>
                </div>
            </div>
        </div>
    </main>

<?php

$script = <<< JS
$('li[data-link]').click(function(){ 
    if(!$(this).hasClass('active')) 
        window.location = $(this).attr('data-link');
});

$('#send').click(function(){
    $(this).prop('disabled', true);
    let form = $('#order_form');
    form.find('input[name=type]').val($('#type li.active').attr('data-type'));
    form.find('input[name=water_category]').val($('#water_category li.active').attr('data-category'));
    form.find('input[name=year_to]').val($('#year_to').val() );
    form.find('input[name=year_from]').val($('#year_from').val() );
    form.find('input[name=budget_from]').val($('#budget_from').val() );
    form.find('input[name=budget_to]').val($('#budget_to').val() );
    form.find('input[name=currency_id]').val($('#currency').val() );
    form.find('input[name=mark]').val($('#mark').val() );
    form.find('input[name=original_pts]').val( Number($('#original_pts').is(':checked')) );
    form.find('input[name=moto_hours_from]').val($('#moto_hours_from').val() );
    form.find('input[name=moto_hours_to]').val($('#moto_hours_to').val() );
    form.find('input[name=comment]').val($('#comment').val() );
    form.find('input[name=power_from]').val($('#power_from').val() );
    form.find('input[name=power_to]').val($('#power_to').val() );
    
    
    document.getElementById("order_form").submit();
});
JS;

$this->registerJS($script, View::POS_READY);
