<?php
/**
 * @var $this \yii\web\View
 * @var $experts array
 * @var $client \common\models\User
 */


use yii\helpers\Url;

?>
<main class="lk">
    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breads_wrapper dark">
                        <ul>
                            <li><a href="<?= Url::home(); ?>">Главная</a></li>
                            <li><span>></span></li>
                            <li><span>Личный кабинет</span></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <?php $menu = 'experts'; include __DIR__ . '/left-sidebar.php' ?>
                </div>
            </div>
            <div class="col-md-9">
                <div class="lk_expert_body">
                    <div class="lk_expert_body_packejes">

                        <div class="lk_expert_body_sets">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="reg_exp_page_3">
                                        <h2>Избранные эксперты</h2>
                                    </div>
                                </div>
                            </div>

                            <div class="lk_expert_body_favor">
                                <?php if(count($experts) == 0) echo "<p>Нет избранных экспертов</p>" ?>

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
                                                                            <?php if($top = $expert->isTop()) : ?>
                                                                                <li class="r_top_experts_inner_icons_top">Top</li>
                                                                                <li class="r_top_experts_inner_icons_count"><?= $top ?></li>
                                                                            <?php endif; ?>
                                                                        </ul>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="r_top_experts_inner_name text-left"><?= ucfirst($expert->family) . ' ' . ucfirst($expert->firstname) ?></div>
                                                            <div class="r_top_experts_inner_sub_age text-left"><?= $expert->getAge() ?>, <?= ucfirst($expert->city->name) ?></div>
                                                            <div class="r_top_experts_inner_sub_sub text-left"><?= $expert->about ?></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class=" dil lk_left_body_info">
                                                        <div class="lk_left_body_info_body">
                                                            <ul>
                                                                <li><span style="margin-left: 0;"><?= implode(', ' , $expert->specialization) ?></span></li>
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
                                                    <div class="dil del">
                                                        <a href="<?= Url::to(['/favorites/remove', 'expert' => $expert->id ]) ?>">
                                                            <img src="<?= Url::to('@web/img/icons/icon_video/2.png') ?>" alt="">
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

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
