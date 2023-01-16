<?php

/* @var $this yii\web\View */
/* @var $searchModel \app\models\UsersSearch */
/* @var $users array */
/* @var $roles array */
/* @var $cities array */
/* @var $groups array */

$this->title = 'Список пользователей';

use yii\helpers\Url;
use backend\assets\DataTablesAsset;
use backend\assets\InputmaskAsset;
use backend\assets\DateRangeAsset;
use backend\assets\DialogAsset;

DataTablesAsset::register($this);
DateRangeAsset::register($this);
InputmaskAsset::register($this);
DialogAsset::register($this);

?>

    <?= $this->render('//modals/dialog') ?>

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Пользователи
            <small>список всех пользователей</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo Url::to('/dashboard') ?>"><i class="fa fa-dashboard"></i> Главная</a></li>
            <li class="active">Список пользователей</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">


        <?php if($report = Yii::$app->session->getFlash('operation-report')): ?>
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4>	<i class="icon fa fa-check"></i> <?= $report['message'] ?></h4>
            </div>
        <?php endif; ?>

        <?= $this->render('list-filter', [
                'model' => $searchModel,
                'cities' => $cities,
                'groups' => $groups,
                'roles' => $roles,
        ]) ?>

        <div class="row">
            <div class="col-xs-12">

                <div class="box">
                    <div class="box-body">
                        <table id="users-table" class="table table-bordered table-striped data-table">
                            <thead>
                            <tr>
                                <th>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" id="check_all" style="cursor: pointer">
                                        </label>
                                    </div>
                                </th>
                                <th>Имя</th>
                                <th>E-mail</th>
                                <th>Роль</th>
                                <th>Дата регистрации</th>
                                <th>Действия</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php foreach($users as $user): /** @var $user \common\models\User */?>
                                <tr>
                                    <td>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" style="cursor: pointer" value="<?= $user->id ?>">
                                            </label>
                                        </div>
                                    </td>
                                    <td><?= $user->firstname . ' ' . $user->lastname . ' ' . $user->family ?></td>
                                    <td><?= $user->email ?></td>
                                    <td><?= $user->role->name ?></td>
                                    <td><?= $user->created_at ?></td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a href="<?= $user->getEditUrl() ?>" class="btn btn-success"><i class="fa fa-edit"></i></a>
                                            <a href="<?= Url::to(['/users/delete', 'id' => $user->id]) ?>" class="btn btn-danger delete-row"><i class="fa fa-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                            </tbody>
                            <tfoot>
                            <tr>
                                <th>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" style="cursor: pointer">
                                        </label>
                                    </div>
                                </th>
                                <th>Имя</th>
                                <th>E-mail</th>
                                <th>Роль</th>
                                <th>Дата регистрации</th>
                                <th>Действия</th>
                            </tr>
                            </tfoot>
                        </table>
                        <!-- Групповые действия -->
                        <div id="actions" class="btn-group">
                            <button type="button" class="btn btn-default">Выполнить с выделенными</button>
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li><a data-action="delete" href="#">Удалить</a></li>
                            </ul>
                        </div>

                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </section><!-- /.content -->

    <!-- Форма отправки групповых действий -->
    <form id="action-form" action="<?= Url::to(['batch']) ?>" method="post">
        <input type="hidden" name="action">
        <input type="hidden" name="ids">
    </form>



<?php
// плагин мешает SELENIUM, отключаем для тестов
if(YII_ENV_TEST){
    $phoneMaskScript = '';
} else {
    $phoneMaskScript = '$("[data-mask]").inputmask();';
}

$script = <<< JS
$("#users-table").DataTable({
    "infoCallback": function( settings, start, end, max, total, pre ) {
        return "<div>" + pre + "</div>";
    },
    "columns": [
        { "orderable": false },
        { "orderable": true },
        { "orderable": false },
        { "orderable": false },
        { "orderable": true },
        { "orderable": false }
    ],
    "searching": false,
    "order": [[1, 'desc']],
    "language": {
        "lengthMenu": "Показать _MENU_ записей на странице",
        "zeroRecords": "Ничего не найдено",
        "info": "Показана _PAGE_ страница из _PAGES_",
        "infoEmpty": "Нет данных",
        "infoFiltered": "(отсортировано из _MAX_ записей)",
        "Search": "",
        "decimal":        "",
        "emptyTable":     "нет записей",
        "infoPostFix":    "",
        "thousands":      ",",
        "loadingRecords": "загрузка...",
        "processing":     "обработка...",
        "search":         "Поиск:",
        "paginate": {
            "first":      "Первый",
            "last":       "Последний",
            "next":       "Следующий",
            "previous":   "Предыдущий"
        },
        "aria": {
            "sortAscending":  ": activate to sort column ascending",
            "sortDescending": ": activate to sort column descending"
        }
    }
});

$phoneMaskScript

$('#filter-registration').daterangepicker();
JS;
$this->registerJs($script, \yii\web\View::POS_READY);