<?php
/**
 * @var $model \common\models\Brief
 * @var $currencies array
 * @var $marks \common\models\VehicleBrand[]
 * @var $models \common\models\VehicleModel[]
 * @var $transmissions array
 * @var $drives array
 * @var $bodies array
 */
use yii\helpers\Url;
use common\classes\OrderCategory;

?>
<div class="row">
    <style>
        .form-error{
            color: red;
        }
    </style>
    <form action="<?= Url::to(['/expert/new']) ?>" method="post">
        <input type="hidden" name="id" value="<?= $model->id ?>">
        <div class="col-md-12">
            <div class="lk_expert_body_acts_item_rew">
                <div class="lk_expert_body_acts_item_rew_brief">
                    <h5>Заполнить бриф</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="f_group">
                                <label for="selectModel">Марка</label>
                                <select name="mark_id" id="selectModel">
                                    <option value="">Выберите марку</option>
                                    <?php foreach($marks as $mark) {
                                        /** @var $mark \common\models\VehicleBrand */
                                        $selected = $mark->id == $model->mark_id ? "selected" : '';
                                        echo "<option value='$mark->id' $selected>$mark->name</option>";
                                    } ?>
                                </select>
                            </div>
                            <?php if($model->hasErrors('mark_id')): ?>
                                <div class="form-error"><?= $model->getFirstError('mark_id') ?></div>
                            <?php endif; ?>

                            <div class="f_group">
                                <label for="selectModel">Модель</label>
                                <select name="model_id" id="selectModel">
                                    <option value="">Выберите модель</option>
                                    <?php foreach($models as $vehicleModel) {
                                        /** @var $model \common\models\VehicleBrand */
                                        $selected = $vehicleModel->id == $model->model_id ? "selected" : '';
                                        echo "<option value='$vehicleModel->id' $selected>$vehicleModel->name</option>";
                                    } ?>
                                </select>
                            </div>
                            <?php if($model->hasErrors('model_id')): ?>
                                <div class="form-error"><?= $model->getFirstError('model_id') ?></div>
                            <?php endif; ?>


                        </div>
                        <div class="col-md-3">
                            <div class="f_group">
                                <label for="">Стоимость</label>
                                <input name="price" type="number" placeholder="Стоимость" value="<?= $model->price ?>">
                            </div>

                            <?php if($model->hasErrors('price')): ?>
                                <div class="form-error"><?= $model->getFirstError('price') ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-3">
                            <input type="hidden" value="1" name="currency_id">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="f_group">
                                <label for="">Мотор, см^3</label>
                                <input name="engine_volume" type="number" placeholder="Мотор, см^3" value="<?= $model->engine_volume ?>">
                            </div>
                            <?php if($model->hasErrors('engine_volume')): ?>
                                <div class="form-error"><?= $model->getFirstError('engine_volume') ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-6">
                            <div class="f_group">
                                <label for="selectKPP">КПП</label>
                                <select name="kpp" id="selectKPP">
                                    <option value="">Выберите трансмиссию</option>
                                    <?php foreach($transmissions as $index => $kpp) {
                                        /** @var $model \common\models\VehicleModel */
                                        $selected = $index == $model->kpp ? "selected" : '';
                                        echo "<option value='$index' $selected>$kpp</option>";
                                    } ?>
                                </select>
                            </div>
                            <?php if($model->hasErrors('kpp')): ?>
                                <div class="form-error"><?= $model->getFirstError('kpp') ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="f_group">
                                <label for="selectDrive">Привод</label>
                                <select name="drive" id="selectDrive">
                                    <option value="">Выберите привод</option>
                                    <?php foreach($drives as $index => $drive) {
                                        /** @var $model \common\models\VehicleModel */
                                        $selected = $index == $model->drive ? "selected" : '';
                                        echo "<option value='$index' $selected>$drive</option>";
                                    } ?>
                                </select>
                            </div>
                            <?php if($model->hasErrors('drive')): ?>
                                <div class="form-error"><?= $model->getFirstError('drive') ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-6">
                            <?php if(in_array($model->order->category, [OrderCategory::CATEGORY_FREIGHT, OrderCategory::CATEGORY_AUTO])): ?>

                                <div class="f_group">
                                    <label for="selectBody">Кузов</label>
                                    <select name="body" id="selectBody">
                                        <option value="">Выберите кузов</option>
                                        <?php foreach($bodies as $index => $label) {
                                            /** @var $model \common\models\VehicleModel */
                                            $selected = $index == $model->body ? "selected" : '';
                                            echo "<option value='$index' $selected>$label</option>";
                                        } ?>
                                    </select>
                                </div>

                                <?php if($model->hasErrors('body')): ?>
                                    <div class="form-error"><?= $model->getFirstError('body') ?></div>
                                <?php endif; ?>

                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="f_group">
                                <label for="">Цвета</label>
                                <input name="colors" type="text" placeholder="Цвета" value="<?= $model->colors ?>">
                            </div>
                            <?php if($model->hasErrors('colors')): ?>
                                <div class="form-error"><?= $model->getFirstError('colors') ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-3">
                            <div class="f_group">
                                <label for="selectYear">Год выпуска, от</label>
                                <select name="year_from" id="selectYear">
                                    <option value="">Выберите год</option>
                                    <?php for($y = date_create()->format('Y'); $y > 1950; $y--){
                                        $selected = $model->year_from == $y ? "selected" : '' ;
                                        echo "<option value='$y' $selected>$y</option>";
                                    } ?>
                                </select>
                            </div>
                            <?php if($model->hasErrors('year_from')): ?>
                                <div class="form-error"><?= $model->getFirstError('year_from') ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-3">
                            <div class="f_group">
                                <label for="">Пробег</label>
                                <input name="mileage" type="text" placeholder="Пробег" value="<?= $model->mileage ?>">
                            </div>
                            <?php if($model->hasErrors('mileage')): ?>
                                <div class="form-error"><?= $model->getFirstError('mileage') ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="f_group">
                                <label for="">Дополнительно</label>
                                <input name="additionally" type="text" placeholder="Дополнительно" value="<?= $model->additionally ?>">
                            </div>
                            <?php if($model->hasErrors('additionally')): ?>
                                <div class="form-error"><?= $model->getFirstError('additionally') ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="f_group">
                                <label for="">Укажите пожалуйста откуда узнали о компании</label>
                                <input name="about" type="text" placeholder="Укажите пожалуйста откуда узнали о компании" value="<?= $model->about ?>">
                            </div>
                            <?php if($model->hasErrors('about')): ?>
                                <div class="form-error"><?= $model->getFirstError('about') ?></div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <?php if($model->dial_type == \common\models\Dial::TYPE_SAFE): ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="f_group text-right">
                                Используется безопасная сделка
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="f_group text-right">

                                <?php if($model->dial_type == \common\models\Dial::TYPE_SAFE && !$model->request->expert->card): ?>
                                    Вы не можете согласиться на безопасную сделку, вы не имеете ни одной привязанной карты для перевода вознаграждения
                                    <a href="<?= Url::to(['/lk/cards']) ?>">Привязать карту</a>
                                <?php else: ?>
                                    <button class="button button_orange button_top_img" >Отправить</button>
                                <?php endif; ?>

                                
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </form>
</div>




