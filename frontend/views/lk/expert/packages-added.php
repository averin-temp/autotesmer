<?php

/** @var $userPackages array */


use yii\helpers\Url;
use common\models\Service;
use common\models\Payment;

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
                                <li><a href="<?= Url::to(['lk/packages']) ?>">Выбрать пакет</a></li>
                                <li class="active"><a href="<?= Url::to(['lk/packages_added']) ?>">Подключенные пакеты</a></li>
                            </ul>
                        </div>
                        <div class="lk_expert_body_packejes_tabs_body">

                            <?php foreach($userPackages as $userPackage): /** @var $userPackage \common\models\UserPackage */ ?>

                            <div class="reg_exp_page_1st_3_active_body">

                                <h3><?= $userPackage->package->name ?></h3>

                                <?php if($service = $userPackage->getServiceByType(Service::TYPE_ONE_TIME_INSPECTION)): ?>
                                    <div class="reg_exp_page_1st_3_active_body_top">
                                        <img src="<?= Url::to('@web/img/icons/main_top/icon6_h.png') ?>" alt="">
                                    </div>
                                    <div class="reg_exp_page_1st_3_active_body_utop"><?= $service->name ?></div>
                                <?php endif; ?>

                                <?php if($service = $userPackage->getServiceByType(Service::TYPE_EXPERT_FOR_DAY)): ?>
                                    <div class="reg_exp_page_1st_3_active_body_top">
                                        <img src="<?= Url::to('@web/img/icons/main_top/icon6_h.png') ?>" alt="">
                                    </div>
                                    <div class="reg_exp_page_1st_3_active_body_utop"><?= $service->name ?></div>
                                <?php endif; ?>

                                <?php if($service = $userPackage->getServiceByType(Service::TYPE_FULL_SELECTION)): ?>
                                    <div class="reg_exp_page_1st_3_active_body_top">
                                        <img src="<?= Url::to('@web/img/icons/main_top/icon6_h.png') ?>" alt="">
                                    </div>
                                    <div class="reg_exp_page_1st_3_active_body_utop"><?= $service->name ?></div>
                                <?php endif; ?>

                                <?php if($service = $userPackage->getServiceByType(Service::TYPE_EDITORS_CHOICE)): ?>
                                    <div class="reg_exp_page_1st_3_active_body_top">
                                        <img src="<?= Url::to('@web/img/icons/main_top/icon6_h.png') ?>" alt="">
                                    </div>
                                    <div class="reg_exp_page_1st_3_active_body_utop"><?= $service->name ?></div>
                                <?php endif; ?>

                                <div class="reg_exp_page_1st_3_active_body_devider"></div>
                                <div class="reg_exp_page_1st_3_active_body_mid">
                                    <?php if($userPackage->paid == 1): ?>
                                        До окончания осталось <?= $userPackage->getTimeLeft() ?> дней
                                    <?php endif; ?>

                                    <?php

                                    $payment = $userPackage->payment;

                                    if($userPackage->paid == 0): ?>
                                        <?php if($payment): ?>

                                            <?php if($payment->status == Payment::STATUS_WAITING_CONFIRMATION): ?>
                                                Ожидает оплаты
                                            <?php endif; ?>

                                            <?php if($payment->status == Payment::STATUS_CANCELLED): ?>
                                                Платеж отменен
                                            <?php endif; ?>

                                            <?php if($payment->status == Payment::STATUS_CANCELLED): ?>
                                                <a class="button" href="<?= Url::to(['/packages/payment', 'id' => $payment->id ]) ?>">Оплатить</a>
                                            <?php else: ?>
                                                <a class="button" href="<?= Url::to(['/payment', 'id' => $payment->id ]) ?>">Оплатить</a>
                                            <?php endif; ?>


                                            <a class="button" href="<?= Url::to(['/packages/cancel', 'id' => $userPackage->id ]) ?>">Отменить</a>

                                        <?php endif; ?>
                                    <?php endif; ?>

                                </div>

                                <div class="reg_exp_page_1st_3_active_body_bot">
                                    <?php if($userPackage->paid == 1):

                                        if($payment->type == Payment::TYPE_PACKAGE_EXTENSION && $payment->status == Payment::STATUS_WAITING_CONFIRMATION): ?>
                                        <span>ожидание подтверждения оплаты продления пакета</span>
                                        <?php else: ?>
                                            <a class="button button_orange button_top_img" href="<?= Url::to(['/packages/extend', 'id' => $userPackage->id ]) ?>">
                                                Продлить
                                            </a>
                                        <?php endif; ?>

                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php endforeach; ?>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</main>
