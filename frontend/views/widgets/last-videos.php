<?php

/** @var $videos array */
use yii\helpers\Url;
?>

<div class="content_videos">
    <div class="content_videos_header content_header">
        Последние видео <a href="<?= Url::to(['/videos']) ?>" class="content_header_link">Перейти в раздел</a>
    </div>
    <div class="row">
        <?php if(empty($videos)): ?>
        <div class="col-md-12">
            Нет видеозаписей
        </div>
        <?php endif; ?>
        <?php foreach($videos as $video):
            /** @var $video \common\models\Video */
            /** @var $user \common\models\User*/
            $user = $video->user;
            ?>
        <div class="col-md-4">
            <div class="content_videos_item">
                <div class="content_video_img" style="background-image: url('<?= $video->getImage() ?>');">
                    <a href="<?= $video->watchLink() ?>"></a></div>
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
