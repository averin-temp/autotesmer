<?php
/** @var $this \yii\web\View */
/** @var $client \common\models\User */
/** @var $orders array */


use yii\helpers\Url;
use frontend\assets\ChatAsset;
use frontend\assets\NiceScrollAsset;
use common\models\Order;
use common\models\Dial;

NiceScrollAsset::register($this);
ChatAsset::register($this);


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
                            <li><span>Личный кабинет</span></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <?php $menu = 'orders'; include __DIR__ . '/left-sidebar.php' ?>
                </div>
            </div>
            <div class="col-md-9">
                <div class="lk_user_body">


                    <?= $this->render('my-orders-tabs') ?>


                    <div class="lk_expert_body_packejes_tabs_body">

                        <?php if(count($orders) == 0): ?>Нет работ<?php endif; ?>
                        <?php foreach($orders as $order):
                        /** @var $order common\models\Order */

                         /** @var $dial common\models\Dial */
                        $dial = $order->dial;
                        /**  @var $expert \common\models\User */
                        $expert = $dial->expert;
                        /**  @var $chat \common\models\Chat */
                        $chat = $dial->chat;
                        ?>
                        <div class="order-item">

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
                                                            <div class="content_last_closed_item_img_string_span">
                                                                <?= $order->typeLabel() ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="lk_expert_body_acts_item_rigth_mid">Стоимость: <span>25 000 руб.</span>
                                                    </div>
                                                    <div class="lk_expert_body_acts_item_rigth_mid">Срок подбора: <span>15-20 дней</span>
                                                    </div>
                                                    <div class="lk_expert_body_acts_item_rigth_mid">Бюджет задачи: <span>15 000 руб.</span>
                                                    </div>
                                                    <div class="lk_expert_body_acts_item_rigth_bot">

                                                        <?php if($order->status == Order::STATUS_WORK && $dial->status == Dial::STATUS_WORK): ?>
                                                        <a class="close-order-bth" href="">Закрыть заказ</a>
                                                        <?php endif; ?>

                                                        <?php if($dial->type == Dial::TYPE_SAFE && $order->status == Order::STATUS_WORK && $dial->status == Dial::STATUS_WORK): ?>
                                                            <a href="<?= Url::to(['/dispute/appeal', 'dial_id' => $dial->id]) ?>">Подать жалобу</a>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="lk_user_body_exp">
                                <div class="lk_user_body_exp_top">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mh_choise_block">
                                                <div class="r_top_experts_inner clearfix">
                                                    <div class="r_top_experts_inner_photo"
                                                         style="background-image: url('<?= $expert->avatar ?>');">
                                                        <a href="<?= $expert->profileUrl ?>"></a>
                                                    </div>
                                                    <div class="texpothers">
                                                        <div class="r_top_experts_inner_icons">
                                                            <ul>
                                                                <?php if($expert->isTop()):
                                                                 echo "<li class=\"r_top_experts_inner_icons_top\">топ</li>";
                                                                 echo "<li class=\"r_top_experts_inner_icons_count\">". $expert->isTop() ."</li>";
                                                                 endif;
                                                                ?>
                                                                <li class="r_top_experts_inner_icons_safe unact"></li>
                                                            </ul>
                                                        </div>
                                                        <div class="r_top_experts_inner_name"><?= $expert->family . ' ' . $expert->firstname ?></div>
                                                        <div class="r_top_experts_inner_sub">Подбор авто под ключ, разовый
                                                            осмотр
                                                        </div>

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
                                                            <span class="r_top_experts_inner_rew_r_plus"><a href="<?= '' ?>">+ <?= $expert->positiveReviewsCount() ?></a></span>
                                                            <span class="r_top_experts_inner_rew_r_minus"><a href="<?= '' ?>">- <?= $expert->negativeReviewsCount() ?></a></span>
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
                                                <div class="flef">Стоимость: <span>25 000 руб.</span></div>
                                                <div class="flef">Срок: <span>10 дней</span></div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="lk_user_body_exp_bot_texttext">
                                                    смотрите отзывы, если будет интересно пишите.
                                                </div>
                                                <div class="lk_user_body_exp_bot_texttext_string">
                                                    <ul>
                                                        <?php if($new_messages = $chat->newMessagesFor($client->id)): ?>
                                                        <li class="lk_user_body__new">
                                                            <a href="" class="new-message" data-id="<?= $chat->id ?>" ><img src="<?= Url::to('@web/img/icons/red.png') ?>" alt="">Новое сообщение</a>
                                                        </li>
                                                        <?php endif; ?>
                                                        <li class="lk_user_body__chat">
                                                            <a href="" class="open-chat" data-id="<?= $chat->id ?>">Открыть чат</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>


                            <div class="chat"></div>


                            <div class="close-form">

                                <form action="<?= Url::to(['/dial/close']) ?>" method="post">
                                    <input name="order_id" type="hidden" value="<?= $order->id ?>">
                                <div class="lk_user_body_chat">
                                    <div class="row">
                                        <div class="col-md-12">


                                                <div class="f_group mb10">
                                                    <label for="">Оставить отзыв</label>
                                                    <textarea name="review" placeholder="Введите текст" required=""></textarea>
                                                </div>

                                        </div>
                                    </div>
                                    <div class="c_body_message_send">
                                        <div class="row">
                                            <div class="col-md-6 text-left">
                                                <div class="revs_check">
                                                    <label><input name="evaluation" type="radio" value="1" checked><span>+</span></label>
                                                    <label><input name="evaluation" type="radio" value="-1"><span>-</span></label>
                                                </div>
                                            </div>
                                            <div class="col-md-6 text-right">
                                                <button class="button button_orange button_top_img submit_close_form" href="">Сохранить и закрыть заказ</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </form>

                            </div>


                        <?php endforeach; ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</main>

<?php

$user_id = $client->id;
$sendUrl = Url::to(['/chat/post']);
$updateUrl = Url::to(['/chat/get']);
$script = <<< JS
$('.open-chat, .new-message').click(function(e){
    e.preventDefault();
    
    let id = $(this).attr('data-id');
    let container = $(this).closest('.order-item').find('.chat');
    $('.chat').closeChat();
    $(container).OpenChat({
        id: id,
        user: $user_id,
        sendUrl: '$sendUrl',
        updateUrl:'$updateUrl'
    });
    
    if($(this).hasClass('new-message')) 
        $(this).closest('.lk_user_body__new').remove();
});




JS;

$this->registerJs($script);


