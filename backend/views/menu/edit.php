<?php

/* @var $this yii\web\View */
/* @var $menu \common\models\Menu */
/* @var $positions array */
/* @var $formAction string */
/* @var $menuPositions array */

use yii\web\View;
use backend\assets\CKEditorAsset;
use backend\assets\DataTablesAsset;
use yii\helpers\Url;

CKEditorAsset::register($this);
DataTablesAsset::register($this);

?>

    <!-- Content Header (Page header) -->
    <section class="content-header">

        <h1>Редактор меню</h1>

        <ol class="breadcrumb">
            <li><a href="<?= Url::to(['dashboard']) ?>"><i class="fa fa-dashboard"></i> Главная</a></li>
            <li><a href="<?= Url::to(['index']) ?>">Список меню</a></li>
            <li class="active">Редактор меню</li>
        </ol>

    </section>

    <!-- Main content -->
    <section class="content">

        <?php if($report = Yii::$app->session->getFlash('edit-menu')): ?>
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4>	<i class="icon fa fa-check"></i> <?= $report['message'] ?></h4>
            </div>
        <?php endif; ?>

        <form action="<?= $formAction ?>" method="post">

            <input type="hidden" name="id" value="<?= $menu->id ?>">

            <div class="row">

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="menuName">Название меню</label>
                        <input type="text" name="name" value="<?= $menu->name ?>" class="form-control" id="menuName" placeholder="название меню">
                        <?php if($menu->hasErrors('name')) : ?>
                            <div class="form-error field-name" ><?= $menu->getFirstError('name') ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="menuPositions">Позиция</label>
                        <select name="positions[]" id="menuPositions" multiple>
                            <?php foreach($positions as $position => $label): ?>
                                <option value="<?= $position ?>"<?= in_array($position, $menuPositions) ? ' selected' : '' ?>><?= $label ?></option>

                            <?php endforeach; ?>
                        </select>


                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                    </div>
                </div>
            </div>

        </form>

        <?php if($menu->isNewRecord == false): ?>
            <a href="<?= \yii\helpers\Url::to(['items', 'menu_id' => $menu->id]) ?>" class="btn btn-warning">Пункты меню</a>
        <?php endif; ?>

    </section><!-- /.content -->