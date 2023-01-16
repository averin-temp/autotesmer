<?php

/** @var $result int */


use yii\helpers\Url;
use common\models\Service;

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

                            <span>

                            <?php if($result == '1'): ?>
                            Ошибка оплаты
                            <?php endif; ?>


                            <?php if($result == '0'): ?>
                                Успешная оплата
                            <?php endif; ?>


                            <?php if($result == '-1'): ?>
                                Счет на оплату выставлен, но еще не оплачен
                            <?php endif; ?>

                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</main>
