<?php
/** @var $this \yii\web\View */
/** @var $experts array */
/** @var $categories array */
/** @var $category int */
use yii\helpers\Url;
use common\classes\OrderType;
?>

<div class="r_top_experts">
    <div class="r_top_experts_header clearfix">
        <div class="r_top_experts_header_left">
            Топ эксперты
        </div>
        <div class="r_top_experts_header_right">
            <a href="<?= Url::to(['/site/experts']) ?>">Все</a>
        </div>
    </div>
    <div class="r_top_experts_form">
        <form id="top-experts-form" action="<?= Url::to(['site/index']) ?>" method="get">
            <select name="top-category" id="top-category" style="padding: 10px">
                <option value=""<?= $category == '' ? ' selected' : '' ?>>Все категории</option>
                <?php foreach($categories as $categoryIndex => $categoryInfo): ?>
                <option value="<?= $categoryIndex ?>"<?= $category == $categoryIndex ? ' selected' : '' ?>><?= $categoryInfo['label'] ?></option>
                <?php endforeach; ?>
            </select>
        </form>
    </div>
    <div class="r_top_experts_wrapper">
        <?php foreach($experts as $expert):
            /** @var $expert \common\models\User */
            $top = $expert->isTop();
            ?>
        <div class="r_top_experts_inner">
            <div class="r_top_experts_inner_photo" style="background-image: url(<?= $expert->avatar ?>);">
                <a href="<?= $expert->profileUrl ?>"></a>
            </div>
            <div class="r_top_experts_inner_icons">
                <ul>
                    <?php if($top) : ?>
                    <li class="r_top_experts_inner_icons_top">
                        Top
                    </li>
                    <li class="r_top_experts_inner_icons_count">
                        <?= $top ?>
                    </li>
                    <?php endif; ?>


                    <li class="r_top_experts_inner_icons_safe unact"></li>
                </ul>
            </div>
            <div class="r_top_experts_inner_name"><?= ucfirst($expert->firstname) . ' ' . ucfirst($expert->family) ?></div>
            <div class="r_top_experts_inner_sub"><?= implode('<br>', $expert->getSpecialization()) ?></div><?php  ?>
            <div class="r_top_experts_inner_count">Сделок через сайт: <span><?= $expert->completedOrdersCount ?></span></div>
            <div class="r_top_experts_inner_rew">
                <span class="r_top_experts_inner_rew_lab">Отзывы:</span>
                <span class="r_top_experts_inner_rew_r_plus"><a href="<?= $expert->getProfileReviewsUrl() ?>">+ <?= $expert->positiveReviewsCount() ?></a></span>
                <span class="r_top_experts_inner_rew_r_minus"><a href="<?= $expert->getProfileReviewsUrl() ?>">- <?= $expert->negativeReviewsCount() ?></a></span>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<?php

$script = <<< JS
$('#top-category').change(function(){
    $('#top-experts-form').submit();
});
JS;
$this->registerJs($script, \yii\web\View::POS_READY, 'top-experts');