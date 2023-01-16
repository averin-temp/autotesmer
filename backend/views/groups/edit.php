<?php

/* @var $this yii\web\View */
/* @var $group \common\models\Group */

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
            Добавить группу
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Главная</a></li>
            <li><a href="#">Группы</a></li>
            <li class="active"><?= $group->id ? "Редактировать группу" : "Добавить группу" ?></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <?php if($report = Yii::$app->session->getFlash('saving-report')): ?>
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4>	<i class="icon fa fa-check"></i> <?= $report['message'] ?></h4>
            </div>
        <?php endif; ?>

        <div class="box">
            <form class="form-horizontal" action="<?= Url::toRoute('/groups/save') ?>" method="post">
                <input type="hidden" name="id" value="<?= $group->id ?>">
                <div class="box-body">

                    <?php if($group->hasErrors('name')): ?>
                        <div class="form-error"><?= $group->getFirstError('name') ?></div>
                    <?php endif; ?>
                    <div class="form-group">
                        <label for="family" class="col-sm-2 control-label">Название</label>
                        <div class="col-sm-10">
                            <input name="name" type="text" class="form-control" placeholder="Название группы" value="<?= $group->name ?>">
                        </div>
                    </div>

                </div><!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" class="btn btn-info">Сохранить</button>
                </div>
            </form>
        </div><!-- /.box -->

    </section><!-- /.content -->