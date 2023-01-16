<?php
/** @var $variants array */


use yii\helpers\Url;
use frontend\widgets\PackageWidget;



?><main class="lk">
    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breads_wrapper dark">
                        <ul>
                            <li><a href="/">Главная</a></li>
                            <li><span>></span></li>
                            <li><span>Личный кабинет</span></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <?php $menu = 'packages'; include __DIR__ . '/left-sidebar.php'; ?>
                </div>
            </div>
            <div class="col-md-9">
                <div class="lk_expert_body">
                    <div class="lk_expert_body_packejes">

                        <div class="lk_expert_body_packejes_tabs">
                            <ul>
                                <li class="active"><a href="<?= Url::to(['lk/packages']) ?>">Выбрать пакет</a></li>
                                <li><a href="<?= Url::to(['lk/packages_added']) ?>">Подключенные пакеты</a></li>
                            </ul>
                        </div>
                        <div class="lk_expert_body_packejes_tabs_body">
                            <div class="reg_exp_page_1st_3_body">
                                <div class="row">

                                    <?php if(empty($variants)) echo "Нет доступных вариантов" ?>

                                    <?php foreach($variants as $variant): /** @var $variant \common\models\PackageVariant */ ?>
                                        <div class="col-md-4 lk_expert_body_packejes_item">
                                            <?= PackageWidget::widget([
                                                'link' => Url::to(['/packages/order', 'id' => $variant->id]),
                                                'price' => $variant->price,
                                                'caption' => $variant->name,
                                                'services' => $variant->servicesNames,
                                            ]) ?>
                                        </div>
                                    <?php endforeach; ?>

                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</main>