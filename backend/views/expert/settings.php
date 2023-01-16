<?php
/* @var $this yii\web\View */
/* @var $expert \common\models\User */
/* @var $roles \yii\rbac\Role[] */
/* @var $socials \common\interfaces\OauthInterface[] */

use yii\web\View;
use yii\helpers\Url;
use common\models\Group;
use yii\helpers\ArrayHelper;
use backend\widgets\UserPanel;
use backend\assets\InputmaskAsset;

InputmaskAsset::register($this);
$groups = Group::find()->all();
$userGroups = $expert->groups;
$userGroupsIDs = ArrayHelper::getColumn($userGroups, 'id');

?>

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Страница пользователя (Эксперт)</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Главная</a></li>
            <li><a href="<?= Url::to(['users/index']) ?>">Пользователи</a></li>
            <li class="active">Страница пользователя (Эксперт)</li>
        </ol>
    </section>


    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-md-3">

                <?php echo UserPanel::widget(['user' => $expert]); ?>


            </div><!-- /.col -->
            <div class="col-md-9">
                <div class="nav-tabs-custom">

                    <?= $this->render('expert-menu', ['user' => $expert]) ?>

                    <div class="tab-content">
                        <div class="active tab-pane" id="settings">

                            <?php if($report = Yii::$app->session->getFlash('expert-settings')):
                                if($report['status'] == "success") :?>
                                    <div class="alert alert-success alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <h4>	<i class="icon fa fa-check"></i> <?= $report['message'] ?></h4>
                                    </div>
                                <?php else: ?>
                                    <div class="alert alert-danger alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <h4><i class="icon fa fa-ban"></i> Не сохранено</h4>
                                        <?= $report['message'] ?>
                                    </div>
                                <?php endif; endif; ?>

                            <form action="<?= Url::to(['expert/settings', 'id' => $expert->id]) ?>" class="form-horizontal" method="post">


                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">Фамилия</label>
                                    <div class="col-sm-10">
                                        <input name="family" type="text" class="form-control" value="<?= $expert->family ?>">
                                    </div>
                                </div>

                                <?php if($expert->hasErrors('family')): ?>
                                    <div class="form-error"><?= $expert->getFirstError('family') ?></div>
                                <?php endif; ?>

                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">Имя</label>
                                    <div class="col-sm-10">
                                        <input name="firstname" type="text" class="form-control" value="<?= $expert->firstname ?>">
                                    </div>
                                </div>
                                <?php if($expert->hasErrors('firstname')): ?>
                                    <div class="form-error"><?= $expert->getFirstError('firstname') ?></div>
                                <?php endif; ?>

                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">Отчество</label>
                                    <div class="col-sm-10">
                                        <input name="lastname" type="text" class="form-control" value="<?= $expert->lastname ?>">
                                    </div>
                                </div>
                                <?php if($expert->hasErrors('lastname')): ?>
                                    <div class="form-error"><?= $expert->getFirstError('lastname') ?></div>
                                <?php endif; ?>


                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">Пароль</label>
                                    <div class="col-sm-10">
                                        <input name="password" type="password" class="form-control" value="">
                                    </div>
                                </div>

                                <?php if($expert->hasErrors('password')): ?>
                                    <div class="form-error"><?= $expert->getFirstError('password') ?></div>
                                <?php endif; ?>

                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">Подтверждение</label>
                                    <div class="col-sm-10">
                                        <input name="confirm" type="password" class="form-control" value="">
                                    </div>
                                </div>

                                <?php if($expert->hasErrors('confirm')): ?>
                                    <div class="form-error"><?= $expert->getFirstError('confirm') ?></div>
                                <?php endif; ?>

                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">Email</label>
                                    <div class="col-sm-10">
                                        <input name="email" type="text" class="form-control" value="<?= $expert->email ?>">
                                    </div>
                                </div>

                                <?php if($expert->hasErrors('email')): ?>
                                    <div class="form-error"><?= $expert->getFirstError('email') ?></div>
                                <?php endif; ?>

                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">Телефон</label>
                                    <div class="col-sm-10">
                                        <input name="phone" type="text" data-inputmask="&quot;mask&quot;: &quot;9 - (999) 999-9999&quot;" data-mask="" class="form-control" value="<?= $expert->phone ?>">
                                    </div>
                                </div>

                                <?php if($expert->hasErrors('phone')): ?>
                                    <div class="form-error"><?= $expert->getFirstError('phone') ?></div>
                                <?php endif; ?>

                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">Дата рождения</label>
                                    <div class="col-sm-10">
                                        <input name="birthday" type="text" class="form-control" value="<?= $expert->getBirthday()->format('j.n.Y') ?>">
                                    </div>
                                </div>

                                <?php if($expert->hasErrors('birthday')): ?>
                                    <div class="form-error"><?= $expert->getFirstError('birthday') ?></div>
                                <?php endif; ?>

                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">Профиль Facebook</label>
                                    <div class="col-sm-10">
                                        <input name="profile_facebook" type="text" class="form-control" value="<?= $expert->profile_facebook ?>">
                                    </div>
                                </div>

                                <?php if($expert->hasErrors('profile_facebook')): ?>
                                    <div class="form-error"><?= $expert->getFirstError('profile_facebook') ?></div>
                                <?php endif; ?>

                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">Профиль ВК</label>
                                    <div class="col-sm-10">
                                        <input name="profile_vk" type="text" class="form-control" value="<?= $expert->profile_vk ?>">
                                    </div>
                                </div>

                                <?php if($expert->hasErrors('profile_vk')): ?>
                                    <div class="form-error"><?= $expert->getFirstError('profile_vk') ?></div>
                                <?php endif; ?>

                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <div class="checkbox">
                                            <label>
                                                <input name="has_ip" type="hidden" value="0">
                                                <input name="has_ip" type="checkbox" value="1"<?= $expert->has_ip ? " checked" : "" ?>> Имеет ИП
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <?php if($expert->hasErrors('has_ip')): ?>
                                    <div class="form-error"><?= $expert->getFirstError('has_ip') ?></div>
                                <?php endif; ?>

                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <div class="checkbox">
                                            <label>
                                                <input name="has_ul" type="hidden" value="0">
                                                <input name="has_ul" type="checkbox" value="1"<?= $expert->has_ul ? " checked" : "" ?>> Имеет Юр. лицо
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <?php if($expert->hasErrors('has_ul')): ?>
                                    <div class="form-error"><?= $expert->getFirstError('has_ul') ?></div>
                                <?php endif; ?>


                                <div class="form-group">
                                    <label for="inputGroups"  class="col-sm-2 control-label">Группы</label>
                                    <div class="col-sm-10">
                                        <select name="_groups[]" id="inputGroups" multiple class="form-control">
                                            <?php
                                            foreach($groups as $group): /** @var $group \common\models\Group */
                                                $selected = in_array($group->id, $userGroupsIDs) ? ' selected' : '';
                                                echo "<option value=\"$group->id\"$selected>$group->name</option>";
                                            endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputRole"  class="col-sm-2 control-label">Роль</label>
                                    <div class="col-sm-10">
                                        <select name="_role" id="inputRole" class="form-control">
                                            <?php foreach($roles as $role): /** @var $role \yii\rbac\Role */
                                                $selected = $role->name == $expert->role->name ? ' selected' : '';
                                                echo "<option value=\"$role->name\"$selected>$role->name</option>";
                                            endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-info">Сохранить</button>
                                    </div>
                                </div>


                            </form>
                        </div><!-- /.tab-pane -->
                    </div><!-- /.tab-content -->
                </div><!-- /.nav-tabs-custom -->
            </div><!-- /.col -->
        </div><!-- /.row -->

    </section><!-- /.content -->

<?php

$script = <<< JS
$("[data-mask]").inputmask();
JS;
$this->registerJs($script, View::POS_READY, 'inputmask-init');