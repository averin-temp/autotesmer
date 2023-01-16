<?php
/**
 * @var $this \yii\web\View
 * @var $brief \common\models\Brief;
 */
use common\classes\OrderCategory;
?>


    <h4>Бриф</h4>

    <div class="form-group row">
        <label class="col-sm-4 col-form-label">Марка</label>
        <div class="col-sm-6">
            <input type="text" readonly class="form-control-plaintext" value="<?= $brief->mark->name ?>">
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-4 col-form-label">Модель</label>
        <div class="col-sm-6">
            <input type="text" readonly class="form-control-plaintext" value="<?= $brief->model->name ?>">
        </div>
    </div>


    <div class="form-group row">
        <label class="col-sm-4 col-form-label">Стоимость</label>
        <div class="col-sm-8">
            <input type="text" readonly class="form-control-plaintext" value="<?= $brief->price . ' ' . $brief->currency->abbr ?>">
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-4 col-form-label">Мотор, см^3</label>
        <div class="col-sm-8">
            <input type="text" readonly class="form-control-plaintext" value="<?= $brief->engine_volume ?>">
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-4 col-form-label">КПП</label>
        <div class="col-sm-8">
            <input type="text" readonly class="form-control-plaintext" value="<?=  $brief->transmissionLabel() ?>">
        </div>
    </div>



    <div class="form-group row">
        <label class="col-sm-4 col-form-label" for="inputDrive">Привод</label>
        <div class="col-sm-8">
            <input type="text" readonly class="form-control-plaintext" id="inputDrive" value="<?= $brief->driveLabel() ?>">
        </div>
    </div>

    <?php if(in_array($brief->order->category, [OrderCategory::CATEGORY_FREIGHT, OrderCategory::CATEGORY_AUTO])): ?>
    <div class="form-group row">
        <label class="col-sm-4 col-form-label" for="inputBody">Кузов</label>
        <div class="col-sm-8">
            <input type="text" readonly class="form-control-plaintext" id="inputBody" value="<?= $brief->body ?>">
        </div>
    </div>
    <?php endif; ?>

    <div class="form-group row">
        <label class="col-sm-4 col-form-label">Цвета</label>
        <div class="col-sm-8">
            <input type="text" readonly class="form-control-plaintext" value="<?= $brief->colors ?>">
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-4 col-form-label">Год выпуска, от</label>
        <div class="col-sm-8">
            <input type="text" readonly class="form-control-plaintext" value="<?= $brief->year_from ?>">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-4 col-form-label">Пробег</label>
        <div class="col-sm-8">
            <input type="text" readonly class="form-control-plaintext" value="<?= $brief->mileage ?>">
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-4 col-form-label">Дополнительно</label>
        <div class="col-sm-8">
            <input type="text" readonly class="form-control-plaintext" value="<?= $brief->additionally ?>">
        </div>
    </div>

    <?php if($brief->dial_type == \common\models\Dial::TYPE_SAFE): ?>
    <div class="row">
        <div class="col-md-12">
            <div class="f_group text-right">
                Используется безопасная сделка
            </div>
        </div>
    </div>
    <?php endif; ?>



