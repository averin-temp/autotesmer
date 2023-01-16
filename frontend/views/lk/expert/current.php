<?php

/** @var $this View */
/** @var $orders array */

use yii\web\View;
use yii\helpers\Url;
use common\models\Order;
use common\models\Dial;
use frontend\assets\ChatAsset;

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
                    <?php $menu = 'works'; include __DIR__ . '/left-sidebar.php'; ?>
                </div>
            </div>
            <div class="col-md-9">
                <div class="lk_expert_body">
                    <div class="lk_expert_body_packejes">

                        <?= $this->render('my-works-tabs') ?>

                        <div class="lk_expert_body_packejes_tabs_body">
                            <div class="lk_expert_body_acts">



                                <?php foreach($orders as $order):
                                    /** @var $order common\models\Order */

                                    /** @var $dial common\models\Dial */
                                    $dial = $order->dial;
                                    /**  @var $expert \common\models\User */
                                    $expert = $dial->expert;
                                    /**  @var $chat \common\models\Chat */
                                    $chat = $dial->chat;
                                    ?>
                                <div class="lk_expert_body_acts_item">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="lk_expert_body_acts_item_head">
                                                <img src="<?= Url::to('@web/img/icons/lock.png') ?>" alt="">
                                                <?= $order->nameLabel() ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="lk_expert_body_acts_item_text">
                                                <?= $order->comment ?>
                                            </div>
                                            <div class="lk_expert_body_acts_item_tech clearfix">
                                                <div>Заказчик: <span><?= $order->client->family . ' ' . mb_substr($order->client->firstname,0,1,'UTF-8') . '.' ?></span></div>
                                                <div>Регион: <span><?= $order->client->city->name ?></span></div>
                                            </div>
                                            <div class="lk_expert_body_acts_item_date">
                                                Дата публикации:   <?= $order->publicationDate("d.m.y") ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="lk_expert_body_acts_item_rigth_top">
                                                <div class="content_last_closed_item_img_string">
                                                    <img src="<?= Url::to('@web/img/icons/types/icon_car.png') ?>" alt="">
                                                    <div class="content_last_closed_item_img_string_span"><?= $order->typeLabel() ?></div>
                                                </div>
                                            </div>
                                            <div class="lk_expert_body_acts_item_rigth_mid">Бюджет задачи:   <span><?= $order->budget_to ?> руб.</span></div>
                                            <div class="lk_expert_body_acts_item_rigth_bot">
                                                <a href="" class="open-chat" data-id="<?= $chat->id ?>">Открыть чат</a>
                                                <a href="<?= Url::to(['/report/index', 'dialID' => $dial->id ]) ?>" >Отправить отчет</a>
                                            </div>

                                            <?php if($dial->canBeChallenged()): ?>
                                                <a href="<?= Url::to(['/dispute/appeal', 'dial_id' => $dial->id]) ?>">Подать жалобу</a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="chat"></div>
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



<?php

$user_id = $expert->id;
$sendUrl = Url::to(['/chat/post']);
$updateUrl = Url::to(['/chat/get']);
$script = <<< JS
$('.open-chat').click(function(e){
    e.preventDefault();
    e.stopPropagation();
    $('.chat').closeChat();
    
    let id = $(this).attr('data-id');
    let container = $(this).closest('.lk_expert_body_acts_item').find('.chat');
    
    $(container).OpenChat({
        id: id,
        user: $user_id,
        sendUrl: '$sendUrl',
        updateUrl:'$updateUrl'
    });
});

JS;

$this->registerJs($script, View::POS_READY, 'request-dialog');
