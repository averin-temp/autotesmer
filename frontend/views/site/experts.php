<?php

/** @var $experts \common\models\User */
/** @var $tableStyle string */
/** @var $pages \yii\data\Pagination */
/** @var $limit string */
/** @var $sort string */

use yii\helpers\Url;
use frontend\widgets\BannersWidget;
use frontend\widgets\CategoryMenuWidget;
use frontend\widgets\ChosenExpertsWidget;
use yii\widgets\LinkPager;
?>
<main class="lk">
    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breads_wrapper dark3">
                        <ul>
                            <li><a href="/">Главная</a></li>
                            <li><span>></span></li>
                            <li><span>Эксперты</span></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-9">

                    <div class="experts_body">
                        <h1>Эксперты</h1>

                        <?= ChosenExpertsWidget::widget() ?>

                        <div class="lk_expert_body_acts_sort clearfix">
                            <div class="lk_expert_body_acts_sort_left">
                                Упорядочить по:
                                <span class="dropdown-span-menu width-fixed">
                                    <span>
                                        <?php
                                            if($sort == 'rating') echo "рейтингу";
                                            if($sort == 'time') echo "времени на сайте";
                                            if($sort == 'completed') echo "количеству сделок";
                                        ?>
                                    </span>
                                        <img src="<?= Url::to('@web/img/icons/arb.png') ?>" alt="">
                                        <ul>
                                            <?php if($sort != 'rating'): ?><li><a href="<?= Url::current(['sort' => 'rating']) ?>">рейтингу</a></li><?php endif; ?>
                                            <?php if($sort != 'time'): ?><li><a href="<?= Url::current(['sort' => 'time']) ?>">времени на сайте</a></li><?php endif; ?>
                                            <?php if($sort != 'completed'): ?><li><a href="<?= Url::current(['sort' => 'completed']) ?>">количеству сделок</a></li><?php endif; ?>
                                        </ul>
                                    </span>
                            </div>
                            <div class="lk_expert_body_acts_sort_right">
                                Показать по:
                                <span class="dropdown-span-menu">
                                    <span>
                                        <?php
                                            if($limit == '1') echo "1";
                                            if($limit == '10') echo "10";
                                            if($limit == '50') echo "50";
                                            if($limit == '100') echo "100";
                                        ?>
                                    </span>
                                        <img src="<?= Url::to('@web/img/icons/arb.png') ?>" alt="">
                                        <ul>
                                            <?php if($limit != '1'): ?><li><a href="<?= Url::current(['limit' => 1]) ?>">1</a></li><?php endif; ?>
                                            <?php if($limit != '10'): ?><li><a href="<?= Url::current(['limit' => 10]) ?>">10</a></li><?php endif; ?>
                                            <?php if($limit != '50'): ?><li><a href="<?= Url::current(['limit' => 50]) ?>">50</a></li><?php endif; ?>
                                            <?php if($limit != '100'): ?><li><a href="<?= Url::current(['limit' => 100]) ?>">100</a></li><?php endif; ?>
                                        </ul>
                                </span>
                                <ul class="plits_master">


                                    <li<?= $tableStyle == 'tile' ? " class=\"active\"" : '' ?>>
                                        <a href="<?= Url::current(['style' => 'tile']) ?>">
                                            <img src="<?= Url::to('@web/img/icons/plit.png') ?>" alt="">
                                            <img src="<?= Url::to('@web/img/icons/plit_h.png') ?>" alt="">
                                        </a>
                                    </li>
                                    <li<?= $tableStyle == 'row' ? " class=\"active\"" : '' ?>>
                                        <a href="<?= Url::current(['style' => 'row']) ?>">
                                            <img src="<?= Url::to('@web/img/icons/str.png') ?>" alt="">
                                            <img src="<?= Url::to('@web/img/icons/str_h.png') ?>" alt="">
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>


                        <div class="experts_body_container">


                            <?php if($tableStyle == 'tile'): ?>
                                <div class="r_top_experts_wrapper">
                                    <?php if(count($experts) == 0): ?><p>Нет ни одного эксперта</p><?php endif; ?>
                                    <div class="row">
                                        <?php foreach($experts as $expert): /** @var $expert \common\models\User */ ?>
                                            <div class="col-md-4">
                                                <div class="r_top_experts_inner">
                                                    <div class="r_top_experts_inner_photo" style="background-image: url('<?= $expert->avatar ?>');">
                                                        <a href="<?= Url::to(['profile/info', 'id'=> $expert->id ]) ?>"></a>
                                                    </div>
                                                    <div class="r_top_experts_inner_icons">
                                                        <ul>
                                                            <?php if($expert->isTop()): ?>
                                                                <li class="r_top_experts_inner_icons_top">топ</li>
                                                                <li class="r_top_experts_inner_icons_count"><?= $expert->isTop() ?></li>
                                                            <?php endif; ?>
                                                            <li class="r_top_experts_inner_icons_safe unact"></li>
                                                        </ul>
                                                    </div>
                                                    <div class="r_top_experts_inner_name"><?= ucfirst($expert->firstname) . ' ' . ucfirst($expert->family) ?></div>
                                                    <div class="r_top_experts_inner_name_inform">
                                                        <div class="r_top_experts_inner_name_inform_age">
                                                            <?= $expert->getAge() ?> лет, <?= $expert->city->name ?>
                                                        </div>
                                                        <div class="r_top_experts_inner_name_inform_body">
                                                            <?= $expert->about ?>

                                                        </div>
                                                        <div class="r_top_experts_inner_name_inform_border">
                                                        </div>
                                                    </div>
                                                    <div class="r_top_experts_inner_sub"><?= implode('<br>', $expert->getSpecialization()) ?></div>
                                                    <div class="r_top_experts_inner_count mtmin">
                                                        На сайте: <span> <?= $expert->registrationTermLabel ?></span>
                                                    </div>
                                                    <div class="r_top_experts_inner_count">
                                                        Сделок через сайт: <span><?= $expert->completedOrdersCount ?></span>
                                                    </div>
                                                    <div class="r_top_experts_inner_rew">
                                                        <span class="r_top_experts_inner_rew_lab">Отзывы:</span>
                                                        <span class="r_top_experts_inner_rew_r_plus"><a href="<?= Url::to(['/profile/reviews', 'id' => $expert->id, 'param' => 'pos' ]) ?>">+ <?= $expert->positiveReviewsCount() ?></a></span>
                                                        <!--span class="r_top_experts_inner_rew_r_netral"><a href="">0</a></span-->
                                                        <span class="r_top_experts_inner_rew_r_minus"><a href="<?= Url::to(['/profile/reviews', 'id' => $expert->id, 'param' => 'neg' ]) ?>">- <?= $expert->negativeReviewsCount() ?></a></span>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php if($tableStyle == 'row'): ?>
                                <?php foreach($experts as $expert): /** @var $expert \common\models\User */ ?>
                                    <div class="lk_expert_body_favor_item">

                                        <div class="lk_expert_body_acts">

                                            <div class="lk_expert_body_acts_item">
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <div class="lk_expert_body_acts_item_body">
                                                                    <div class="r_top_experts_inner">
                                                                        <div class="r_top_experts_inner_photo" style="background-image: url('<?= $expert->avatar ?>');">
                                                                            <a href="<?= Url::to(['profile/info', 'id'=> $expert->id ]) ?>"></a>
                                                                        </div>
                                                                        <div class="r_top_experts_inner_icons">
                                                                            <ul>
                                                                                <?php if($expert->isTop()): ?>
                                                                                    <li class="r_top_experts_inner_icons_top">топ</li>
                                                                                    <li class="r_top_experts_inner_icons_count"><?= $expert->isTop() ?></li>
                                                                                <?php endif; ?>
                                                                                <li class="r_top_experts_inner_icons_safe unact"></li>
                                                                            </ul>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-9">
                                                                <div class="r_top_experts_inner_name text-left"><?= ucfirst($expert->firstname) . ' ' . ucfirst($expert->family) ?></div>
                                                                <div class="r_top_experts_inner_sub_age text-left"><?= $expert->getAge() ?> лет, <?= $expert->city->name ?></div>
                                                                <div class="r_top_experts_inner_sub_sub text-left"><?= $expert->about ?></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class=" lk_left_body_info">
                                                            <div class="lk_left_body_info_body">
                                                                <ul>
                                                                    <li><span style="margin-left: 0;"><?= implode('<br>', $expert->getSpecialization()) ?></span></li>
                                                                    <li>На сайте: <span><?= $expert->registrationTermLabel ?></span></li>
                                                                    <li>Сделок через сайт<span><?= $expert->completedOrdersCount ?></span></li>


                                                                    <li>
                                                                        <div class="r_top_experts_inner_rew">
                                                                            Отзывы:
                                                                            <span class="r_top_experts_inner_rew_r_plus"><a href="<?= Url::to(['/profile/reviews', 'id' => $expert->id, 'param' => 'pos' ]) ?>">+ <?= $expert->positiveReviewsCount() ?></a></span>
                                                                            <!--span class="r_top_experts_inner_rew_r_netral"><a href="">0</a></span-->
                                                                            <span class="r_top_experts_inner_rew_r_minus"><a href="<?= Url::to(['/profile/reviews', 'id' => $expert->id, 'param' => 'neg' ]) ?>">- <?= $expert->negativeReviewsCount() ?></a></span>
                                                                        </div>
                                                                    </li>
                                                                </ul>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                <?php endforeach; ?>

                            <?php endif; ?>



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
                <div class="col-md-3">
                    <div class="experts_right">
                        <h2>Категории</h2>

                    </div>

                    <div class="lk_left">
                        <?= CategoryMenuWidget::widget(['active' => $currentCategory]) ?>
                        <br>
                        <div class="r_adv">
                            <?= BannersWidget::widget(['position' => 3]) ?>
                        </div>

                    </div>
                </div>
            </div>

        </div>
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
