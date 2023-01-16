<?php


/** @var $this \yii\web\View */
/** @var $model common\models\Order */

use yii\helpers\Url;
use yii\web\View;
use common\models\Order;
use frontend\assets\SliderAsset;
use frontend\helpers\OrderHelper;

SliderAsset::register($this);

?>
<main class="request_page">
    <div class="container">

        <?php include 'common-fields.php'?>

        <div class="row">
            <div class="col-md-2">
                <div class="f_group">
                    <span class="f_group_labl">Кузов</span>
                </div>
            </div>
            <div class="col-md-10">
                <div class="form_catli">
                    <ul id="auto-body">
                        <li <?= $model->body == 0 ? 'class="active"' : '' ?> data-body="0"><i class="fa fa-search" aria-hidden="true"></i>Любой</li>
                        <?php foreach( Order::bodies($model->category) as $body_id => $label ): ?>
                            <li data-body="<?= $body_id ?>"<?= $body_id == $model->body ? " class=\"active\"" : '' ?>>
                                <img src="<?= Url::to('@web/img/icons/icon_cats/7.png') ?>" alt="">
                                <?= $label ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>

        </div>
        <?php $model->errorField('body') ?>


        <div class="row">
            <div class="col-md-2">
                <div class="f_group">
                    <span class="f_group_labl"><img src="<?= Url::to('@web/img/icons/privod.png' ) ?>" alt="">Привод</span>
                </div>
            </div>
            <div class="col-md-10">
                <div class="form_catli">
                    <ul id="drive">
                        <li <?= $model->drive == 0 ? 'class="active"' : '' ?> data-body="0"><i class="fa fa-search" aria-hidden="true"></i>Любой</li>
                        <?php foreach( Order::drives() as $drive_id => $label ): ?>
                            <li data-drive="<?= $drive_id ?>"<?= $drive_id == $model->drive ? " class=\"active\"" : '' ?>>
                                <?= $label ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
        <?php $model->errorField('drive') ?>


        <div class="row">
            <div class="col-md-2">
                <div class="f_group">
                    <span class="f_group_labl"><img src="<?= Url::to('@web/img/icons/korobka.png') ?>" alt="">Коробка</span>
                </div>
            </div>
            <div class="col-md-10">
                <div class="form_catli">
                    <ul id="transmission">
                        <li <?= $model->transmission == 0 ? 'class="active"' : '' ?> data-body="0"><i class="fa fa-search" aria-hidden="true"></i>Любой</li>
                        <?php foreach( Order::transmissions() as $transmission_id => $label ): ?>
                            <li data-transmission="<?= $transmission_id ?>"<?= $transmission_id == $model->transmission ? " class=\"active\"" : '' ?>>
                                <?= $label ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>

        <?php $model->errorField('transmission') ?>


        <div class="row">
            <div class="col-md-2">
                <div class="f_group">
                    <span class="f_group_labl"><img src="<?= Url::to('@web/img/icons/dvig.png') ?>" alt="">Двигатель</span>
                </div>
            </div>
            <div class="col-md-10">
                <div class="form_catli">
                    <ul id="engine">
                            <li <?= $model->engine == 0 ? 'class="active"' : '' ?> data-body="0"><i class="fa fa-search" aria-hidden="true"></i>Любой</li>
                            <?php foreach( Order::engines($model->category) as $engine_id => $label ): ?>
                            <li data-engine="<?= $engine_id ?>"<?= $engine_id == $model->engine ? " class=\"active\"" : '' ?>>
                                <?= $label ?>
                            </li>
                            <?php endforeach; ?>
                            <li class="chbx_li">
                                <div class="ccheck">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck11">
                                        <label class="custom-control-label" for="customCheck11">Оборудован ГБО</label>
                                    </div>
                                </div>
                            </li>
                    </ul>
                </div>
            </div>
        </div>
        <?php $model->errorField('engine') ?>

        <?= OrderHelper::rangeField(
            'power_from',
            'power_to',
            'Мощность',
            null,
            [
                'step' => '10',
                'low' => $model->power_from,
                'hi' => $model->power_to,
                'label' => 'л.с.',
                'min' => '10',
                'max' => '1000',
            ]
        ) ?>

        <?php $model->errorField('power_from') ?>
        <?php $model->errorField('power_to') ?>


        <?= OrderHelper::rangeField(
            'engine_volume_from',
            'engine_volume_to',
            'Объем двигателя',
            null,
            [
                'step' => '.1',
                'low' => $model->year_from,
                'hi' => $model->year_to,
                'label' => 'л.',
                'min' => '.1',
                'max' => '10',
            ]
        ) ?>

        <?php $model->errorField('engine_volume_from') ?>
        <?php $model->errorField('engine_volume_to') ?>


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
                        <input type="hidden" name="budget_from" value="">
                        <input type="hidden" name="budget_to" value="">
                        <input type="hidden" name="period_from" value="">
                        <input type="hidden" name="period_to" value="">
                        <input type="hidden" name="currency_id" value="">
                        <input type="hidden" name="year_from" value="">
                        <input type="hidden" name="year_to" value="">
                        <input type="hidden" name="mark_id" value="">
                        <input type="hidden" name="model_id" value="">
                        <input type="hidden" name="category" value="<?= $model->category ?>">
                        <input type="hidden" name="type" value="<?= $model->type ?>">

                        <input type="hidden" name="body" value="">
                        <input type="hidden" name="drive" value="">
                        <input type="hidden" name="transmission" value="">
                        <input type="hidden" name="engine" value="">
                        <input type="hidden" name="engine_volume_from" value="">
                        <input type="hidden" name="engine_volume_to" value="">
                        <input type="hidden" name="power_from" value="">
                        <input type="hidden" name="power_to" value="">


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

