<?php

/* @var $this yii\web\View */
/* @var $dispute common\models\Dispute */
/* @var $messages array */

use backend\assets\ICheckAsset;
use yii\helpers\Url;
use common\models\Dispute;

use frontend\assets\NiceScrollAsset;
use frontend\assets\ChatAsset;

NiceScrollAsset::register($this);
ChatAsset::register($this);

?>

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Cпор
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Главная</a></li>
            <li><a href="<?= Url::to(['/disputes/index']) ?>">Споры</a></li>
            <li class="active">Спор</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <?php if($dispute->client_appeal_id): ?>
            <div>
                <div>Обращение клиента</div>
                <div><?= $dispute->clientAppeal->content ?></div>
            </div>
        <?php endif; ?>


        <?php if($dispute->expert_appeal_id): ?>
            <div>
                <div>Обращение эксперта</div>
                <div><?= $dispute->expertAppeal->content ?></div>

            </div>
        <?php endif; ?>


        <div class="row">
            <div class="col-md-6">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Чат с клиентом</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">

                        <div id="client-chat">

                        </div>

                    </div><!-- /.box-body -->

                </div>
            </div>
            <div class="col-md-6">

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Чат с экспертом</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">


                        <div id="expert-chat">

                        </div>

                    </div><!-- /.box-body -->

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Переписка</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">

                        <style>

                            .message{
                                display: flex;
                                flex-wrap: wrap;
                                flex-basis: 100%;
                            }

                            .message h3{
                                color: #0d6aad;
                                font-size: 14px;

                                flex-basis: 100%;
                            }


                            .message.expert-message h3{
                                text-align: right;
                            }


                            .message.client-message h3{
                                text-align: left;
                            }

                            .message p{
                                font-size: 12px;
                                display: flex;
                            }

                            .message.client-message p{
                                text-align: left;
                            }
                            .message.expert-message p{
                                text-align: right;
                            }


                        </style>





                        <?php
                        $client = $dispute->client;
                        $expert = $dispute->expert;

                        foreach($messages as $message): ?>

                        <div class="message <?= $message->author_id == $client->id ? 'client-message' : 'expert-message' ?>">


                                <h3>
                                    <?= $message->author_id == $client->id ?
                                        $client->firstname . ' ' . $client->lastname :
                                        $expert->firstname . ' ' . $expert->lastname ?>     <?= $message->getTime("d.m H:i") ?>
                                </h3>



                            <p><?= $message->text ?></p>
                        </div>

                        <?php endforeach; ?>

                    </div><!-- /.box-body -->

                </div>
            </div>
            <div class="col-md-6">

                <?php if($dispute->status != Dispute::STATUS_CLOSED): ?>

                <div class="form-group">
                    <form action="<?= Url::to(['decision']) ?>" method="post">
                        <input type="hidden" name="type" value="1">
                        <input type="hidden" name="dispute_id" value="<?= $dispute->id ?>">
                        <button>Разблокировать сделку</button>
                    </form>
                </div>

                <div class="form-group">
                    <form action="<?= Url::to(['decision']) ?>" method="post">
                        <input type="hidden" name="type" value="2">
                        <input type="hidden" name="dispute_id" value="<?= $dispute->id ?>">
                        <button>Перевести деньги эксперту и закрыть сделку</button>
                    </form>
                </div>

                <div class="form-group">
                    <form action="<?= Url::to(['decision']) ?>" method="post">
                        <input type="hidden" name="type" value="3">
                        <input type="hidden" name="dispute_id" value="<?= $dispute->id ?>">
                        <button>Перевести деньги клиенту и закрыть сделку</button>
                    </form>
                </div>

                <?php endif; ?>
            </div>
        </div>



    </section><!-- /.content -->
<?php

$sendUrl = Url::to('@frontend-web/chat/post');
$updateUrl = Url::to('@frontend-web/chat/get');

$script = <<< JS
let container = $('#client-chat');
    
$(container).OpenChat({
    id: $dispute->client_chat_id,
    user: 0,
    sendUrl: '$sendUrl',
    updateUrl:'$updateUrl'
});

container = $('#expert-chat');

$(container).OpenChat({
    id: $dispute->expert_chat_id,
    user: 0,
    sendUrl: '$sendUrl',
    updateUrl:'$updateUrl'
});

JS;

$this->registerJs($script);
