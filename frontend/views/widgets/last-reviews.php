<?php

use common\models\User;
use yii\helpers\Url;
?>

<div class="content_reviews">
    <div class="content_reviews_header content_header">
        Отзывы <a href="<?= Url::to(['/reviews']) ?>" class="content_header_link">Перейти в раздел</a>
    </div>

    <div class="row">
        <?php foreach($reviews as $review):
            /** @var $review \common\models\Review */
            /** @var $author \common\models\User */
            $author = User::findOne($review->from);
            ?>
            <div class="col-md-4">
                <div class="content_reviews_item">
                    <div class="content_reviews_item_header clearfix">
                        <div class="content_reviews_item_header_img" style="background-image: url('<?= $author->avatar ?>')">
                            <a href="<?= $author->getProfileUrl() ?>"></a>
                        </div>
                        <div class="content_reviews_item_header_text">

                            <?php if($author->can('Клиент')): ?>
                                <div class="content_reviews_item_header_text_label lab1">Заказчик</div>
                                <?php elseif($author->can('Эксперт')): ?>
                                <div class="content_reviews_item_header_text_label lab2">Эксперт</div>
                            <?php endif; ?>

                            <div class="content_reviews_item_header_text_text"><?= ucfirst($author->firstname) . ' ' . ucfirst($author->lastname) ?></div>
                        </div>
                    </div>
                    <div class="content_reviews_item_body"><?= $review->content ?></div>
                    <div class="content_reviews_item_footer"><?= $review->getDate("d.m.y") ?></div>
                </div>
            </div>
        <?php endforeach;?>
    </div>

</div>
