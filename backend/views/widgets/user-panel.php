<?php
/** @var $user \common\models\User */
/** @var $this \yii\web\View */

?>

<!-- Profile Image -->
<div class="box box-primary">
    <div class="box-body box-profile">
        <img class="profile-user-img img-responsive img-circle" src="<?= $user->avatar ?>" alt="User profile picture">
        <h3 class="profile-username text-center"><?= $user->firstname . ' ' . $user->family ?></h3>
        <p class="text-muted text-center"><?= $user->role->name ?></p>

        <ul class="list-group list-group-unbordered">
            <li class="list-group-item">
                <b>Заказов</b> <a class="pull-right"><?= $user->ordersTotalCount ?></a>
            </li>
            <?php if($user->can('Эксперт')): ?>
                <li class="list-group-item">
                    <b>Заявки</b> <a class="pull-right"><?= $user->getRequests()->count() ?></a>
                </li>
            <?php endif; ?>



            <li class="list-group-item">
                <b>Закрытых</b> <a class="pull-right"><?= $user->completedOrdersCount ?></a>
            </li>
            <li class="list-group-item">
                <b>Рейтинг</b> <a class="pull-right"><?= $user->rating ?></a>
            </li>
        </ul>

        <!--a href="#" class="btn btn-primary btn-block"><b>Написать сообщение</b></a-->
    </div><!-- /.box-body -->
</div><!-- /.box -->
