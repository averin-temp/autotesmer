<?php
/**
 * @var $this \yii\web\View
 * @var $package \common\models\Package
 * @var $packageVariant \common\models\PackageVariant
 */

use yii\helpers\Url;
use common\models\Service;
use yii\helpers\ArrayHelper;

?>


<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Редактор пакета
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= Url::home() ?>"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li><a href="<?= Url::to(['packages/list']) ?>">Пакеты</a></li>
        <li><a href="<?= Url::to(['packages/edit', 'id' => $package->id ]) ?>"><?= $package->name ?></a></li>
        <li class="active">Редактор варианта пакета</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <?php if($report = Yii::$app->session->getFlash('package-variant-info')): ?>
        <div class="alert <?= $report['status'] == 'success' ? "alert-success" : "alert-danger" ?> alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4>	<i class="icon fa fa-check"></i> <?= $report['message'] ?></h4>
        </div>
    <?php endif; ?>


    <form action="<?= Url::to(['packages/savevariant']) ?>" method="post">
        <input name="id" type="hidden" value="<?= $packageVariant->id ?>">
        <input name="package" type="hidden" value="<?= $packageVariant->base_id ?>">

    <div class="box">
        <div class="box-body">

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Название</label>
                            <input name="name" type="text" class="form-control" value="<?= $packageVariant->name ?>">
                        </div>
                        <?php if($packageVariant->hasErrors('name')): ?>
                        <div class="form-error"><?= $packageVariant->getFirstError('name') ?><p></p></div>
                        <?php endif; ?>
                        <div class="form-group">
                            <label>Стоимость</label>
                            <input name="price" type="number" class="form-control" value="<?= $packageVariant->price ?>">
                        </div>
                        <?php if($packageVariant->hasErrors('price')): ?>
                            <div class="form-error"><?= $packageVariant->getFirstError('price') ?><p></p></div>
                        <?php endif; ?>
                    </div>
                </div>
        </div><!-- /.box-body -->
        <div class="box-footer">
            <button type="submit" class="btn btn-primary pull-right">Сохранить</button>
        </div>

    </div><!-- /.box -->


    <div class="row">
        <div class="col-md-6">

            <?php foreach($packageVariant->getServicesSettingsFormData() as $type => $serviceOptions):
                if($serviceOptions == null){
                    $serviceOptions = new stdClass();
                    $serviceOptions->days = '';
                    $checked = '';
                } else {
                    $checked = " checked";
                }

                $label = Service::labels()[$type];

                ?>
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= $label ?></h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="checkbox">
                            <label>
                                <input name="services_data[<?= $type ?>][enabled]" value="1" type="checkbox"<?= $checked ?>> Активна
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Количество дней</label>
                            <div class="col-sm-10">
                                <input name="services_data[<?= $type ?>][days]" type="number" class="form-control" value="<?= $serviceOptions->days ?>">
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    </div>
    </form>
</section><!-- /.content -->
