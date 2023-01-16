<?php
/* @var $this yii\web\View */
/* @var $expert \common\models\User */

use yii\web\View;
use backend\assets\CKEditorAsset;
use yii\helpers\Url;
use backend\widgets\UserPanel;

CKEditorAsset::register($this);

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
                        <div class="active tab-pane" id="info">

                            <form action="<?= Url::to(['info', 'id' => $expert->id]) ?>" method="post">


                                <?php if($report = Yii::$app->session->getFlash('expert-info')):
                                    if($report['status'] == "success") :?>
                                        <div class="alert alert-success alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                            <h4>	<i class="icon fa fa-check"></i> <?= $report['message'] ?></h4>
                                        </div>
                                    <?php else: ?>
                                        <div class="alert alert-danger alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                            <h4><i class="icon fa fa-ban"></i> Не сохранено</h4>
                                            <?= $report['message'] ?>
                                        </div>
                                    <?php endif; endif; ?>




                                <div class="box">
                                    <div class="box-header">
                                        <h3 class="box-title">Вступительный текст</h3>
                                    </div><!-- /.box-header -->
                                    <div class="box-body pad">
                                        <textarea id="editor1" name="text" rows="10" cols="80"><?= $expert->text ?></textarea>
                                    </div>
                                </div><!-- /.box -->

                                <div class="box">
                                    <div class="box-header">
                                        <h3 class="box-title">О себе</h3>
                                    </div><!-- /.box-header -->
                                    <div class="box-body pad">
                                        <textarea id="editor2" name="about" rows="10" cols="80"><?= $expert->about ?></textarea>
                                    </div>
                                </div><!-- /.box -->

                                <div class="box">
                                    <div class="box-header">
                                        <h3 class="box-title">Резюме</h3>
                                    </div><!-- /.box-header -->
                                    <div class="box-body pad">
                                        <textarea id="editor3" name="resume" rows="10" cols="80"><?= $expert->resume ?></textarea>
                                    </div>
                                </div><!-- /.box -->

                                <div class="box">
                                    <div class="box-body pad">

                                        <div class="form-group">
                                            <label>Слоган</label>
                                            <textarea name="status" class="form-control" rows="3"><?= $expert->status ?></textarea>
                                        </div>

                                    </div>
                                </div><!-- /.box -->
                                <button type="submit" class="btn btn-primary">Сохранить</button>
                            </form>





                        </div><!-- /.tab-pane -->
                    </div><!-- /.tab-content -->
                </div><!-- /.nav-tabs-custom -->
            </div><!-- /.col -->
        </div><!-- /.row -->

    </section><!-- /.content -->
<?php

$script = <<< JS
// Replace the <textarea id="editor1"> with a CKEditor
// instance, using default configuration.            
CKEDITOR.replace('editor1');
CKEDITOR.replace('editor2');
CKEDITOR.replace('editor3');
JS;

$this->registerJS($script, View::POS_READY);
