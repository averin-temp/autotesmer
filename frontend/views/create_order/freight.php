<?php

/** @var $this \yii\web\View */
/** @var $model common\models\Order */
/** @var $currencies array */

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
                        <span class="f_group_labl">Кузов</span>
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="form_catli">
                        <ul id="auto-body">
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

            <?php $model->errorField('auto-body') ?>

            <div class="row">
                <div class="col-md-2">
                    <div class="f_group">
                        <span class="f_group_labl">Масса</span>
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="form_catli">
                        <ul id="mass">
                            <?php foreach( Order::masses() as $mass_id => $label ): ?>
                                <li data-mass="<?= $mass_id ?>"<?= $mass_id == $model->mass ? " class=\"active\"" : '' ?>>
                                    <?= $label ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>

            <?php $model->errorField('mass') ?>


            <div class="row">
                <div class="col-md-2">
                    <div class="f_group">
                        <span class="f_group_labl"><img src="<?= Url::to('@web/img/icons/privod.png' ) ?>" alt="">Привод</span>
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="form_catli">
                        <ul id="drive">
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
                            <?php foreach( Order::engines($model->category) as $engine_id => $label ): ?>
                                <li data-engine="<?= $engine_id ?>"<?= $engine_id == $model->engine ? " class=\"active\"" : '' ?>>
                                    <?= $label ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>

            <?php $model->errorField('engine') ?>

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
                        <input type="hidden" name="transmission" value="">
                        <input type="hidden" name="drive" value="">
                        <input type="hidden" name="body" value="">
                        <input type="hidden" name="year_to" value="">
                        <input type="hidden" name="year_from" value="">
                        <input type="hidden" name="mark" value="">
                        <input type="hidden" name="mass" value="">
                        <input type="hidden" name="engine" value="">
                        <input type="hidden" name="currency_id" value="">
                        <input type="hidden" name="category" value="<?= $model->category ?>">
                        <input type="hidden" name="type" value="<?= $model->type ?>">
                        <input type="hidden" name="budget_from" value="">
                        <input type="hidden" name="budget_to" value="">
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
    form.find('input[name=transmission]').val($('#transmission li.active').attr('data-transmission'));
    form.find('input[name=drive]').val($('#drive li.active').attr('data-drive'));
    form.find('input[name=body]').val($('#auto-body li.active').attr('data-body'));
    form.find('input[name=mass]').val($('#mass li.active').attr('data-mass'));
    form.find('input[name=engine]').val($('#engine li.active').attr('data-engine'));
    form.find('input[name=year_to]').val($('#year_to').val() );
    form.find('input[name=year_from]').val($('#year_from').val() );
    form.find('input[name=budget_from]').val($('#budget_from').val() );
    form.find('input[name=budget_to]').val($('#budget_to').val() );
    form.find('input[name=currency_id]').val($('#currency').val() );
    form.find('input[name=mark]').val($('#mark').val() );
    form.find('input[name=comment]').val($('#comment').val() );
    form.find('input[name=original_pts]').val( Number($('#original_pts').is(':checked')) );
    document.getElementById("order_form").submit();
});
JS;

$this->registerJS($script, View::POS_READY);
