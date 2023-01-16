<?php

/* @var $this yii\web\View */
/* @var $template \common\models\MailTemplate */

use yii\web\View;
use backend\assets\CKEditorAsset;
use yii\helpers\Url;

CKEditorAsset::register($this);


?>

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Редактор шаблона</h1>
        <ol class="breadcrumb">
            <li><a href="<?= Url::home() ?>"><i class="fa fa-dashboard"></i> Главная</a></li>
            <li><a href="<?= Url::to(['list']) ?>">Шаблоны</a></li>
            <li class="active">Редактор шаблона</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <?php if($report = Yii::$app->session->getFlash('edit-template')): ?>
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4>	<i class="icon fa fa-check"></i> <?= $report['message'] ?></h4>
            </div>
        <?php endif; ?>

        <div class="row">

            <form action="<?= Url::to(['mail_templates/save']) ?>" method="post">
                <input type="hidden" name="id" value="<?= $template->id ?>">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Название шаблона</label>
                        <input name="name" type="text" class="form-control" placeholder="введите название шаблона" value="<?= $template->name ?>">
                        <?php if($template->hasErrors('name')): ?>
                            <div class="form-error"><?= $template->getFirstError('name') ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="alert alert-info">
                        В тексте "[username]" "[promocode]" будут заменены именем пользователя и промокодом.
                    </div>


                    <div class="form-group">
                        <textarea id="template-editor" name="content" rows="10" cols="80"><?= $template->content ?></textarea>
                    </div>
                    <?php if($template->hasErrors('content')): ?>
                        <div class="form-error"><?= $template->getFirstError('content') ?></div>
                    <?php endif; ?>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                    </div>
                </div>
            </form>
        </div>




    </section><!-- /.content -->

<?php

$script = <<< JS
// Replace the <textarea id="editor1"> with a CKEditor
// instance, using default configuration.
CKEDITOR.replace('template-editor');
JS;
$this->registerJS($script, View::POS_READY);
