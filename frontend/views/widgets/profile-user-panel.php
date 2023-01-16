<?php

/** @var $this \yii\web\View */
/** @var $expert \common\models\User */
/** @var $show_add_favorite_button boolean */
/** @var $show_offer_button boolean */

use yii\helpers\Url;
?>

<div class="lk_left">
    <div class="lk_left_body">
        <div class="lk_left_body_photo">
            <div class="lk_left_body_photo_top" style="background-image: url('<?= $expert->avatar ?>');"
        </div>

    </div>
    <div class="lk_left_body_statuswork">
        <span><?= $expert->getBusynessLabel() ?></span>
    </div>
    <div class="lk_left_body_name">
        <span><?= $expert->firstname . ' ' , $expert->family ?></span>
        <span class="sttis_expert"><?= $expert->status ?></span>
        <span class="sttis_onlin">Сейчас на сайте</span>

    </div>

    <div class="expert_page_side_item">
        <h3>Специализация</h3>
        <div class="expert_page_side_item_content">
            <div class="lk_left_body_info_body">
                <ul>
                    <li><span class="ml0"><?= implode(', ', $expert->getSpecialization()) ?></span></li>
                </ul>

            </div>
        </div>
    </div>

    <div class="sidredvdr"></div>


    <div class="expert_page_side_item">
        <h3>На сайте</h3>
        <div class="expert_page_side_item_content">
            <div class="lk_left_body_info_body">
                <ul>
                    <li>На сайте: <span> <?= $expert->getRegistrationTermLabel() ?></span></li>
                    <li>Текущих сделок: <span><?= count($expert->getCurrentWorks()) ?></span></li>
                    <li>Безопасных сделок: <span><?= count($expert->getCompletedSafeDiads()) ?></span></li>
                    <li>Сделок через сайт: <span><?= $expert->completedOrdersCount ?></span></li>
                    <li>
                        <div class="r_top_experts_inner_rew">
                            Отзывы:
                            <span class="r_top_experts_inner_rew_r_plus"><a href="<?= $expert->getProfileReviewsUrl() ?>">+ <?= $expert->positiveReviewsCount() ?></a></span>
                            <span class="r_top_experts_inner_rew_r_netral"><a href="">0</a></span>
                            <span class="r_top_experts_inner_rew_r_minus"><a href="<?= $expert->getProfileReviewsUrl() ?>">- <?= $expert->negativeReviewsCount() ?></a></span>
                        </div>
                    </li>
                </ul>

            </div>
        </div>
    </div>

    <div class="sidredvdr"></div>

    <div class="expert_page_side_item">
        <h3>Возраст и опыт</h3>
        <div class="expert_page_side_item_content">
            <div class="lk_left_body_info_body">
                <ul>
                    <li>Возраст: <span><?= $expert->getAge() ?></span></li>
                    <li>Город: <span> <?= ucfirst($expert->city->name) ?></span></li>
                </ul>

            </div>
        </div>
    </div>
    <div class="sidredvdr"></div>

    <div class="expert_page_side_item">
        <h3>Контакты</h3>
        <div class="expert_page_side_item_content">
            <div class="lk_left_body_info_body">
                <ul>
                    <?php
                    $confirmed_icon = Url::to('@web/img/icons/steps/ok.jpg');
                    $unconfirmed_icon = Url::to('@web/img/icons/steps/nok.png');
                    $icon = $expert->confirmed_phone ? $confirmed_icon : $unconfirmed_icon;
                    $label = $expert->confirmed_phone ? "Проверенный телефон" : "Телефон не проверен";
                    ?>
                    <li>
                        <img src="<?= $icon ?>" alt=""><?= $label ?>: <span class="ml0">
                                                <?= $expert->phone ?>
                                            </span>
                    </li>
                    <?php
                    $icon = $expert->confirmed_email ? $confirmed_icon : $unconfirmed_icon;
                    $label = $expert->confirmed_email ? "Проверенный email" : "Email не проверен";
                    ?>
                    <li><img src="<?= $icon ?>" alt=""><?= $label ?>: <span
                            class="ml0"><?= $expert->email ?></span></li>
                    <!--li>Telegram: <span> @ev.tar21</span></li-->
                </ul>

            </div>
        </div>
    </div>
    <div class="expert_page_side_item">
        <div class="expert_page_side_item_bot_socs lk_left_body_info_body">
            <ul>
                <?php if($expert->profile_facebook): ?>
                    <li>
                        <a href="<?= $expert->profile_facebook ?>" style="color: #4a76a8;">
                            <i class="fa fa-facebook" aria-hidden="true"></i>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if($expert->profile_vk): ?>
                    <li>
                        <a href="<?= $expert->profile_vk ?>" style="color: #4a76a8;">
                            <i class="fa fa-vk" aria-hidden="true"></i>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if($expert->profile_twitter): ?>
                    <li>
                        <a href="<?= $expert->profile_facebook ?>" style="color: #4a76a8;">
                            <i class="fa fa-twitter" aria-hidden="true"></i>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
    <div class="expert_page_side_item_bot">
        <?php if(0&&$show_offer_button): ?>
        <a class="button button_orange button_top_img" href="<?= Url::to(['/orders/offer', 'expert' => $expert->id]) ?>">Предложить заказ</a>
        <?php endif; ?>
        <?php if($show_add_favorite_button): ?>
        <a class="button button_orange button_top_img" href="<?= Url::to(['/favorites/set', 'expert' => $expert->id]) ?>">Добавить в избранные</a>
        <?php endif; ?>
    </div>


</div>
