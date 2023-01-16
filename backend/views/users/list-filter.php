<?php
/** @var $this \yii\web\View  */
/** @var $model \app\models\UsersSearch */

use yii\helpers\Url;
use common\models\City;
use common\models\Group;
use \common\models\Role;

?>


<div class="box">
    <form action="<?= Url::to(['users/index']) ?>" method="get">
    <div class="box-body">

        <div class="row">
            <div class="col-md-6">
                <!-- Date range -->
                <div class="form-group">
                    <label for="filter-registration">Регистрация</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input name="registration" value="<?= $model->registration ?>" type="text" class="form-control pull-right" id="filter-registration" autocomplete="off">
                    </div><!-- /.input group -->
                </div><!-- /.form group -->

                <div class="form-group">
                    <label>Группы</label>
                    <select name="groups[]" multiple class="form-control">
                        <?php foreach($groups as $group) {
                            /** @var $group \common\models\Group */
                            $selected = in_array($group->id,$model->groups) ? "selected" : '';
                            echo "<option value='$group->id' $selected>$group->name</option>";
                        } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Роль</label>
                    <select multiple name="roles[]" class="form-control">
                        <?php foreach($roles as $role) {
                            /** @var $role \yii\rbac\Role  */
                            $selected = in_array($role->name,$model->roles) ? "selected" : '';
                            echo "<option value='$role->name' $selected>$role->name</option>";
                        } ?>
                    </select>
                </div>

            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="filter-city">Город</label>
                    <select name="city" id="filter-city" class="form-control">
                        <option value="">Любой</option>
                        <?php foreach($cities as $city) {
                            /** @var $city \common\models\City */
                            $selected = $model->city == $city->id ? "selected" : "";
                            echo "<option value='$city->id' $selected >$city->name</option>";
                        } ?>
                    </select>
                </div>

                <!-- phone mask -->
                <div class="form-group">
                    <label for="filter-phone">Телефон:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-phone"></i>
                        </div>
                        <input name="phone" id="filter-phone" type="text" class="form-control" value="<?= $model->phone ?>" data-inputmask='"mask": "(999) 999-9999"' data-mask>
                    </div><!-- /.input group -->
                </div><!-- /.form group -->


                <div class="form-group">
                    <label for="filter-family">Фамилия</label>
                    <input name="family" type="text" class="form-control" id="filter-name" placeholder="Фамилия" value="<?= $model->family ?>">
                </div>

                <div class="form-group">
                    <label for="filter-firstname">Имя</label>
                    <input name="firstname" type="text" class="form-control" id="filter-name" placeholder="Имя" value="<?= $model->firstname ?>">
                </div>

                <div class="form-group">
                    <label for="filter-lastname">Отчество</label>
                    <input name="lastname" type="text" class="form-control" id="filter-name" placeholder="Отчество" value="<?= $model->lastname ?>">
                </div>

            </div>
        </div>

    </div><!-- /.box-body -->

    <div class="box-footer">
        <!--button type="reset" class="btn btn-default">Сбросить</button-->
        <button type="submit" class="btn btn-info pull-right">Применить</button>
    </div>

    </form>
</div><!-- /.box -->
