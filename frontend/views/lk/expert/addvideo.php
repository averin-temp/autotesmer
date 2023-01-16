<?php

/** @var $this \yii\web\View */
/** @var $video \common\models\Video */

use yii\helpers\Url;



?>


<main class="lk">
    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breads_wrapper dark">
                        <ul>
                            <li><a href="<?= Url::home() ?>">Главная</a></li>
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
                        <div class="reg_exp_page">
                            <form action="<?= Url::to(['expert/editvideo', 'id' => $video->id ]) ?>" method="post">
                            <div class="reg_exp_page_3">
                                <h2>Добавить/редактировать видео</h2>
                            </div>
                            <div class="reg_exp_page_4">

                                <?php if ($code = $video->getHtml()): ?>
                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="video-wrapper-16-9" style="margin-bottom: 10px;">
                                            <?= $code ?>
                                        </div>
                                    </div>

                                </div>
                                <?php endif; ?>


                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="f_group">
                                                <label for="">Название видео</label>
                                                <input name="name" type="text" placeholder="Название видео" required value="<?= $video->name ?>">
                                            </div>
                                            <?php $video->errorField('name') ?>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="f_group">
                                                <label for="">URL</label>
                                                <input name="link" type="text" placeholder="URL" required value="<?= $video->link ?>">
                                            </div>
                                            <?php $video->errorField('link') ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="f_group">
                                                <label for="">Теги</label>
                                                <input name="tags_string" type="text" placeholder="Теги" required value="<?= $video->exportTags() ?>">
                                            </div>
                                            <?php $video->errorField('tags_string') ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="f_group">
                                                <label for="">Описание</label>
                                                <input name="description" type="text" placeholder="Описание" value="<?= $video->description ?>">
                                            </div>
                                            <?php $video->errorField('description') ?>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mp_main_bot">
                                                <button class="button button_orange button_top_img save-video-button">Сохранить</button>
                                            </div>
                                        </div>
                                    </div>

                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</main>