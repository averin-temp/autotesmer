<?php
/** @var $this \yii\web\View */
/** @var $request \common\models\Request */
/** @var $order \common\models\Order */
/** @var $safeDialEnabled bool */

use yii\helpers\Url;
use common\models\Request;
use common\models\Order;
use common\models\Brief;

/** @var $expert \common\models\User */
/** @var $chat \common\models\Chat */
/** @var $brief \common\models\Brief */
$expert = $request->expert;
$chat = $request->chat;
$brief = $request->brief

?>

<div class="lk_user_body_exp">
    <div class="lk_user_body_exp_top">
        <div class="row">
            <div class="col-md-6">
                <div class="mh_choise_block">
                    <div class="r_top_experts_inner clearfix">
                        <div class="r_top_experts_inner_photo" style="background-image: url('<?= Url::to($request->expert->avatar) ?>');">
                            <a href=""></a>
                        </div>
                        <div class="texpothers">
                            <div class="r_top_experts_inner_icons">
                                <ul>
                                    <li class="r_top_experts_inner_icons_top">топ</li>
                                    <li class="r_top_experts_inner_icons_count">39</li>
                                    <li class="r_top_experts_inner_icons_safe unact"></li>
                                </ul>
                            </div>
                            <div class="r_top_experts_inner_name"><?= $expert->family . ' ' . $expert->firstname . ' ' .$expert->lastname  ?></div>
                            <div class="r_top_experts_inner_sub"><?= $order->typeLabel() ?></div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mh_choise_block mh_choise_block2">
                    <div class="r_top_experts_inner clearfix">
                        <div class="texpothers">
                            <div class="r_top_experts_inner_count">
                                Сделок через сайт: <span><?= $expert->completedOrdersCount ?></span>
                            </div>
                            <div class="r_top_experts_inner_rew">
                                Отзывы:
                                <span class="r_top_experts_inner_rew_r_plus"><a href="">+ <?= $expert->positiveReviewsCount() ?></a></span>
                                <!--span class="r_top_experts_inner_rew_r_netral"><a href="">0</a></span-->
                                <span class="r_top_experts_inner_rew_r_minus"><a href="">- <?= $expert->negativeReviewsCount() ?></a></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="lk_user_body_exp_bot">
        <div class="lk_expert_body_acts_item_rew_top">
            <div class="row">
                <div class="col-md-12">
                    <div class="flef">Стоимость:   <span><?= $request->price ?></span></div>
                    <div class="flef">Срок:   <span><?=  $request->period . ' ' . (array( 1 => 'Часов', 2 => 'Дней' , 3 => 'Недель'))[$request->metric] ?></span></div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <div class="lk_user_body_exp_bot_texttext">
                        <?= $request->content ?>
                    </div>
                </div>
            </div>
            <div class="lk_user_body_exp_bot_bot">
                <div class="lk_expert_body_acts_item_rew_bot">

                    <?php if($brief && $brief->status == Brief::STATUS_SENDED ): ?>
                        <form action="<?= Url::to(['/dial/create']) ?>" method="post">
                            <input type="hidden" name="brief" value="<?= $brief->id ?>">
                            <a class="agreen choose-button">Выбрать исполнителем</a>
                        </form>
                    <?php endif; ?>

                    <?php if($order->status == Order::STATUS_WAITING_RESERVATION ): ?>
                        <span>ожидается подтверждение резервирования средств</span>
                        <a href="<?= Url::to(['/payment/payment', 'id' => $order->dial->payment->id]) ?>">Зарезервировать</a>
                    <?php endif; ?>

                    <?php if($request->status == Request::STATUS_OPEN || $request->status == Request::STATUS_WAITING_ACCEPTANCE): ?>
                        <form action="<?= Url::to(['/requests/refuse']) ?>" method="post">
                            <input type="hidden" name="request" value="<?= $request->id ?>">
                            <a class="ared refuse-button" href="">Отакзать</a>
                        </form>
                    <?php endif ?>

                    <?php if($request->status == Request::STATUS_WAITING_ACCEPTANCE): ?>
                        <a style="cursor: pointer" class="show-brief" data-brief="<?= $brief->id ?>">Просмотреть бриф</a>
                        <a style="display: none; cursor: pointer" class="hide-brief" data-brief="<?= $brief->id ?>">Закрыть бриф</a>
                    <?php endif; ?>

                    <?php if($brief == null): ?>
                        <form action="<?= Url::to(['/brief/sendbrif']) ?>" method="post">
                            <input type="hidden" name="request" value="<?= $request->id ?>">
                            <?php if($safeDialEnabled): ?>Использовать безопасную сделку
                            <input type="checkbox" name="dial_type" value="<?= \common\models\Dial::TYPE_SAFE ?>">
                            <?php else: ?>
                            Для использования безопасной сделки привяжите карту
                            <?php endif; ?>
                            <a href="" class="sendbrif">Послать бриф</a>
                        </form>
                    <?php elseif($brief->status == Brief::STATUS_FREE): ?>
                        <span>Бриф отправлен</span>
                    <?php endif; ?>

                    <a href="" class="open-chat" data-id="<?= $chat->id ?>">Открыть чат</a>
                    <a href="" class="close-chat">Закрыть чат</a>

                </div>
            </div>
        </div>
    </div>

    <div class="chat"></div>

    <div class="brief-view"></div>

</div>
