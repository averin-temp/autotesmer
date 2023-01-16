<?php
/** @var $this \yii\web\View */
/** @var $dispute \common\models\Dispute */
/** @var $user \common\models\User */
/** @var $chat \common\models\Chat */


use yii\helpers\Url;
use frontend\assets\NiceScrollAsset;
use frontend\assets\ChatAsset;

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

                        <?php if($appeal = $dispute->clientAppeal): ?>



                        <h3>Текст обращения</h3>
                        <p>
                            <?= $appeal->content ?>
                        </p>
                        <?php endif; ?>

                        <br>

                        <div id="chat">



                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</main>
<?php

$chat_id = $chat->id;
$user_id = $user->id;

$sendUrl = Url::to(['/chat/post']);
$updateUrl = Url::to(['/chat/get']);

$script = <<< JS
let container = $('#chat');
    
$(container).OpenChat({
    id: $chat_id,
    user: $user_id,
    sendUrl: '$sendUrl',
    updateUrl:'$updateUrl'
});

JS;

$this->registerJs($script);