$('.range-auto-manual-fields').each(function(){
    
    let container = $(this);
    let manualInputs = container.find('.range-fields > input');
    let fromManual = container.find('.range-fields > input:first-child');
    let toManual = container.find('.range-fields > input:last-child');
    let sliderElem = container.find('.input-range');
    let min = parseFloat(sliderElem.data('min'));
    let max = parseFloat(sliderElem.data('max'));
    let low = parseFloat(sliderElem.data('low'));
    let hi = parseFloat(sliderElem.data('hi'));
    let label = sliderElem.data('label');
    
    let slider = container.find('.input-range').slider({
        formatter: function (value) {
            container.find('.slabel_top span').text(value[0]);
            container.find('.slabel_bot span').text(value[1]);
            return value + ' ' + label;
        },
        min: min,
        max: max,
        range: true,
        value: [low,hi],
        tooltip_split: true,
        tooltip: '',
    });
    
    slider.on('change', function(event) {
        fromManual.val(event.value.newValue[0]);
        toManual.val(event.value.newValue[1]);
    });
    
    manualInputs.on('change', function(){
        slider.slider('setValue', [
            Number(fromManual.val()),
            Number(toManual.val())
        ]);
    });
});

$('#send').click(function(){
    $(this).prop('disabled', true);
    
    let form = $('#order_form');
    let year_from = $('#year_from').val();
    let year_to = $('#year_to').val();
    let power_from = $('#power_from').val();
    let power_to = $('#power_to').val();
    let category = $('#category li.active').attr('data-category');
    let type = $('#type li.active').attr('data-type');
    let transmission = $('#transmission li.active').attr('data-transmission');
    let drive = $('#drive li.active').attr('data-drive');
    let body = $('#auto-body li.active').attr('data-body');
    let engine = $('#engine li.active').attr('data-engine');
    let engine_volume_from = $('#engine_volume_from').val();
    let engine_volume_to = $('#engine_volume_to').val();
    let budget_from = $('#budget_from').val();
    let budget_to = $('#budget_to').val();
    let period_from = $('#period_from').val();
    let period_to = $('#period_to').val();
    let mark = $('#mark_id').val();
    let model = $('#model_id').val();
    let original_pts = Number($('#original_pts').is(':checked'));
    let gbo = Number($('#gbo').is(':checked'));
    let comment = $('#comment').val() ;
    
    
    form.find('input[name=category]').val(category);
    form.find('input[name=type]').val(type);
    form.find('input[name=transmission]').val(transmission);
    form.find('input[name=drive]').val(drive);
    form.find('input[name=body]').val(body);
    form.find('input[name=engine]').val(engine);
    form.find('input[name=year_to]').val(year_to);
    form.find('input[name=year_from]').val(year_from);
    form.find('input[name=power_from]').val(power_from );
    form.find('input[name=power_to]').val(power_to);
    form.find('input[name=engine_volume_from]').val(engine_volume_from);
    form.find('input[name=engine_volume_to]').val(engine_volume_to);
    form.find('input[name=budget_from]').val(budget_from);
    form.find('input[name=budget_to]').val(budget_to);
    form.find('input[name=period_from]').val(period_from);
    form.find('input[name=period_to]').val(period_to);
    form.find('input[name=mark_id]').val(mark);
    form.find('input[name=model_id]').val(model);
    form.find('input[name=original_pts]').val(original_pts);
    form.find('input[name=gbo]').val(gbo);
    form.find('input[name=comment]').val(comment);
    
    document.getElementById("order_form").submit();
});

$('#mark_id').change(function(){
    let select = $('#model_id');
    select.prop('disabled', true);
    $.get('/ajax/models', {id: $(this).val() }, function(response){
        select.html(response);
    }).error(function(e){
        console.log(e);
    }).always(function() {
        select.prop('disabled', false);
    });
});



JS;

$this->registerJS($script, View::POS_READY);
