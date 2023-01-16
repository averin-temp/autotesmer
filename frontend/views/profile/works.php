<?php

/** @var $expert \common\models\User */
/** @var $orders array */

use yii\helpers\Url;
use frontend\widgets\ProfileUserPanel;

?>
<main class="lk">
    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breads_wrapper dark">
                        <ul>
                            <li><a href="/">Главная</a></li>
                            <li><span>></span></li>
                            <li><span>Профиль</span></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-9">
                    <div class="lk_user_body">

                        <div class="lk_expert_body_packejes_tabs">
                            <ul>
                                <li><a href="<?= Url::to(['profile/info', 'id'=> $expert->id ]) ?>">Информация</a></li>
                                <li class="active"><a href="<?= Url::to(['profile/works', 'id'=> $expert->id ]) ?>">Выполненные работы</a></li>
                                <li><a href="<?= Url::to(['profile/reviews', 'id'=> $expert->id ]) ?>">Отзывы</a></li>
                            </ul>
                        </div>
                        <div class="lk_expert_body_packejes_tabs_body">
                            <div class="lk_user_body_chat_closed">
                                <?php foreach($expert->completedOrders as $order): /** @var $order common\models\Order */ ?>
                                <div class="content_last_closed_item expert_page_item">
                                    <div class="row justify-content-center align-items-center">
                                        <div class="col-md-3 align-middle">
                                            <div class="content_last_closed_item_img">
                                                <div class="content_last_closed_item_img_string">
                                                    <img src="/img/icons/types/icon_car.png" alt="">
                                                    <div class="content_last_closed_item_img_string_span">Подбор под
                                                        ключ
                                                    </div>
                                                </div>
                                                <div class="content_last_closed_item_img_string_img"
                                                     style="background-image: url(<?= Url::to('@web/img/common/car.png'); ?>"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-9 align-middle">
                                            <div class="content_last_closed_item_body_top"><?= $order->nameLabel() ?></div>
                                            <div class="content_last_closed_item_body_subtop">
                                                <div class="row">
                                                    <div class="col-md-3 col-sm-6">
                                                        <div class="content_last_closed_item_body_subtop_top">Марка
                                                        </div>
                                                        <div class="content_last_closed_item_body_subtop_bot">
                                                            <?= $order->mark ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 col-sm-6">
                                                        <div class="content_last_closed_item_body_subtop_top">Модель</div>
                                                        <div class="content_last_closed_item_body_subtop_bot">W221</div>
                                                    </div>
                                                    <div class="col-md-3 col-sm-6">
                                                        <div class="content_last_closed_item_body_subtop_top">Срок подбора</div>
                                                        <div class="content_last_closed_item_body_subtop_bot">2 дня</div>
                                                    </div>
                                                    <div class="col-md-3 col-sm-6">
                                                        <div class="content_last_closed_item_body_subtop_top">Стоимость</div>
                                                        <div class="content_last_closed_item_body_subtop_bot bold"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="content_last_closed_item_body_content">
                                                Платежный документ устанавливает договор. Конфиденциальность требует
                                                преддоговорный
                                                причиненный ущерб. В соответствии со сложившейся правоприменительной
                                                практикой
                                                норма
                                                защищена.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 expert_page_side">
                    <?= ProfileUserPanel::widget(['expert' => $expert]) ?>
                </div>
            </div>

        </div>
    </div>
    </div>
</main>
