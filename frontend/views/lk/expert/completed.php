<?php
/** @var $this \yii\web\View*/
use yii\helpers\Url;

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
                            <div class="lk_user_body_chat_closed">
                                <?php if(count($orders) == 0) echo "Нет завершенных заказов" ?>
                                <?php foreach($orders as $order):
                                    /** @var $order \common\models\Order */
                                    $client = $order->client;
                                    $expert = $order->expert;
                                    ?>
                                    <div class="content_last_closed_item">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="content_last_closed_item_img">
                                                    <div class="content_last_closed_item_img_string">
                                                        <img src="/img/icons/types/icon_car.png" alt="">
                                                        <div class="content_last_closed_item_img_string_span"><?= $order->typeLabel() ?></div>
                                                    </div>
                                                    <div class="content_last_closed_item_img_string_img" style="background-image: url('<?= Url::to('@web/img/icons/main_top/icon3_h.png') ?>'"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="content_last_closed_item_body_top"><?= $order->nameLabel() ?></div>
                                                <div class="content_last_closed_item_body_subtop">
                                                    <div class="row">
                                                        <div class="col-md-4 col-sm-6">
                                                            <div class="content_last_closed_item_body_subtop_top">Марка</div>
                                                            <div class="content_last_closed_item_body_subtop_bot"><?= $order->model->name ?></div>
                                                        </div>
                                                        <div class="col-md-4 col-sm-6">
                                                            <div class="content_last_closed_item_body_subtop_top">Срок подбора</div>
                                                            <div class="content_last_closed_item_body_subtop_bot"><?= $order->period_to ?> дня</div>
                                                        </div>
                                                        <div class="col-md-4 col-sm-6">
                                                            <div class="content_last_closed_item_body_subtop_top">Стоимость</div>
                                                            <div class="content_last_closed_item_body_subtop_bot bold"><?= $order->dial->reward ?></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="content_last_closed_item_body_content">
                                                    <?= $order->comment ?>
                                                </div>
                                                <div class="content_last_closed_item_body_footer">
                                                    <div class="row align-middle">
                                                        <div class="col-md-6 text-left">
                                                            <div class="content_last_closed_item_body_footer_img" style="background-image: url(<?= $order->expert->avatar ?>);">
                                                                <a href=""></a>
                                                            </div>
                                                            <span class="content_last_closed_item_body_footer_span">
                                                Эксперт: <span><a style="color: black" href="<?= $order->expert->profileUrl ?>"><?= ucfirst($order->expert->family) . ' ' . ucfirst($order->expert->firstname) ?></a></span>
                                            </span>
                                                        </div>
                                                        <div class="col-md-6 text-right">
                                                            <div class="content_last_closed_item_body_footer_span_r">
                                                                <a href="#" class="content_last_closed_item_body_footer_span_r_openclose">
                                                                    <span>Скрыть отзывы о сделке</span>
                                                                    <span>Посмотреть отзывы о сделке</span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <?php $reviews = $order->reviewsSorted ?>
                                        <div class="content_last_closed_item_sub">
                                            <div class="row">

                                                <div class="col-md-6">
                                                    <div class="content_reviews_item_header clearfix">
                                                        <div class="content_reviews_item_header_img" style="background-image: url('<?= $client->avatar ?>')">
                                                            <a href="<?= $client->getProfileUrl() ?>"></a>
                                                        </div>
                                                        <div class="content_reviews_item_header_text">
                                                            <div class="content_reviews_item_header_text_label lab1">Заказчик</div>
                                                            <div class="content_reviews_item_header_text_text"><?= $client->family . ' ' . $client->firstname ?></div>
                                                        </div>
                                                    </div>
                                                    <?php if(empty($reviews['client'])): ?>
                                                        <div class="content_last_closed_item_sub_rev">
                                                            <div class="content_last_closed_item_sub_rev_no_rev">
                                                                Заказчик не оставил отзыв
                                                            </div>
                                                        </div>
                                                    <?php else:
                                                        /** @var $review \common\models\Review*/
                                                        $review = $reviews['client'];  ?>
                                                        <div class="content_last_closed_item_sub_rev">
                                                            <div class="content_last_closed_item_sub_rev_rev">
                                                                <div class="content_last_closed_item_sub_rev_rev_body"><?= $review->content ?></div>
                                                                <div class="content_last_closed_item_sub_rev_rev_date"><?= $review->getDate("d.m.y") ?></div>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="content_reviews_item_header clearfix">
                                                        <div class="content_reviews_item_header_img" style="background-image: url('<?= $expert->avatar ?>')">
                                                            <a href="<?= $expert->getProfileUrl() ?>"></a>
                                                        </div>
                                                        <div class="content_reviews_item_header_text">
                                                            <div class="content_reviews_item_header_text_label lab2">Эксперт</div>
                                                            <div class="content_reviews_item_header_text_text"><?= $expert->family . ' ' . $expert->firstname ?></div>
                                                        </div>
                                                    </div>
                                                    <?php if(empty($reviews['expert'])): ?>
                                                        <div class="content_last_closed_item_sub_rev">
                                                            <div class="content_last_closed_item_sub_rev_no_rev">
                                                                Эксперт не оставил отзыв
                                                            </div>
                                                        </div>
                                                    <?php else:
                                                        /** @var $review \common\models\Review*/
                                                        $review = $reviews['expert'];  ?>
                                                        <div class="content_last_closed_item_sub_rev">
                                                            <div class="content_last_closed_item_sub_rev_rev">
                                                                <div class="content_last_closed_item_sub_rev_rev_body"><?= $review->content ?></div>
                                                                <div class="content_last_closed_item_sub_rev_rev_date"><?= $review->getDate("d.m.y") ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>

                                            <?php if($order->expertReview == null)
                                                echo $this->render('//common/review-form', [
                                                    'from' => $expert->id,
                                                    'to' => $order->client_id,
                                                    'order_id' => $order->id,
                                                    'button_text' => 'Сохранить'
                                                ]); ?>


                                        </div>



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