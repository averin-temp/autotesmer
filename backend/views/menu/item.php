<?php

/* @var $this yii\web\View */
/* @var $item \common\models\MenuItem */

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
            <li><a href="<?= Url::to(['items', 'menu_id' => $item->menu_id ]) ?>">Пункты меню <?= $item->menu->name ?></a></li>
            <li class="active">Редактор пункта меню</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">


        <form action="<?= Url::to(['save_item']) ?>" method="post">

            <input type="hidden" name="id" value="<?= $item->id ?>">
            <input type="hidden" name="menu_id" value="<?= $item->menu_id ?>">

            <div class="row">

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="itemName">Название пункта</label>
                        <input type="text" name="name" value="<?= $item->name ?>" class="form-control" id="itemName" placeholder="Название">
                        <?php if($item->hasErrors('name')) : ?>
                            <div class="form-error field-name" ><?= $item->getFirstError('name') ?></div>
                        <?php endif; ?>
                    </div>


                    <div class="form-group">
                        <label for="itemOrder">Порядок</label>
                        <input type="number" name="order" value="<?= $item->order ?>" class="form-control" id="itemOrder" placeholder="Порядок">
                        <?php if($item->hasErrors('order')) : ?>
                            <div class="form-error field-name" ><?= $item->getFirstError('order') ?></div>
                        <?php endif; ?>
                    </div>


                    <div class="form-group">
                        <label for="itemUrl">URL ссылки</label>
                        <input type="text" name="url" value="<?= $item->url ?>" class="form-control" id="itemUrl" placeholder="http:/example.net">
                        <?php if($item->hasErrors('url')) : ?>
                            <div class="form-error field-name" ><?= $item->getFirstError('url') ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                    </div>
                </div>
            </div>

        </form>

    </section><!-- /.content -->