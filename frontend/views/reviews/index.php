<?php
/** @var $this \yii\web\View */
/** @var $reviews \common\models\Review[] */
/** @var $limit string */
/** @var $show string */
/** @var $pages \yii\data\Pagination */

use yii\helpers\Url;
use yii\widgets\LinkPager;

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
                            <li><span>Отзывы</span></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="experts_body">
                        <h1>Отзывы</h1>

                        <div class="rews_wrapper">
                            <div class="lk_expert_body_acts_sort clearfix">
                                <div class="lk_expert_body_acts_sort_left">
                                    Отзывы:

                                    <span class="dropdown-span-menu width-fixed">
                                        <span><?php
                                            if($show == 'all') echo "от всех пользователей";
                                            if($show == 'clients') echo "от заказчиков";
                                            if($show == 'experts') echo "от экспертов";
                                            ?></span>
                                        <img src="<?= Url::to('@web/img/icons/arb.png') ?>" alt="">
                                        <ul>
                                            <?php if($show != 'all'): ?><li><a href="<?= Url::to(['/reviews', 'limit' => $limit, 'show' => 'all']) ?>">от всех пользователей</a></li><?php endif; ?>
                                            <?php if($show != 'clients'): ?><li><a href="<?= Url::to(['/reviews', 'limit' => $limit, 'show' => 'clients']) ?>">от заказчиков</a></li><?php endif; ?>
                                            <?php if($show != 'experts'): ?><li><a href="<?= Url::to(['/reviews', 'limit' => $limit, 'show' => 'experts']) ?>">от экспертов</a></li><?php endif; ?>
                                        </ul>
                                    </span>
                                </div>
                                <div class="lk_expert_body_acts_sort_right">
                                    Показать по:
                                    <span class="dropdown-span-menu">
                                        <span><?php
                                            if($limit == '1') echo "1";
                                            if($limit == '10') echo "10";
                                            if($limit == '50') echo "50";
                                            if($limit == '100') echo "100";
                                            ?></span>
                                        <img src="<?= Url::to('@web/img/icons/arb.png') ?>" alt="">
                                        <ul>
                                            <?php if($limit != '1'): ?><li><a href="<?= Url::to(['/reviews', 'limit' => 1, 'show' => $show]) ?>">1</a></li><?php endif; ?>
                                            <?php if($limit != '10'): ?><li><a href="<?= Url::to(['/reviews', 'limit' => 10, 'show' => $show]) ?>">10</a></li><?php endif; ?>
                                            <?php if($limit != '50'): ?><li><a href="<?= Url::to(['/reviews', 'limit' => 50, 'show' => $show]) ?>">50</a></li><?php endif; ?>
                                            <?php if($limit != '100'): ?><li><a href="<?= Url::to(['/reviews', 'limit' => 100, 'show' => $show]) ?>">100</a></li><?php endif; ?>
                                        </ul>
                                    </span>

                                </div>
                            </div>
                            <div class="rews_wrapper_body">

                                <?php foreach($reviews as $review): $user = $review->sender; ?>
                                    <div class="expert_page_item_inner_rews_body_item clearfix">
                                        <div class="expert_page_item_inner_rews_body_item_img" style="background-image: url(<?= $user->avatar ?>);"></div>
                                        <div class="expert_page_item_inner_rews_body_item_cont">
                                            <div class="expert_page_item_inner_rews_body_item_cont_top">
                                                <?php if($user->can('Клиент')): ?><div class="exit_rec rec lab2">Заказчик</div><?php endif; ?>
                                                <?php if($user->can('Эксперт')): ?><div class="exit_rec rec lab1">Эксперт</div><?php endif; ?>
                                                <div class="exit_name"><?= ucfirst($user->firstname) . ' ' . ucfirst($user->family) ?></div>
                                            </div>
                                            <div class="expert_page_item_inner_rews_body_item_cont_mid"><?= $review->content ?></div>
                                            <div class="expert_page_item_inner_rews_body_item_cont_bot"><?= date_create($review->created)->format('d.m.Y') ?></div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>

                            </div>
                        </div>


                    </div>




                    <div class="paginator">
                        <div class="row">
                            <div class="col-md-12">
                                <?php echo LinkPager::widget([
                                    'pagination' => $pages,
                                    'prevPageLabel' => '<',
                                    'nextPageLabel' => '>',
                                    'lastPageLabel' => '>>',
                                    'firstPageLabel' => '<<',
                                    'options' => [
                                        'class' => '',
                                    ]
                                ]); ?>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <?php if(\Yii::$app->user->can('createSiteReview')): ?>

            <form action="<?= Url::to(['send']) ?>" method="post">
                <input type="hidden" name="from" value="<?= \Yii::$app->user->getId() ?>" >

            <div class="add_rw">
                <div class="row">
                    <div class="col-md-12">
                        <div class="f_group">
                            <textarea name="review" id="reviewMessage" cols="30" rows="10" placeholder="Напишите свой отзыв о сайте"></textarea>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <button class="button button_orange button_top_img">Добавить</button>
                    </div>
                </div>
            </div>

            </form>

            <?php endif; ?>



        </div>
    </div>
</main>


<?php

$script = <<< JS
$('.dropdown-span-menu').click( function(){
    $(this).toggleClass('open');
});
JS;

$this->registerJs($script,\yii\web\View::POS_READY,'show-reviews-script');
