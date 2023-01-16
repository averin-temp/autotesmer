<?php

/* @var $this yii\web\View */
/* @var $models \common\models\AdminNotification[] */

$this->title = 'Сообщения';

use \yii\web\View;
use backend\assets\DataTablesAsset;
use yii\helpers\Url;


DataTablesAsset::register($this);


?>

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Сообщения
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= Url::to(['/dashboard']) ?>"><i class="fa fa-dashboard"></i> Главная</a></li>
            <li class="active"><a href="#">Сообщения</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <?php if($report = Yii::$app->session->getFlash('advertising-table')): ?>
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4>	<i class="icon fa fa-check"></i> <?= $report['message'] ?></h4>
            </div>
        <?php endif; ?>

        <div class="row">
            <div class="col-xs-12">

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Список сообщений</h3>
                    </div>
                    <div class="box-body">
                        <table id="data-table" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Сообщение</th>
                                <th>Дата</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($models as $model): ?>
                                <tr>
                                    <td><?= $model->content ?></td>
                                    <td><?= $model->time ?></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Сообщение</th>
                                <th>Дата</th>
                            </tr>
                            </tfoot>
                        </table>

                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </section><!-- /.content -->

<?php

$script = <<< JS
$("#data-table").DataTable({
            "infoCallback": function( settings, start, end, max, total, pre ) {
                return "<div>" + pre + "</div></br>"
            },
            "columns": [
                { "orderable": false },
                { "orderable": true },
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