<?php

/** @var $this \yii\web\View */
/** @var $orders array */
/** @var $user null|User */
/** @var $user_is_expert boolean */
/** @var $currencies array */
/** @var $currentCategory string */
/** @var $editableRequest \common\models\Request|null */


use yii\helpers\Url;
use common\models\Order;
use \yii\web\View;
use common\models\User;
use frontend\widgets\CategoryMenuWidget;
use frontend\widgets\BannersWidget;
use common\models\Request;



?>
<main class="lk">
    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breads_wrapper">
                        <ul>
                            <li><a href="/">Главная</a></li>
                            <li><span>></span></li>
                            <li><span>Заказы</span></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-9">
                    <div class="experts_body">
                        <h1>Заказы</h1>

                        <div class="orders_wrapper">
                            <?php /** @var $order Order*/
                            foreach($orders as $order):
                                $request = $user ? $order->getUserRequest($user->id) : [];
                            ?>
                            <div class="expfull exp" data-order="<?= $order->id ?>">
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
                                                            <div>Заказчик: <span><?= $order->client->family ?></span></div>
                                                            <div>Регион: <span><?= $order->region ?></span></div>
                                                        </div>

                                                        <div class="lk_expert_body_acts_item_date">
                                                            <span class="date_coun">Дата публикации:   <?= $order->publicationDate("d.m.y") // 23.10.2018 ?></span>
                                                            <span class="answers_ti">Ответов:   <?= $order->requestsCount() ?></span>
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

                                                        <div class="lk_expert_body_acts_item_rigth_mid">
                                                            Стоимость: <span><?= $order->budget_to ?> руб.</span>
                                                        </div>

                                                        <div class="lk_expert_body_acts_item_rigth_mid">
                                                            Срок подбора: <span><?= $order->period_from ?>-<?= $order->period_to ?> дней</span>
                                                        </div>

                                                        <div class="lk_expert_body_acts_item_rigth_mid">
                                                            Бюджет задачи: <span><?= $order->budget_to ?> руб.</span>
                                                        </div>

                                                        <?php if($user_is_expert && !$request && $user->allowedFor2($order->type)):?>
                                                        <div class="lk_expert_body_acts_item_rigth_bot ">
                                                            <a href="" class="send-request">Подать заявку</a>
                                                        </div>
                                                        <?php endif; ?>

                                                    </div>

                                                </div>

                                                <?php if($request && ($editableRequest == null || $editableRequest->id != $request->id )): ?>
                                                    <div class="row sended-request">

                                                        <div class="col-md-12">
                                                            <div class="lk_expert_body_acts_item_rew">

                                                                <div class="lk_expert_body_acts_item_rew_top">
                                                                    <div class="row">
                                                                        <div class="col-md-4">Стоимость:   <span><?= $request->price ?></span></div>
                                                                        <div class="col-md-4"></div>
                                                                    </div>
                                                                </div>

                                                                <div class="lk_expert_body_acts_item_rew_text">
                                                                    <?= $request->content ?>
                                                                </div>

                                                                <div class="lk_expert_body_acts_item_rew_bot">
                                                                    <form action="<?= Url::to(['orders/index', 'category' => $currentCategory ]) ?>" method="post">
                                                                        <input type="hidden" name="id" value="<?= $request->id ?>">
                                                                        <button type="submit" class="ablue-button edit-sended-request">Редактировать ответ</button>
                                                                    </form>
                                                                    <form action="<?= Url::to(['/requests/delete', 'id' => $request->id ]) ?>" method="post">
                                                                        <button class="ared-button delete-sended-request" type="submit">Удалить ответ</button>
                                                                    </form>
                                                                </div>

                                                            </div>
                                                        </div>

                                                    </div>
                                                <?php endif; ?>

                                                <?php if($editableRequest && $editableRequest->order_id == $order->id && $editableRequest->expert_id == $user->id){
                                                        echo $this->render('request-dialog', [
                                                            'request' => $editableRequest,
                                                            'id' => '',
                                                            'currencies' => $currencies,
                                                            'category' => $currentCategory
                                                        ]);
                                                } ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>

                    </div>

                    <?php if("отлажены ордера" == false): ?>
                    <div class="paginator">
                        <div class="row">
                            <div class="col-md-12">
                                <ul>
                                    <li><a href="">&lt;&lt;</a></li>
                                    <li><a href="">&lt;</a></li>
                                    <li><a href="">1</a></li>
                                    <li><a href="">2</a></li>
                                    <li class="active"><a href="">3</a></li>
                                    <li><a href="">...</a></li>
                                    <li><a href="">22</a></li>
                                    <li><a href="">23</a></li>
                                    <li><a href="">24</a></li>
                                    <li><a href="">&gt;</a></li>
                                    <li><a href="">&gt;&gt;</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>


                </div>
                <div class="col-md-3">
                    <div class="experts_right">
                        <h2>Категории</h2>

                    </div>

                    <div class="lk_left">
                        <?= CategoryMenuWidget::widget(['active' => $currentCategory]) ?>
                        <br>
                        <div class="r_adv">
                            <?= BannersWidget::widget(['position' => 2]) ?>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>

    <?php if($user_is_expert){
        echo $this->render('request-dialog', [
            'request' => new Request([ 'expert_id' => $user->id ]),
            'id' => 'requestFormTmpl',
            'currencies' => $currencies,
            'category' => $currentCategory
        ]);
    } ?>


</main>
<?php
if($user_is_expert){
    $script = <<< JS

var template = $('#requestFormTmpl');
template.attr('id', '');
var dialog = template.clone();
template.remove();
    
    $('.send-request').click(function(e){
        e.preventDefault();
        $('.request-dialog').remove();
        let new_dialog = $(dialog).clone();
        let order = $(this).closest('.expfull').attr('data-order');
        new_dialog.find('input[name="request[order_id]"]').val(order);
        $(this).closest('.lk_expert_body_acts_item').append(new_dialog);
    });

JS;

    $this->registerJs($script, View::POS_READY, 'request-dialog');

}
