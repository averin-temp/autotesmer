<?php
/** @var $this \yii\web\View */
/** @var $model common\models\Order */
/** @var $marks array */
/** @var $currencies array */




use yii\helpers\Url;
use common\classes\OrderCategory;
use common\classes\OrderType;
use frontend\helpers\OrderHelper;

?>
    <div class="row ">
        <div class="col-md-2">
            <div class="f_group">
                <span class="f_group_labl">Категория</span>
            </div>
        </div>
        <div class="col-md-10">
            <div class="form_catli_top">
                <ul id="category">
                    <?php

                    $data = [
                        OrderCategory::CATEGORY_AUTO => [
                            'icon-1' => '@web/img/icons/ccats/1.png',
                            'icon-2' => '@web/img/icons/ccats/1_h.png'
                        ],
                        /*OrderCategory::CATEGORY_FREIGHT => [
                            'icon-1' => '@web/img/icons/ccats/2.png',
                            'icon-2' => '@web/img/icons/ccats/2_h.png'
                        ],
                        OrderCategory::CATEGORY_MOTO => [
                            'icon-1' => '@web/img/icons/ccats/3.png',
                            'icon-2' => '@web/img/icons/ccats/3_h.png'
                        ],
                        OrderCategory::CATEGORY_COMMERCE => [
                            'icon-1' => '@web/img/icons/ccats/4.png',
                            'icon-2' => '@web/img/icons/ccats/4_h.png'
                        ],
                        OrderCategory::CATEGORY_WATER => [
                            'icon-1' => '@web/img/icons/ccats/5.png',
                            'icon-2' => '@web/img/icons/ccats/5_h.png'
                        ],*/
                    ];

                    foreach ($data as $category => $info): ?>
                        <li<?= $model->category == $category ? " class=\"active\"" : '' ?> data-category="<?=  $category ?>" data-link="<?= Url::to(['//orders/create', 'category' => $category, 'type' => $model->type]) ?>">
                            <img src="<?= Url::to($info['icon-1']) ?>" alt="">
                            <img src="<?= Url::to($info['icon-2']) ?>" alt="">
                            <span><?= OrderCategory::label($category) ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>

    <?php $model->errorField('category') ?>

    <div class="row ">

        <div class="col-md-2">
            <div class="f_group">
                <span class="f_group_labl">Тип подбора</span>
            </div>
        </div>

        <div class="col-md-10">
            <div class="form_catli_top">
                <ul id="type">
                    <?php

                    $data = [
                        OrderType::TYPE_ONE_TIME_INSPECTION => [
                            'icon-1' => '@web/img/icons/ccats2/1.png',
                            'icon-2' => '@web/img/icons/ccats2/1_h.png',
                            'icon-3' => '@web/img/icons/ccats2/que.png',
                        ],
                        OrderType::TYPE_EXPERT_FOR_DAY => [
                            'icon-1' => '@web/img/icons/ccats2/2.png',
                            'icon-2' => '@web/img/icons/ccats2/2_h.png',
                            'icon-3' => '@web/img/icons/ccats2/que.png',
                        ],
                        OrderType::TYPE_FULL_SELECTION => [
                            'icon-1' => '@web/img/icons/ccats2/3.png',
                            'icon-2' => '@web/img/icons/ccats2/3_h.png',
                            'icon-3' => '@web/img/icons/ccats2/que.png',
                        ],
                    ];

                    foreach($data as $type => $info): ?>
                        <li<?= $model->type == $type ? " class=\"active\"" : '' ?> data-type="<?= $type ?>">
                            <img src="<?= Url::to($info['icon-1']) ?>" alt="">
                            <img src="<?= Url::to($info['icon-2']) ?>" alt="">
                            <span><?= OrderType::label($type) ?><img src="<?= Url::to($info['icon-3']) ?>" alt=""></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>

    </div>

    <?php $model->errorField('type') ?>

    <div class="rdevid"></div>

    <?= OrderHelper::rangeField(
            'budget_from',
            'budget_to',
            'Бюджет',
            Url::to('@web/img/icons/money.png'),
            [
                'step' => '1000',
                'low' => $model->budget_from,
                'hi' => $model->budget_to,
                'label' => '₽',
                'min' => '10000',
                'max' => '10000000',
            ]
    ) ?>

    <?php $model->errorField('budget_from') ?>
    <?php $model->errorField('budget_to') ?>

    <div class="row">
        <div class="col-md-2">
            <div class="f_group">
                <span class="f_group_labl">Время подбора</span>
            </div>
        </div>
        <div class="col-md-2">
            <div class="f_group">
                <input id="period_from" type="text" placeholder="от(дней)" required="" value="<?= $model->period_from ?>">
                <?php $model->errorField('period_from') ?>
            </div>
        </div>
        <div class="col-md-2">
            <div class="f_group">
                <input id="period_to"  type="text" placeholder="до(дней)" required="" value="<?= $model->period_to ?>">
                <?php $model->errorField('period_to') ?>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>

    <div class="row">
        <div class="col-md-2">
            <div class="f_group">
                <span class="f_group_labl">Марка</span>
            </div>
        </div>
        <div class="col-md-4">
            <div class="f_group">
                <select name="mark_id" id="mark_id">
                    <option value=""<?= $model->mark_id ? '' : ' selected' ?>>Любая</option>
                    <?php foreach($marks as $mark){
                        /** @var $mark \common\models\VehicleModel */
                        $selected = $mark->id  == $model->mark_id ? ' selected' : '';
                        echo "<option value='$mark->id'$selected>$mark->name</option>";
                    } ?>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="f_group">
                <!--a href="" class="suba suba2">+ добавить еще марку</a-->
            </div>
        </div>
    </div>

    <?php $model->errorField('mark_id') ?>

    <div class="row">
        <div class="col-md-2">
            <div class="f_group">
                <span class="f_group_labl">Модель</span>
            </div>
        </div>
        <div class="col-md-4">
            <div class="f_group">
                <select name="model_id" id="model_id">
                    <option value=""<?= $model->model_id ? '' : ' selected' ?>>Любая</option>
                    <?php

                    if($model->mark){
                        foreach($model->mark->models as $_model){
                            /** @var $mark \common\models\VehicleModel */
                            $selected = $_model->id  == $model->model_id ? ' selected' : '';
                            echo "<option value='$_model->id'$selected>$_model->name</option>";
                        }
                    }

                     ?>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="f_group">
                <!--a href="" class="suba suba2">+ добавить еще марку</a-->
            </div>
        </div>
    </div>

    <?php $model->errorField('model_id') ?>

    <?= OrderHelper::rangeField(
        'year_from',
        'year_to',
        'Год выпуска',
        null,
        [
            'step' => '1',
            'low' => $model->year_from,
            'hi' => $model->year_to,
            'label' => 'г.',
            'min' => '1890',
            'max' => '2020',
        ]
    ) ?>

    <?php $model->errorField('year_from') ?>
    <?php $model->errorField('year_to') ?>