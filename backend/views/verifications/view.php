<?php

/* @var $this yii\web\View */
/* @var $verification \common\models\PassportVerification */


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
        Проверка документов
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li><a href="<?= Url::to(['users/list']) ?>">Пользователи</a></li>
        <li><a href="<?= Url::to(['verifications/list']) ?>">Проверки</a></li>
        <li class="active">Проверка пасспорта</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <div class="box documents-view">
        <img src="<?php echo Url::to('@frontend-web/uploads/users/' . $verification->user_id . '/' . $verification->passport_photo , true)  ?>" alt="">
    </div><!-- /.box -->

    <div class="box documents-view">
        <img src="<?php echo Url::to('@frontend-web/uploads/users/' . $verification->user_id . '/' . $verification->passport_selfie , true)  ?>" alt="">
    </div><!-- /.box -->

    <div class="box">
        <form class="form-horizontal" action="<?= Url::toRoute('/verifications/confirm') ?>" method="post">
            <input type="hidden" name="id" value="<?= $verification->id ?>">
            <div class="box-footer">
                <button type="submit" class="btn btn-info">Подтвердить</button>
            </div>
        </form>
        <form class="form-horizontal" action="<?= Url::toRoute('/verifications/reject') ?>" method="get">
            <input type="hidden" name="id" value="<?= $verification->id ?>">
            <div class="box-footer">
                <button type="submit" class="btn btn-info">Не подтверждать</button>
            </div>
        </form>
    </div><!-- /.box -->

</section><!-- /.content -->

