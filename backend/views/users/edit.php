<?php

/* @var $this yii\web\View */
/* @var $user \common\models\User */
/* @var $roles array */
/* @var $groups array */
/* @var $userRole \yii\rbac\Role */
/* @var $userGroups array */
/* @var $socials \common\interfaces\OauthInterface[] */

use yii\web\View;
use yii\helpers\Url;
use backend\assets\DateRangeAsset;
use backend\assets\InputmaskAsset;
use common\models\Role;
use common\models\Group;
use yii\helpers\ArrayHelper;

InputmaskAsset::register($this);
DateRangeAsset::register($this);

?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?= $user->isNewRecord ? "Добавить пользователя" : "Редактировать пользователя" ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li><a href="<?= Url::to(['users/index']) ?>">Пользователи</a></li>
        <li class="active"><?= $user->id ? "Редактировать учетную запись" : "Добавить пользователя" ?></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <?php if($report = Yii::$app->session->getFlash('user-settings')): ?>
        <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4>	<i class="icon fa fa-check"></i> <?= $report['message'] ?></h4>
        </div>
    <?php endif; ?>

    <div class="box">
        <form class="form-horizontal" action="<?= Url::toRoute('/users/save') ?>" method="post">
            <input type="hidden" name="id" value="<?= $user->id ?>">
            <div class="box-body">

                    <div class="form-group">
                        <label for="inputFamily" class="col-sm-2 control-label">Фамилия</label>
                        <div class="col-sm-10">
                            <input name="family" id="inputFamily" type="text" class="form-control" placeholder="Введите фамилию" value="<?= $user->family ?>">
                        </div>
                    </div>
                    <?php if($user->hasErrors('family')): ?>
                    <div class="form-error"><?= $user->getFirstError('family') ?></div>
                    <?php endif; ?>
                    <div class="form-group">
                        <label for="inputFirstname" class="col-sm-2 control-label">Имя</label>
                        <div class="col-sm-10">
                            <input name="firstname" id="inputFirstname" type="text" class="form-control"placeholder="Введите имя" value="<?= $user->firstname ?>">
                        </div>
                    </div>
                    <?php if($user->hasErrors('firstname')): ?>
                    <div class="form-error"><?= $user->getFirstError('firstname') ?></div>
                    <?php endif; ?>
                    <div class="form-group">
                        <label for="inputLastname" class="col-sm-2 control-label">Отчество</label>
                        <div class="col-sm-10">
                            <input name="lastname" type="text" class="form-control" id="inputLastname" placeholder="Введите отчество" value="<?= $user->lastname ?>">
                        </div>
                    </div>
                    <?php if($user->hasErrors('lastname')): ?>
                    <div class="form-error"><?= $user->getFirstError('lastname') ?></div>
                    <?php endif; ?>
                    <div class="form-group">
                        <label for="inputEmail" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                <input name="email" id="inputEmail" type="email" class="form-control" placeholder="Email" value="<?= $user->email ?>">
                            </div>
                        </div>
                    </div>
                    <?php if($user->hasErrors('email')): ?>
                    <div class="form-error"><?= $user->getFirstError('email') ?></div>
                    <?php endif; ?>
                    <div class="form-group">
                        <label for="inputPhone" class="col-sm-2 control-label">Телефон</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <input name="phone" id="inputPhone" type="text" class="form-control" data-inputmask="&quot;mask&quot;: &quot;9 - (999) 999-9999&quot;" data-mask="" value="<?= $user->phone ?>">
                            </div>
                        </div>
                    </div>
                    <?php if($user->hasErrors('phone')): ?>
                        <div class="form-error"><?= $user->getFirstError('phone') ?></div>
                    <?php endif; ?>

                    <div class="form-group">
                        <label for="inputRole" class="col-sm-2 control-label">Роль</label>
                        <div class="col-sm-10">
                            <select name="_role" id="inputRole" class="form-control">
                                <?php foreach($roles as $role): /** @var $role \yii\rbac\Role */
                                    $selected = $role->name == $userRole ? ' selected' : '';
                                    echo "<option value=\"$role->name\"$selected>$role->name</option>";
                                endforeach; ?>
                            </select>
                        </div>
                    </div>



                    <div class="form-group">
                        <label for="inputGroups"  class="col-sm-2 control-label">Группы</label>
                        <div class="col-sm-10">
                            <select name="_groups[]" id="inputGroups" multiple class="form-control">
                                <?php
                                foreach($groups as $group): /** @var $group \common\models\Group */
                                    $selected = in_array($group->id, $userGroups) ? ' selected' : '';
                                    echo "<option value=\"$group->id\"$selected>$group->name</option>";
                                endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputPassword" class="col-sm-2 control-label">Пароль</label>
                        <div class="col-sm-10">
                            <input name="password" type="password" id="inputPassword" class="form-control" value="">
                        </div>
                    </div>
                    <?php if($user->hasErrors('password')): ?>
                    <div class="form-error"><?= $user->getFirstError('password') ?></div>
                    <?php endif; ?>
                    <div class="form-group">
                        <label for="inputConfirm" class="col-sm-2 control-label">Подтверждение</label>
                        <div class="col-sm-10">
                            <input name="confirm" id="inputConfirm" type="password" class="form-control" value="">
                        </div>
                    </div>


                <?php if(count($socials)) : ?>

                        <?php foreach($socials as $network):

                        if($network->name == 'mail.ru') continue;
                        $attribute = \common\models\User::networkAttribute($network->name)?>
                            <div class="form-group">
                                <label for="inputProfile_vk" class="col-sm-2 control-label">Профиль <?= $network->name ?></label>
                                <div class="col-sm-10">
                                <?php if($user->$attribute): ?>
                                    <a href="<?= Url::to(['/oauth/unlink', 'network' => $network->name ]) ?>" class="btn btn-success">Отвязать</a>
                                <?php else: ?>
                                    <a href="<?= Url::to(['/oauth/register', 'network' => $network->name]) ?>" class="btn btn-success">Привязать</a>
                                <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>

                <?php endif; ?>

            </div><!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" class="btn btn-info">Сохранить</button>
            </div>
        </form>
    </div><!-- /.box -->

</section><!-- /.content -->


<?php

// плагины мешают SELENIUM вставлять в поля значения
if(!YII_ENV_TEST)
{

$script = <<< JS
//////////////////////////////////
// view: users/edit //////////////
//////////////////////////////////

$("[data-mask]").inputmask();

//Date range picker
$('#reservation').daterangepicker();
//////////////////////////////////

JS;
$this->registerJS($script, View::POS_READY);
}