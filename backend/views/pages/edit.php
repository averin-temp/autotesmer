<?php

/* @var $this yii\web\View */
/* @var $page \common\models\Page */
/* @var $categories \common\models\Category[] */


use yii\web\View;
use backend\assets\CKEditorAsset;
use yii\helpers\Url;

CKEditorAsset::register($this);


?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Редактор страницы</h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo Url::to('/dashboard') ?>"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li><a href="<?php echo Url::to(['list']) ?>">Страницы</a></li>
        <li class="active">Редактор страницы</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <?php if($report = Yii::$app->session->getFlash('edit-page')): ?>
        <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4>	<i class="icon fa fa-check"></i> <?= $report['message'] ?></h4>
        </div>
    <?php endif; ?>

    <div class="row">

        <form action="<?= Url::to(['pages/save']) ?>" method="post">
            <input type="hidden" name="id" value="<?= $page->id ?>">
        <div class="col-md-12">
            <div class="form-group">
                <label>Название страницы</label>
                <input name="name" type="text" class="form-control" placeholder="введите название страницы" value="<?= $page->name ?>">
                <?php if($page->hasErrors('name')): ?>
                    <div class="form-error field-name"><?= $page->getFirstError('name') ?></div>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label>Синоним страницы</label>
                <input name="url" type="text" class="form-control" value="<?= $page->url ?>">
                <?php if($page->hasErrors('url')): ?>
                    <div class="form-error field-url"><?= $page->getFirstError('url') ?></div>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label>URL</label>
                <select name="category_id">
                    <option value="">Без категории</option>
                    <?php foreach($categories as $category): ?>
                        <option value="<?= $category->id ?>"<?= $category->id == $page->category_id ? " selected" : ""?>><?= $category->name ?></option>
                    <?php endforeach; ?>
                </select>
                <?php if($page->hasErrors('category_id')): ?>
                    <div class="form-error field-category"><?= $page->getFirstError('category_id') ?></div>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <textarea id="page-editor" name="content" rows="10" cols="80"><?= $page->content ?></textarea>
            </div>
            <?php if($page->hasErrors('content')): ?>
                <div class="form-error field-content"><?= $page->getFirstError('content') ?></div>
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
CKEDITOR.replace('page-editor');
JS;
$this->registerJS($script, View::POS_READY);
