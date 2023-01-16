<?php

/* @var $this yii\web\View */
/* @var $model \app\models\AccessSettingsModel */
/* @var $report array */
/* @var $dependencies string */

use backend\assets\ICheckAsset;
use yii\helpers\Url;

ICheckAsset::register($this);

?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Редактор роли
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li><a href="<?= Url::to(['users/index']) ?>">Пользователи</a></li>
        <li class="active">Редактор роли</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <div class="row">
        <div class="col-md-12">

            <?php if($report): ?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4>	<i class="icon fa fa-check"></i> <?= $report['message'] ?></h4>
                </div>
            <?php endif; ?>

            <form class="access-settings-form" action="<?= Url::to(['save']) ?>" method="post">

                <input name="id" type="hidden" value="<?= isset($model->role) ? $model->role->name : '' ?>">

                <div class="form-group">
                    <label>Название роли</label>
                    <input name="name" type="text" class="form-control" value="<?= $model->name ?>">

                    <?php if($model->hasErrors('name')) : ?>
                        <div><?= $model->getFirstError('name') ?></div>
                    <?php endif; ?>

                </div>

                <div class="form-group">
                    <label>Описание роли</label>
                    <input name="description" type="text" class="form-control" value="<?= $model->description ?>">

                    <?php if($model->hasErrors('description')) : ?>
                    <div><?= $model->getFirstError('description') ?></div>
                    <?php endif; ?>

                </div>

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Допуски</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tbody>
                            <tr>
                                <th></th>
                                <th style="width: 70px">Просматривать</th>
                                <th style="width: 70px">Редактировать</th>
                            </tr>
                            <tr>
                                <td>Доступ к административному разделу</td>
                                <td colspan="2">
                                    <!--input name="accessBackend" type="hidden" value="0"-->
                                    <input name="accessBackend" class="flat-red" type="checkbox"<?= $model->accessBackend ? ' checked' : '' ?>>
                                </td>
                            </tr>
                            <tr>
                                <td>Пользователи</td>
                                <td>
                                    <!--input name="accessUsers" type="hidden" value="0"-->
                                    <input name="accessUsers" class="flat-red" type="checkbox"<?= $model->accessUsers ? ' checked' : '' ?>>
                                </td>
                                <td>
                                    <!--input name="editUsers" type="hidden" value="0"-->
                                    <input name="editUsers" class="flat-red" type="checkbox"<?= $model->editUsers ? ' checked' : '' ?>>
                                </td>
                            </tr>
                            <tr>
                                <td>роли</td>
                                <td>
                                    <!--input name="accessRoles" type="hidden" value="0"-->
                                    <input name="accessRoles" class="flat-red" type="checkbox"<?= $model->accessRoles ? ' checked' : '' ?>>
                                </td>
                                <td>
                                    <!--input name="editRoles" type="hidden" value="0"-->
                                    <input name="editRoles" class="flat-red" type="checkbox"<?= $model->editRoles ? ' checked' : '' ?>>
                                </td>
                            </tr>
                            <tr>
                                <td>баннеры</td>
                                <td>
                                    <!--input name="accessBanners" type="hidden" value="0"-->
                                    <input name="accessBanners" class="flat-red" type="checkbox"<?= $model->accessBanners ? ' checked' : '' ?>>
                                </td>
                                <td>
                                    <!--input name="editBanners" type="hidden" value="0"-->
                                    <input name="editBanners" class="flat-red" type="checkbox"<?= $model->editBanners ? ' checked' : '' ?>>
                                </td>
                            </tr>
                            <tr>
                                <td>промокоды</td>
                                <td>
                                    <!--input name="accessPromocodes" type="hidden" value="0"-->
                                    <input name="accessPromocodes" class="flat-red" type="checkbox"<?= $model->accessPromocodes ? ' checked' : '' ?>>
                                </td>
                                <td>
                                    <!--input name="editPromocodes" type="hidden" value="0"-->
                                    <input name="editPromocodes" class="flat-red" type="checkbox"<?= $model->editPromocodes ? ' checked' : '' ?>>
                                </td>
                            </tr>
                            <tr>
                                <td>рассылки</td>
                                <td>
                                    <!--input name="accessMailing" type="hidden" value="0"-->
                                    <input name="accessMailing" class="flat-red" type="checkbox"<?= $model->accessMailing ? ' checked' : '' ?>>
                                </td>
                                <td>
                                    <!--input name="editMailing" type="hidden" value="0"-->
                                    <input name="editMailing" class="flat-red" type="checkbox"<?= $model->editMailing ? ' checked' : '' ?>>
                                </td>
                            </tr>
                            <tr>
                                <td>пакеты</td>
                                <td>
                                    <!--input name="accessPackages" type="hidden" value="0"-->
                                    <input name="accessPackages" class="flat-red" type="checkbox"<?= $model->accessPackages ? ' checked' : '' ?>>
                                </td>
                                <td>
                                    <!--input name="editPackages" type="hidden" value="0"-->
                                    <input name="editPackages" class="flat-red" type="checkbox"<?= $model->editPackages ? ' checked' : '' ?>>
                                </td>
                            </tr>
                            <tr>
                                <td>Арбитраж</td>
                                <td>
                                    <!--input name="accessArbitrage" type="hidden" value="0"-->
                                    <input name="accessArbitrage" class="flat-red" type="checkbox"<?= $model->accessArbitrage ? ' checked' : '' ?>>
                                </td>
                                <td>
                                    <!--input name="editArbitrage" type="hidden" value="0"-->
                                    <input name="editArbitrage" class="flat-red" type="checkbox"<?= $model->editArbitrage ? ' checked' : '' ?>>
                                </td>
                            </tr>

                            <tr>
                                <td>Группы</td>
                                <td>
                                    <!--input name="accessGroups" type="hidden" value="0"-->
                                    <input name="accessGroups" class="flat-red" type="checkbox"<?= $model->accessGroups ? ' checked' : '' ?>>
                                </td>
                                <td>
                                    <!--input name="editGroups" type="hidden" value="0"-->
                                    <input name="editGroups" class="flat-red" type="checkbox"<?= $model->editGroups ? ' checked' : '' ?>>
                                </td>
                            </tr>


                            </tbody>
                        </table>
                    </div><!-- /.box-body -->

                </div>


                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>

            </form>
        </div>
    </div>

