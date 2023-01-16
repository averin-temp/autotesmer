<?php

/** @var $this \yii\web\View */
/** @var $expert \common\models\User */

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
                            <li><span>Профиль эксперта <?= $expert->family . ' ' . strtoupper(mb_substr($expert->firstname, 0 , 1)) . '. ' . strtoupper(mb_substr($expert->lastname, 0 , 1))  ?></span></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-9">
                    <div class="lk_user_body">

                        <div class="lk_expert_body_packejes_tabs">
                            <ul>
                                <li class="active"><a href="<?= Url::to(['profile/info', 'id'=> $expert->id ]) ?>">Информация</a></li>
                                <li><a href="<?= Url::to(['profile/works', 'id'=> $expert->id ]) ?>">Выполненные работы</a></li>
                                <li><a href="<?= Url::to(['profile/reviews', 'id'=> $expert->id ]) ?>">Отзывы</a></li>
                            </ul>
                        </div>
                        <div class="lk_expert_body_packejes_tabs_body">
                            <div class="lk_user_body_chat_closed">
                                <div class="expert_page_item_inner">
                                    <div class="expert_page_item_inner_img">
                                        <?= $expert->text ?>
                                    </div>
                                    <div class="expert_page_item_inner_text">
                                        <h3>О себе</h3>
                                        <p><?= $expert->about ?></p>
                                        <h3>Резюме</h3>
                                        <p><?= $expert->resume ?></p>
                                    </div>
                                    <div class="content_videos">
                                        <div class="content_videos_header content_header">Видео эксперта</div>
                                        <?php

                                        $videos = $expert->videos;
                                        if(count($videos) == 0) echo "У пользователя нет загруженных видео";

                                        ?>
                                        <div class="row">
                                            <?php foreach($videos as $video):
                                                /** @var $video \common\models\Video*/
                                                /** @var $user \common\models\User*/
                                                $author = $video->user;
                                                ?>
                                                <div class="col-md-4">
                                                    <div class="content_videos_item">
                                                        <div class="content_video_img" style="background-image: url(<?= $video->getImage() ?>);">
                                                            <a href="<?= $video->watchLink() ?>"></a></div>
                                                        <div class="content_video_info clearfix">
                                                            <div class="content_video_info_left"><a href="<?= $author->profileUrl ?>"><?= $author->firstname . ' ' . $author->family ?></a></div>
                                                            <div class="content_video_info_right"><?= $video->getAgeLabel() ?></div>
                                                        </div>
                                                        <div class="content_video_name"><a href="<?= $video->watchLink() ?>"><?= $video->name ?></a></div>
                                                        <div class="content_video_tags">
                                                            <ul>
                                                                <?php foreach($video->getTags() as $tag): ?>
                                                                    <li><a href="#"><?= $tag ?></a></li>
                                                                <?php endforeach; ?>
                                                            </ul>
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
                <div class="col-md-3 expert_page_side">
                    <?= ProfileUserPanel::widget(['expert' => $expert]) ?>
                </div>
            </div>

        </div>
    </div>
    </div>
</main>
