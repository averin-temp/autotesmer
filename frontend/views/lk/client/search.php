<?php


/** @var $this \yii\web\View */
/** @var $client \common\models\User */
/** @var $orders array */

use yii\helpers\Url;
use frontend\assets\ChatAsset;
use frontend\assets\NiceScrollAsset;

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
                            <li><a href="<?= Url::home() ?>">Главная</a></li>
                            <li><span>></span></li>
                            <li><span>Личный кабинет</span></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <?= $this->render('left-sidebar', ['menu' => 'works']) ?>
                </div>
            </div>
            <div class="col-md-9">
                <div class="lk_user_body">

                    <?= $this->render('my-orders-tabs') ?>

                    <div class="lk_expert_body_packejes_tabs_body">

                        <?php if(count($orders) == 0) echo "Нет новых заказов";

                        foreach($orders as $order){
                            echo $this->render('search-order-block', ['order' => $order]);

                            foreach($order->activeRequests as $request){
                                echo $this->render('search-request-block', [ 'request' => $request , 'order' => $order, 'safeDialEnabled' => $safeDialEnabled ]);
                            }
                        } ?>
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
$brief_url = Url::to(['brief/view']);
$script = <<< JS
$('.choose-button, .refuse-button, .delete-order, .sendbrif, .safe-dial').click(function(e){
    e.preventDefault();
    $(this).closest('form').submit()
});

$('.open-chat').click(function(e){
    e.preventDefault();
    $(this).hide();
    let id = $(this).attr('data-id');
    let container = $(this).closest('.lk_user_body_exp').find('.chat');
    $('.chat').closeChat();
    $(container).OpenChat({
        id: id,
        user: $user_id,
        sendUrl: '$sendUrl',
        updateUrl:'$updateUrl'
    });
    $(this).closest('.lk_user_body_exp').find('.close-chat').show();
    
});

$('.close-chat').click(function(e){
    e.preventDefault();
    $(this).hide();
    $('.chat').closeChat();
    $(this).closest('.lk_user_body_exp').find('.open-chat').show();
});


$('.safe-work-button').on('click', '' , function(){});



$('.show-brief').click(function(e){
    e.preventDefault();
    let button = $(this);
    let id = $(this).attr('data-brief');
    let container = $(this).closest('.lk_user_body_exp').find('.brief-view');
    let close_btn = $(this).closest('.lk_user_body_exp').find('.hide-brief');
    $.post('$brief_url', {id: id}, function(response){
        container.html(response);
        button.hide();
        close_btn.show();
    }, 'json');
});


$('.hide-brief').click(function(e){
    e.preventDefault();
    $(this).hide();
    $(this).closest('.lk_user_body_exp').find('.brief-view').html('');
    $(this).closest('.lk_user_body_exp').find('.show-brief').show();
});

JS;

$this->registerJs($script);
