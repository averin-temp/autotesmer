<?php

/* @var $this yii\web\View */
/* @var $mailing \common\models\Mailing */
/* @var $templates array */
/* @var $promocodesSets array */
/* @var $groups array */

use yii\web\View;
use yii\helpers\Url;
use backend\assets\DateRangeAsset;
use yii\helpers\ArrayHelper;

DateRangeAsset::register($this);

?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Создать рассылку
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= Url::home() ?>"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li><a href="<?= Url::to(['list']) ?>">Рассылки</a></li>
        <li class="active">Создать рассылку</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">


    <?php if($report = Yii::$app->session->getFlash('edit-mailing')): ?>
        <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4>	<i class="icon fa fa-check"></i> <?= $report['message'] ?></h4>
        </div>
    <?php endif; ?>


    <form action="<?= Url::to(['mailing/save']) ?>" method="post">
        <input type="hidden" name="id" value="<?= $mailing->id?>">

    <div class="row">

        <div class="col-md-6">
            <div class="box">
                <div class="box-body">

                    <div class="form-group">
                        <label>Название рассылки</label>
                        <input name="name" type="text" class="form-control" value="<?= $mailing->name ?>">
                        <?php if($mailing->hasErrors('name')): ?>
                            <div class="form-error field-name">
                                <?= $mailing->getFirstError('name') ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label>Шаблон письма</label>
                        <select name="template_id" class="form-control">
                            <option value="0">Не назначен шаблон</option>
                            <?php foreach($templates as $template): /** @var $template \common\models\MailTemplate */ ?>
                            <option value="<?= $template->id ?>"<?= $template->id == $mailing->template_id ? " selected" : '' ?>><?= $template->name ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?php if($mailing->hasErrors('template_id')): ?>
                        <div class="form-error field-template">
                            <?= $mailing->getFirstError('template_id') ?>
                        </div>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label>Группы пользователей</label>
                        <select name="groups[]" multiple class="form-control">
                            <?php $mailingGroups = ArrayHelper::getColumn($mailing->groups, 'id');
                            foreach($groups as $group): /** @var $group \common\models\Group */ ?>
                                <option value="<?= $group->id ?>"<?= in_array($group->id, $mailingGroups) ? " selected" : '' ?>><?= $group->name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Роли пользователей</label>
                        <select name="roles[]" multiple class="form-control">
                            <?php $mailingRoles = $mailing->roles;
                            foreach($roles as $role): /** @var $role \yii\rbac\Role */ ?>
                                <option value="<?= $role->name ?>"<?= in_array($role->name, $mailingRoles) ? " selected" : '' ?>><?= $role->name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Набор промокодов</label>
                        <select name="promocodes_set_id" class="form-control">
                            <option value="">Нет промокода</option>
                            <?php foreach($promocodesSets as $promocodeSet): /** @var $promocode \common\models\PromocodesSet */ ?>
                                <option value="<?= $promocodeSet->id ?>"<?= $promocodeSet->id == $mailing->promocodes_set_id ? " selected" : '' ?>><?= $promocodeSet->name ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?php if($mailing->hasErrors('promocodes_set_id')): ?>
                            <div class="form-error field-promocodes-set">
                                <?= $mailing->getFirstError('promocodes_set_id') ?>
                            </div>
                        <?php endif; ?>
                    </div>

                </div><!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" class="btn btn-info">Сохранить</button>
                    <a href="<?= Url::to(['delete', 'id' => $mailing->id]) ?>" class="btn btn-danger">Удалить</a>
                </div>

            </div><!-- /.box -->
        </div>
        <div class="col-md-6">

            <?php if(!$mailing->isNewRecord): ?>
            <div class="box">
                <div class="box-body">

                    <div class="form-group">
                        <label>Дата рассылки</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-clock-o"></i>
                            </div>
                            <input name="shedule" type="text" class="form-control pull-right" id="reservationtime" value="<?= date_create($mailing->shedule)->format('d.m.Y H:i') ?>" autocomplete="off">
                        </div><!-- /.input group -->
                    </div>

                    <?php if($mailing->hasErrors('shedule')): ?>
                        <div class="form-error field-shedule">
                            <?= $mailing->getFirstError('shedule') ?>
                        </div>
                    <?php endif; ?>

                </div><!-- /.box-body -->

                <?php if(!$mailing->executed): ?>
                <div class="box-footer">
                    <button type="button" id="execute_now" data-id="<?= $mailing->id ?>" class="btn btn-info">Выполнить сейчас</button>
                </div>
                <?php endif; ?>

            </div><!-- /.box -->

            <?php endif; ?>
        </div>
    </div>


    </form>
</section><!-- /.content -->
<?php

$execute_url= Url::to(['mailing/execute']);
$script = <<< JS
//Date range picker with time picker
$('#reservationtime').daterangepicker({
    singleDatePicker: true,
    showDropdowns: true,
    timePicker: true,
    format: 'DD.MM.YYYY hh:mm'
});
$('#execute_now').click(function(){
    let button = $(this);
    button.prop('disabled', true);
    $.post("$execute_url", {id: $mailing->id}, function(result){
        if(result.ok){
            button.remove();
        }
    }, 'json');
});
JS;
$this->registerJS($script, View::POS_READY);
