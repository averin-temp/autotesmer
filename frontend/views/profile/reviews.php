<?php
/** @var $this \yii\web\View */
/** @var $expert \common\models\User */
/** @var $reviews array */
/** @var $param string */
use yii\helpers\Url;
use frontend\widgets\ProfileUserPanel;
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
                            <li><span>Профиль</span></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-9">
                    <div class="lk_user_body">

                        <div class="lk_expert_body_packejes_tabs">
                            <ul>
                                <li><a href="<?= Url::to(['profile/info', 'id'=> $expert->id ]) ?>">Информация</a></li>
                                <li><a href="<?= Url::to(['profile/works', 'id'=> $expert->id ]) ?>">Выполненные работы</a></li>
                                <li class="active"><a href="<?= Url::to(['profile/reviews', 'id'=> $expert->id ]) ?>">Отзывы</a></li>
                            </ul>
                        </div>
                        <div class="lk_expert_body_packejes_tabs_body">
                            <div class="lk_user_body_chat_closed">
                                <div class="expert_page_item_inner">
                                    <div class="expert_page_item_inner_rews">
                                        <div class="expert_page_item_inner_rews_top">
                                            <ul>
                                                <li<?= $param != 'pos' && $param != 'neg' ? ' class="active"' : '' ?>><a href="<?= Url::to(['profile/reviews', 'id'=> $expert->id, 'param' => 'all' ]) ?>"><span>Все </span>(<?= $expert->reviewsCount() ?>)</a></li>
                                                <li<?= $param == 'pos' ? ' class="active"' : '' ?>><a href="<?= Url::to(['profile/reviews', 'id'=> $expert->id, 'param' => 'pos' ]) ?>"><span>Положительные </span>(<?= $expert->positiveReviewsCount() ?>)</a></li>
                                                <!--li><a href="<?= Url::to(['profile/reviews', 'id'=> $expert->id, 'status' => 'ntr' ]) ?>"><span>Нейтральные </span>(0)</a></li-->
                                                <li<?= $param == 'neg' ? ' class="active"' : '' ?>><a href="<?= Url::to(['profile/reviews', 'id'=> $expert->id, 'param' => 'neg' ]) ?>"><span>Отрицательные </span>(<?= $expert->negativeReviewsCount() ?>)</a></li>
                                            </ul>
                                        </div>
                                        <div class="expert_page_item_inner_rews_body">

                                            <?php

                                            if(count($reviews) == 0) echo "<p>Нет отзывов</p>";

                                            ?>


                                            <?php foreach($reviews as $review):
                                                /** @var $review \common\models\Review */
                                                /** @var \common\models\User $sender */
                                                $sender = $review->getSender();

                                                ?>
                                                <div class="expert_page_item_inner_rews_body_item clearfix">
                                                    <div class="expert_page_item_inner_rews_body_item_img" style="background-image: url(<?= $sender->avatar ?>);"></div>
                                                    <div class="expert_page_item_inner_rews_body_item_cont">
                                                        <div class="expert_page_item_inner_rews_body_item_cont_top">
                                                            <?php if($review->evaluation == 1): ?><div class="exit_rec rec">Рекомендую</div><?php endif; ?>
                                                            <?php if($review->evaluation == -1): ?><div class="exit_rec norec">Не рекомендую</div><?php endif; ?>
                                                            <div class="exit_name"><?= $sender->firstname . ' ' . $sender->family ?> </div>
                                                            <div class="exit_text">за выполнение заказа</div>
                                                            <div class="exit_prj">Консультация</div>
                                                        </div>
                                                        <div class="expert_page_item_inner_rews_body_item_cont_mid"><?= $review->content ?></div>
                                                        <div class="expert_page_item_inner_rews_body_item_cont_bot">17. 10. 2018</div>
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
                <div class="col-md-3 expert_page_side">
                    <?= ProfileUserPanel::widget(['expert' => $expert]) ?>
                </div>
            </div>

        </div>
    </div>
    </div>
</main>
