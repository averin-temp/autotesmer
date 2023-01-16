<?php
/** @var $this \yii\web\View */
/** @var $video \common\models\Video */

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
                        <li><span>></span></li>
                        <li><span><?= $video->name ?></span></li>
                    </ul>
                    <h1><?= $video->name ?></h1>
                </div>
            </div>
        </div>
        <div class="videos_content">
            <div class="row">

                <div class="col-md-12">
                    <div class="video-wrapper-16-9" style="margin-bottom: 10px;">
                        <?= $video->getHtml() ?>
                    </div>
                </div>

            </div>
        </div>

    </div>
</main>
