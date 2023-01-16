<?php

/* @var $this yii\web\View */
/* @var $banners array */

$this->title = 'Баннеры';

use \yii\web\View;
use backend\assets\DataTablesAsset;
use yii\helpers\Url;
use backend\assets\DialogAsset;

DataTablesAsset::register($this);
DialogAsset::register($this);

?>

<?= $this->render('//modals/dialog') ?>

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Баннеры
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Главная</a></li>
            <li class="active"><a href="#">Баннеры</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <?php if($report = Yii::$app->session->getFlash('banner-table')): ?>
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4>	<i class="icon fa fa-check"></i> <?= $report['message'] ?></h4>
            </div>
        <?php endif; ?>

        <div class="row">
            <div class="col-xs-12">

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Список баннеров</h3>
                    </div>
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" id="check_all" style="cursor: pointer">
                                        </label>
                                    </div>
                                </th>
                                <th>Название баннера</th>
                                <th>Кол-во просмотров</th>
                                <th>Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($banners as $banner): ?>

                                <tr>
                                    <td>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" style="cursor: pointer" value="<?= $banner->id ?>">
                                            </label>
                                        </div>
                                    </td>
                                    <td><?= $banner->name ?></td>
                                    <td><?= $banner->view_counter ?></td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a href="<?= Url::to(['/banners/edit', 'id' => $banner->id]) ?>" class="btn btn-success"><i class="fa fa-edit"></i></a>
                                            <a href="<?= Url::to(['/banners/delete', 'id' => $banner->id]) ?>" class="btn btn-danger delete-row"><i class="fa fa-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>

                            <?php endforeach; ?>



                            </tbody>
                            <tfoot>
                            <th>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" id="check_all" style="cursor: pointer">
                                    </label>
                                </div>
                            </th>
                            <th>Название баннера</th>
                            <th>Кол-во просмотров</th>
                            <th>Действия</th>
                            </tfoot>
                        </table>

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

$script = <<< JS
$("#example1").DataTable({
            "infoCallback": function( settings, start, end, max, total, pre ) {
                return "<div>" + pre + "</div></br>"
            },
            "columns": [
                { "orderable": false },
                { "orderable": true },
                { "orderable": true },
                { "orderable": false },
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
JS;

$this->registerJS($script, View::POS_READY);