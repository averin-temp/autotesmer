<?php


/** @var $this \yii\web\View */
/** @var $model common\models\Order */

use yii\helpers\Url;
use yii\web\View;


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
                    <div class="form_catli">
                        <ul id="commerce_category">
                            <li data-category="1"<?= $model->commerce_category == 1 ? ' class="active"' : '' ?>><img src="<?= Url::to('@web/img/icons/icon_cats/10.png') ?>" alt="">Автобус </li>
                            <li data-category="2"<?= $model->commerce_category == 2 ? ' class="active"' : '' ?>><img src="<?= Url::to('@web/img/icons/icon_cats/11.png') ?>" alt="">Прицеп </li>
                            <li data-category="3"<?= $model->commerce_category == 3 ? ' class="active"' : '' ?>><img src="<?= Url::to('@web/img/icons/icon_cats/12.png') ?>" alt="">Сельскохозяйственная </li>
                            <li data-category="4"<?= $model->commerce_category == 4 ? ' class="active"' : '' ?>><img src="<?= Url::to('@web/img/icons/icon_cats/13.png') ?>" alt="">Строительная  </li>
                            <li data-category="5"<?= $model->commerce_category == 5 ? ' class="active"' : '' ?>><img src="<?= Url::to('@web/img/icons/icon_cats/14.png') ?>" alt="">Коммунальная  </li>
                            <li data-category="6"<?= $model->commerce_category == 6 ? ' class="active"' : '' ?>><img src="<?= Url::to('@web/img/icons/icon_cats/15.png') ?>" alt="">Автокраны </li>
                        </ul>
                    </div>
                </div>

            </div>
            <?php $model->errorField('commerce_category') ?>



            <div class="row">
                <div class="col-md-2">
                    <div class="f_group">
                        <span class="f_group_labl notop">Количество моточасов</span>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="f_group">
                        <input id="moto_hours_from" type="text" placeholder="От" value="<?= $model->moto_hours_from ?>">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="f_group">
                        <input id="moto_hours_to" type="text" placeholder="До" value="<?= $model->moto_hours_to ?>">
                    </div>
                </div>
            </div>
            <?php $model->errorField('moto_hours_from') ?>
            <?php $model->errorField('moto_hours_to') ?>

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
            <?php $model->errorField('original_pts') ?>

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
                        <input type="hidden" name="budget_from" value="">
                        <input type="hidden" name="budget_to" value="">
                        <input type="hidden" name="currency_id" value="">
                        <input type="hidden" name="year_from" value="">
                        <input type="hidden" name="year_to" value="">
                        <input type="hidden" name="mark" value="">
                        <input type="hidden" name="category" value="<?= $model->category ?>">
                        <input type="hidden" name="type" value="<?= $model->type ?>">
                        <input type="hidden" name="commerce_category" value="">
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
    form.find('input[name=category]').val($('#category li.active').attr('data-category'));
    form.find('input[name=type]').val($('#type li.active').attr('data-type'));
    form.find('input[name=commerce_category]').val($('#commerce_category li.active').attr('data-category') );
    form.find('input[name=moto_hours_from]').val($('#moto_hours_from').val() );
    form.find('input[name=moto_hours_to]').val($('#moto_hours_to').val() );
    form.find('input[name=year_to]').val($('#year_to').val() );
    form.find('input[name=year_from]').val($('#year_from').val() );
    form.find('input[name=budget_from]').val($('#budget_from').val() );
    form.find('input[name=budget_to]').val($('#budget_to').val() );
    form.find('input[name=currency_id]').val($('#currency').val() );
    form.find('input[name=mark]').val($('#mark').val() );
    form.find('input[name=original_pts]').val( Number($('#original_pts').is(':checked')) );
    form.find('input[name=comment]').val($('#comment').val() );
    document.getElementById("order_form").submit();
});
JS;

$this->registerJS($script, View::POS_READY);
