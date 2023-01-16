<?php
/** @var $this \yii\web\View */
/** @var $videos \common\models\Video[] */

use yii\helpers\Url;

?>
<main>
    <div class="container">
        <div class="row" style="padding: 50px 0;">
            <div class="col-md-12">
                <div class="breads_wrapper dark">
                    <ul>
                        <li><a href="/">Главная</a></li>
                        <li><span>></span></li>
                        <li><span>Видео</span></li>
                    </ul>
                    <h1>Видео</h1>
                </div>
            </div>
        </div>
        <div class="videos_content">
            <div class="row">
                <?php foreach($videos as $video):
                    /** @var $user \common\models\User*/
                    $user = $video->user;
                ?>
                    <div class="col-md-6">
                        <div class="content_videos_item">
                            <div class="content_video_img" style="background-image: url('<?= $video->getImage() ?>);">
                                <a href="<?= Url::to(['videos/watch', 'id' => $video->id]) ?>"></a></div>
                            <div class="content_video_info clearfix">
                                <div class="content_video_info_left"><a href="<?= $user->profileUrl ?>"><?= $user->firstname . ' ' . $user->family ?></a></div>
                                <div class="content_video_info_right"><?= $video->getAgeLabel() ?></div>
                            </div>
                            <div class="content_video_name"><a href="<?= $video->watchLink() ?>"><?= $video->name ?></a></div>
                            <div class="content_video_tags">
                                <ul>
                                    <?php foreach($video->tags as $tag): ?>
                                        <li><a href=""><?= $tag ?></a></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

    </div>
</main>
