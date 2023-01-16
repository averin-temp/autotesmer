<?php
/* @var $this yii\web\View */
/* @var $expert \common\models\User */
/* @var $videos array */

use yii\helpers\Url;
use backend\widgets\UserPanel;
use backend\assets\InputmaskAsset;

InputmaskAsset::register($this);
?>

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Страница пользователя (Эксперт)</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Главная</a></li>
            <li><a href="<?= Url::to(['users/index']) ?>">Пользователи</a></li>
            <li class="active">Страница пользователя (Эксперт)</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-md-3">

                <?php echo UserPanel::widget(['user' => $expert]); ?>


            </div><!-- /.col -->
            <div class="col-md-9">
                <div class="nav-tabs-custom">

                    <?= $this->render('expert-menu', ['user' => $expert]) ?>

                    <div class="tab-content">
                        <div class="active tab-pane" id="video">


                            <?php foreach($videos as $video): ?>

                                <div class="post">
                                    <div class="row margin-bottom">
                                        <div class="col-sm-6">
                                            <div class="embed-responsive embed-responsive-16by9">
                                                <?= $video->getHtml() ?>
                                            </div>
                                        </div><!-- /.col -->
                                        <div class="col-sm-6">
                                            <div>
                                                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-edit-video">Редактировать</button>
                                                <button type="button" class="btn btn-info pull-right">Удалить</button>
                                            </div>
                                            <div>
                                                <h3><?= $video->name ?></h3>
                                                <p><?= $video->description ?></p>
                                            </div>
                                            <div>
                                                <h3>Тэги</h3>
                                                <p>
                                                    <?php foreach($video->tags as $tag): ?>
                                                    <span class="label label-danger"><?= $tag ?></span>
                                                    <?php endforeach; ?>
                                                </p>
                                            </div>
                                        </div><!-- /.col -->
                                    </div><!-- /.row -->
                                </div>

                            <?php endforeach; ?>

                            <nav>
                                <ul class="pagination">
                                    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                </ul>
                            </nav>

                        </div><!-- /.tab-pane -->
                    </div><!-- /.tab-content -->
                </div><!-- /.nav-tabs-custom -->
            </div><!-- /.col -->
        </div><!-- /.row -->

    </section><!-- /.content -->