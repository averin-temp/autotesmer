<?php
/** @var $this \yii\web\View*/
/** @var $order \common\models\Order*/

use yii\helpers\Url;
use common\models\Order;

?>

<div class="expfull exp">
    <div class="lk_user_body_top">
        <div class="lk_expert_body_packejes_tabs_body">
            <div class="lk_expert_body_acts">



                <div class="lk_expert_body_acts_item">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="lk_expert_body_acts_item_head"><?= $order->nameLabel() ?></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="lk_expert_body_acts_item_text">
                                <?= $order->comment ?>
                            </div>
                            <div class="lk_expert_body_acts_item_tech clearfix">
                                <div>Ответов: <span><?= $order->requestsCount() ?></span></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="lk_expert_body_acts_item_rigth_top">
                                <div class="content_last_closed_item_img_string">
                                    <img src="<?= Url::to('@web/img/icons/types/icon_car.png') ?>" alt="">
                                    <div class="content_last_closed_item_img_string_span"><?= $order->categoryLabel() ?></div>
                                </div>
                            </div>
                            <div class="lk_expert_body_acts_item_rigth_mid">Стоимость:   <span>До <?= $order->budget_to ?></span></div>
                            <div class="lk_expert_body_acts_item_rigth_mid">Срок подбора:   <span><?= $order->period_from . '-' . $order->period_to ?> дней</span></div>
                            <div class="lk_expert_body_acts_item_rigth_mid">Бюджет задачи:   <span>До <?= $order->budget_to ?></span></div>
                            <div class="lk_expert_body_acts_item_rigth_bot ">
                                <!--a href="">Редактировать заказ</a-->
                                <?php if($order->canBeCanceled()): ?>
                                    <form action="<?= Url::to(['/orders/cancel']) ?>" method="post">
                                        <input type="hidden" name="id" value="<?= $order->id ?>">
                                        <a href="" class="ared delete-order">Отменить заказ</a>
                                    </form>
                                <?php endif; ?>

                                <?php if($order->dial && $order->dial->canBeCanceled()): ?>
                                    <form action="<?= Url::to(['/dial/cancel']) ?>" method="post">
                                        <input type="hidden" name="id" value="<?= $order->dial->id ?>">
                                        <a href="" class="ared delete-order">Отменить сделку</a>
                                    </form>
                                <?php endif; ?>

                                <?php if($order->status == \common\models\Order::STATUS_WAITING_RESERVATION): ?>
                                    <span>Заказ ожидает подтверждения оплаты клиентом</span>

                                    <?php
                                    $payment  = \common\models\Payment::findOne($order->dial->payment_id);
                                    if($payment->status == \common\models\Payment::STATUS_CANCELLED): ?>
                                        <div><span>Оплата заказа отменена</span></div>
                                        <div><a href="<?= Url::to(['/payment/repeat', 'id' => $payment->id]) ?>">Оплатить</a></div>

                                    <?php endif; ?>

                                    <?php if($payment->status == \common\models\Payment::STATUS_DRAFT): ?>
                                        <a href="<?= Url::to(['/payment/payment', 'id' => $payment->id ])  ?>">Зарезервировать средства</a>
                                    <?php endif; ?>


                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
