<?php
/**
 * @var $this \yii\web\View
 * @var $orders  array
 */
?>

<div class="content_last_closed">
    <div class="content_lclosed_header content_header">Последние закрытые сделки</div>

    <div class="content_last_closed_items">

        <?php foreach($orders as $order):

            /** @var $order common\models\Order */

            $expert = $order->expert;
            $client = $order->client;

            ?>

        <div class="content_last_closed_item">
            <div class="row">
                <div class="col-md-3">
                    <div class="content_last_closed_item_img">
                        <div class="content_last_closed_item_img_string">
                            <img src="/img/icons/types/icon_car.png" alt="">
                            <div class="content_last_closed_item_img_string_span">Подбор под ключ</div>
                        </div>
                        <div class="content_last_closed_item_img_string_img" style="background-image: url(/img/common/car.png);"></div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="content_last_closed_item_body_top"><?= $order->nameLabel() ?></div>
                    <div class="content_last_closed_item_body_subtop">
                        <div class="row">
                            <div class="col-md-3 col-sm-6">
                                <div class="content_last_closed_item_body_subtop_top">Марка</div>
                                <div class="content_last_closed_item_body_subtop_bot">Mercedes-Benz
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="content_last_closed_item_body_subtop_top">Модель</div>
                                <div class="content_last_closed_item_body_subtop_bot">W221</div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="content_last_closed_item_body_subtop_top">Срок подбора</div>
                                <div class="content_last_closed_item_body_subtop_bot">2 дня</div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="content_last_closed_item_body_subtop_top">Стоимость</div>
                                <div class="content_last_closed_item_body_subtop_bot bold">1 100 000
                                    р.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="content_last_closed_item_body_content">
                        Платежный документ устанавливает договор. Конфиденциальность требует
                        преддоговорный
                        причиненный ущерб. В соответствии со сложившейся правоприменительной практикой
                        норма
                        защищена.
                    </div>
                    <div class="content_last_closed_item_body_footer">
                        <div class="row align-middle">
                            <div class="col-md-6 text-left">
                                <div class="content_last_closed_item_body_footer_img" style="background-image: url('<?= $expert->avatar ?>')" >
                                    <a href=""></a>
                                </div>
                                <span class="content_last_closed_item_body_footer_span">
                                                Эксперт: <span><?= $expert->firstname . ' ' . $expert->lastname ?></span>
                                            </span>
                            </div>
                            <div class="col-md-6 text-right">
                                <div class="content_last_closed_item_body_footer_span_r">
                                    <a href="#"
                                       class="content_last_closed_item_body_footer_span_r_openclose">
                                        <span>Скрыть отзывы о сделке</span>
                                        <span>Посмотреть отзывы о сделке</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content_last_closed_item_sub">
                <div class="row">
                    <div class="col-md-6">
                        <div class="content_reviews_item_header clearfix">
                            <div class="content_reviews_item_header_img" style="background-image: url('<?= $client->avatar ?>')"></a>
                                <a href=""></a>
                            </div>
                            <div class="content_reviews_item_header_text">
                                <div class="content_reviews_item_header_text_label lab1">Заказчик</div>
                                <div class="content_reviews_item_header_text_text"><?= $client->firstname . ' ' . $client->lastname ?></div>
                            </div>
                        </div>
                        <div class="content_last_closed_item_sub_rev">
                            <?php if($review = $order->clientReview): ?>
                                <div class="content_last_closed_item_sub_rev_rev">
                                    <div class="content_last_closed_item_sub_rev_rev_body"><?= $review->content ?></div>
                                    <div class="content_last_closed_item_sub_rev_rev_date"><?= $review->getDate("d.m.y") ?></div>
                                </div>
                            <?php else: ?>
                                <div class="content_last_closed_item_sub_rev_no_rev">
                                    Заказчик не оставил отзыв
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="content_reviews_item_header clearfix">
                            <div class="content_reviews_item_header_img" style="background-image: url('<?= $expert->avatar ?>')">
                                <a href=""></a>
                            </div>
                            <div class="content_reviews_item_header_text">
                                <div class="content_reviews_item_header_text_label lab2">Эксперт</div>
                                <div class="content_reviews_item_header_text_text"><?= $expert->firstname . ' ' . $expert->lastname ?></div>
                            </div>
                        </div>
                        <div class="content_last_closed_item_sub_rev">
                            <?php if($review = $order->clientReview): ?>
                                <div class="content_last_closed_item_sub_rev_rev">
                                    <div class="content_last_closed_item_sub_rev_rev_body"><?= $review->content ?></div>
                                    <div class="content_last_closed_item_sub_rev_rev_date"><?= $review->getDate("d.m.y") ?></div>
                                </div>
                            <?php else: ?>
                                <div class="content_last_closed_item_sub_rev_no_rev">
                                    Заказчик не оставил отзыв
                                </div>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php endforeach; ?>


    </div>

</div>