</section><!-- /.content -->
<?php

$script = <<< JS
//Flat red color scheme for iCheck
$('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
    checkboxClass: 'icheckbox_flat-green',
    radioClass: 'iradio_flat-green'
});

$('input[type="checkbox"].flat-red, input[type="radio"].flat-red').on('ifChecked', function(){
    let name = $(this).attr('name');
    checkFields(name);
});

$('input[type="checkbox"].flat-red, input[type="radio"].flat-red').on('ifUnchecked', function(){
    let name = $(this).attr('name');
    uncheckFields(name);
});

var access = JSON.parse('$dependencies');
var indexes = {};

function buildTree(data, parent){
    
    let list = {};
    
    for(let branch in data){
        let node = {
            name: branch,
            parent: parent,
        };
        node.children = buildTree(data[branch], node);
        indexes[branch] = node;
        list[branch] = node;
    }
    
    return list;
}

function checkFields(name){
    
    let field = indexes[name];
    
    while(field.parent instanceof Object){
        field = field.parent;
        $('.access-settings-form [name=' + field.name + ']').iCheck('check');
    }
}

function uncheckFields(name){
    
    let field = indexes[name];
    
    if(!$.isEmptyObject(field.children)){
        for(let fieldName in field.children){
            uncheckFields(fieldName);
        }
    }
    
    $('.access-settings-form [name=' + field.name + ']').iCheck('uncheck');
}

buildTree(access, null);
JS;
$this->registerJs($script, \yii\web\View::POS_READY);
