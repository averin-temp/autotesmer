<?php

/** @var $this \yii\web\View */
/** @var $expert \common\models\User */
/** @var $requests array */
/** @var $posted_brief \common\models\Brief */
/** @var $posted_brief_form string */

use yii\helpers\Url;
use yii\web\View;
use frontend\assets\ChatAsset;
use common\models\Brief;
use common\models\Request;

ChatAsset::register($this);

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
                    <?php $menu = 'works'; include __DIR__ . '/left-sidebar.php'; ?>
                </div>
            </div>
            <div class="col-md-9">
                <div class="lk_expert_body">



                    <div class="lk_expert_body_packejes">

                        <?= $this->render('my-works-tabs') ?>


                        <div class="lk_expert_body_packejes_tabs_body">
                            <div class="lk_expert_body_acts">
                                <div class="lk_expert_body_acts_sort clearfix">
                                    <div class="lk_expert_body_acts_sort_left">
                                        Период: <span>год <img src="<?= Url::to('@web/img/icons/arb.png') ?>" alt=""></span>
                                    </div>
                                    <div class="lk_expert_body_acts_sort_right">
                                        Сортировать: <span>по дате <img src="<?= Url::to('@web/img/icons/arb.png') ?>" alt=""></span>

                                    </div>
                                </div>

                                <div class="request-list">

                                    <?php foreach($requests as $request):
                                        /** @var $request \common\models\Request */
                                        /** @var $order \common\models\Order */
                                        /** @var $chat \common\models\Chat */
                                        $order = $request->order;
                                        $chat = $request->chat;
                                        $brief = $request->brief;

                                        $showBriefButton = $brief != null && $brief->status == Brief::STATUS_FREE;
                                        $showBriefSended = $brief != null && $brief->status == Brief::STATUS_SENDED;


                                        ?>
                                    <div class="lk_expert_body_acts_item">

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="lk_expert_body_acts_item_head"><img src="<?= Url::to('@web/img/icons/lock.png') ?>" alt="">
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
                                                    <div>Заказчик: <span><?= $order->client->family ?></span></div>
                                                    <div>Регион: <span><?= $order->clientCity->name ?></span></div>
                                                </div>
                                                <div class="lk_expert_body_acts_item_date">
                                                    Дата публикации:   <?= $order->publicationDate("d.m.y") // 23.10.2018 ?>
                                                </div>

                                            </div>
                                            <div class="col-md-4">
                                                <div class="lk_expert_body_acts_item_rigth_top">
                                                    <div class="content_last_closed_item_img_string">
                                                        <img src="<?= Url::to('@web/img/icons/types/icon_car.png') ?>" alt="">
                                                        <div class="content_last_closed_item_img_string_span"><?= $order->typeLabel() ?></div>
                                                    </div>
                                                </div>
                                                <div class="lk_expert_body_acts_item_rigth_mid">

                                                    <?php if($showBriefButton): ?>
                                                    <div class="lk_expert_body_acts_item_rigth_bot brief-status">
                                                        <a href="" class="edit-brief" data-id="<?= $brief->id ?>">Заполнить бриф</a>
                                                    </div>
                                                    <?php endif; ?>

                                                    <?php if($showBriefSended): ?>
                                                    <div class="lk_expert_body_acts_item_rigth_bot brief-status">
                                                        Бриф отправлен
                                                    </div>
                                                    <?php endif; ?>


                                                    <div class="lk_expert_body_acts_item_rigth_bot">
                                                        <a href="" class="open-chat" data-id="<?= $chat->id ?>">Открыть чат</a>
                                                    </div>

                                                    Бюджет задачи:   <span><?= $order->budget_to ?> руб.</span>


                                                    <?php if($order->status == \common\models\Order::STATUS_WAITING_RESERVATION): ?>
                                                        <span>Заказ ожидает подтверждения оплаты клиентом</span>
                                                    <?php endif; ?>


                                                </div>

                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="lk_expert_body_acts_item_rew">

                                                    <div class="lk_expert_body_acts_item_rew_top">
                                                        <div class="row">
                                                            <div class="col-md-4">Стоимость:   <span><?= $request->price ?> руб.</span></div>
                                                            <div class="col-md-4"></div>
                                                        </div>
                                                    </div>

                                                    <div class="lk_expert_body_acts_item_rew_text">
                                                        <?= $request->content ?>
                                                    </div>

                                                    <div class="lk_expert_body_acts_item_rew_bot">
                                                        <!--a href="">Редактировать ответ</a-->
                                                        <form action="<?= Url::to(['/requests/delete']) ?>" method="post">
                                                            <input name="id" type="hidden" value="<?= $request->id ?>">
                                                            <a class="ared delete-sended-request" href="">Удалить ответ</a>
                                                        </form>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>


                                        <!-- BRIEF -->
                                        <div class="brief">
                                            <?= $brief && isset($posted_brief) && $posted_brief->id == $brief->id ? $posted_brief_form : '' ?>
                                        </div>
                                        <!-- CHAT -->
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
    </div>

</main>


<?php

$ajaxUrl = Url::to(['/brief/get']);
$user_id = $expert->id;
$sendUrl = Url::to(['/chat/post']);
$updateUrl = Url::to(['/chat/get']);
$breafReturnUrl = Url::to(['/brief/return']);
$script = <<< JS

$('.delete-sended-request').click(function(e){
    e.preventDefault();
    $(this).closest('form').submit();
});

$('.edit-brief').click(function(e){
    e.preventDefault();
    let container = $(this).closest('.lk_expert_body_acts_item').find('.brief');
    let id = $(this).attr('data-id');
    $.get( '$ajaxUrl', {id: id}, function(response) {
            container.html(response);
    });
});

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

$('.brief').on('change', 'select[name=mark_id]', function(){
    let select = $(this).closest('.brief').find('select[name=model_id]');
    select.prop('disabled', true);
    $.get('/ajax/models', {id: $(this).val() }, function(response){
        select.html(response);
    }).error(function(e){
        console.log(e);
    }).always(function() {
        select.prop('disabled', false);
    });
});

JS;

$this->registerJs($script, View::POS_READY, 'request-dialog');
