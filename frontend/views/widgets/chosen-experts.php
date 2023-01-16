<?php
/** @var $this \yii\web\View */
/** @var $experts array */

use yii\helpers\Url;

?>


<div class="content_choised">
    <div class="content_lclosed_header content_header">Выбор редакции</div>

    <?php if(count($experts) == 0): ?><p>Нет ни одного эксперта</p><?php endif; ?>

    <div class="row">
        <?php foreach($experts as $expert): /** @var $expert \common\models\User */ ?>
            <div class="col-md-6">
                <div class="mh_choise_block">
                    <div class="r_top_experts_inner clearfix">
                        <div class="r_top_experts_inner_photo" style="background-image: url(<?= Url::to($expert->avatar) ?>);">
                            <a href="<?= Url::to(['profile/info', 'id'=> $expert->id ]) ?>"></a>
                        </div>
                        <div class="texpothers">
                            <div class="r_top_experts_inner_icons">
                                <ul>
                                    <?php if($top = $expert->isTop()):  ?>
                                        <li class="r_top_experts_inner_icons_top">топ</li>
                                        <li class="r_top_experts_inner_icons_count"><?= $top ?></li>
                                    <?php endif; ?>
                                    <li class="r_top_experts_inner_icons_safe unact"></li>
                                </ul>
                            </div>
                            <div class="r_top_experts_inner_name"><?= $expert->family . ' ' . $expert->firstname ?></div>
                            <div class="r_top_experts_inner_sub"><?= implode(', ', $expert->specialization) ?></div>
                            <div class="r_top_experts_inner_count">
                                Сделок через сайт: <span><?= $expert->completedOrdersCount ?></span>
                            </div>
                            <div class="r_top_experts_inner_rew">
                                Отзывы:
                                <span class="r_top_experts_inner_rew_r_plus"><a href="<?= Url::to(['/profile/reviews', 'id' => $expert->id, 'param' => 'pos' ]) ?>">+ <?= $expert->positiveReviewsCount() ?></a></span>
                                <span class="r_top_experts_inner_rew_r_minus"><a href="<?= Url::to(['/profile/reviews', 'id' => $expert->id, 'param' => 'neg' ]) ?>">- <?= $expert->negativeReviewsCount() ?></a></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php endforeach; ?>
    </div>

</div>

