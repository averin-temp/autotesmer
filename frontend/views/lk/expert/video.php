<?php
/** @var $this \yii\web\View */
/** @var $videos array */



use yii\helpers\Url;

?><main class="lk">
    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breads_wrapper dark">
                        <ul>
                            <li><a href="/">Главная</a></li>
                            <li><span>></span></li>
                            <li><span>Личный кабинет</span></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <?php $menu = 'video'; include __DIR__ . '/left-sidebar.php'; ?>
                </div>
            </div>
            <div class="col-md-9">
                <div class="lk_expert_body">
                    <div class="lk_expert_body_video">
                        <div class="lk_expert_body_video_top">
                            <div class="row">
                                <div class="col-md-6">
                                    <h1>Мои видео</h1>
                                </div>
                                <div class="col-md-6 text-md-right">
                                    <a href="<?= Url::to(['/expert/editvideo']) ?>" class="button button_orange button_top_img post-video-button">Загрузить видео</a>
                                </div>
                            </div>
                        </div>

                        <div class="lk_expert_body_acts_sort clearfix">
                            <div class="lk_expert_body_acts_sort_left">
                                Период: <span>год <img src="<?= Url::to('@web/img/icons/arb.png') ?>" alt=""></span>
                            </div>
                            <div class="lk_expert_body_acts_sort_right">
                                Сортировать: <span>по дате <img src="<?= Url::to('@web/img/icons/arb.png') ?>" alt=""></span>

                            </div>
                        </div>

                        <div class="videos">

                            <?php foreach($videos as $video): /** @var $video \common\models\Video */?>

                                <div class="lk_expert_body_video_item">
                                    <div class="row justify-content-center align-items-center">
                                        <div class="col-md-4 align-middle">

                                            <!--div class="lk_expert_body_video_item_image">
                                                <div class="video-wrapper-16-9">
                                                    <?= $video->getHtml() ?>
                                                </div>
                                            </div-->

                                            <div class="lk_expert_body_video_item_image" style="background-image: url('<?= $video->getImage() ?>')"></div>

                                        </div>
                                        <div class="col-md-7 align-middle">
                                            <div class="lk_expert_body_video_item_body_top"><?= $video->getAgeLabel() ?></div>
                                            <div class="lk_expert_body_video_item_body_middle"><?= $video->name ?></div>
                                            <div class="lk_expert_body_video_item_body_bot">
                                                <div class="content_video_tags">
                                                    <ul>
                                                        <?php foreach($video->getTags() as $tag): ?>
                                                        <li><a href=""><?= $tag ?></a></li>
                                                        <?php endforeach; ?>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-1 text-right align-middle">
                                            <ul>
                                                <li><a href="<?= Url::to(['expert/editvideo', 'id' => $video->id]) ?>"><img src="<?= Url::to('@web/img/icons/icon_video/1.png') ?>" alt=""></a></li>
                                                <li><a href="<?= Url::to(['expert/removevideo', 'id' => $video->id]) ?>"><img src="<?= Url::to('@web/img/icons/icon_video/2.png') ?>" alt=""></a></li>
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
</main>