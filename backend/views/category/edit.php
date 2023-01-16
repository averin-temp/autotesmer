<?php

/* @var $this yii\web\View */
/* @var $category \common\models\Category */
/* @var $categories array */

use yii\web\View;
use yii\helpers\Url;
use backend\assets\DateRangeAsset;
use backend\assets\InputmaskAsset;
use common\models\Role;
use common\models\Group;
use yii\helpers\ArrayHelper;


?>

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= $category->isNewRecord ? "Редактировать категорию" : "Добавить категорию" ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= Url::to(['/dashboard']) ?>"><i class="fa fa-dashboard"></i> Главная</a></li>
            <li><a href="<?= Url::to(['/category/list']) ?>">Категории</a></li>
            <li class="active"><?= $category->isNewRecord ? "Редактировать категорию" : "Добавить категорию" ?></li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">

        <?php if($report = Yii::$app->session->getFlash('edit-category')): ?>
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4>	<i class="icon fa fa-check"></i> <?= $report['message'] ?></h4>
            </div>
        <?php endif; ?>

        <div class="box">
            <form class="form-horizontal" action="<?= Url::to(['/category/save']) ?>" method="post">
                <input type="hidden" name="id" value="<?= $category->id ?>">
                <div class="box-body">

                    <div class="form-group">
                        <label for="family" class="col-sm-2 control-label">Название</label>
                        <div class="col-sm-10">
                            <input name="name" type="text" class="form-control" placeholder="Введите название категории" value="<?= $category->name ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="family" class="col-sm-2 control-label">Родительская категория</label>
                        <div class="col-sm-10">
                            <select name="parent_id">
                                <option value="0">Корневая категория</option>
                                <?php foreach($categories as $parent):
                                    /** @var $parent \common\models\Category */
                                    if($parent->id == $category->id) continue; ?>
                                    <option value="<?= $parent->id ?>"<?= $category->parent_id == $parent->id ? " selected" : "" ?>><?= $parent->name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <?php if($category->hasErrors('name')): ?>
                        <div class="form-error"><?= $category->getFirstError('name') ?></div>
                    <?php endif; ?>
                </div><!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" class="btn btn-info">Сохранить</button>
                </div>

            </form>
        </div><!-- /.box -->

    </section><!-- /.content -->