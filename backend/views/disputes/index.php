<?php

/* @var $this yii\web\View */
/* @var $disputes array */

$this->title = 'Административный раздел - Арбитраж';

use yii\helpers\Url;
use backend\assets\DataTablesAsset;

DataTablesAsset::register($this);

?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Споры
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Главная</a></li>
            <li class="active"><a href="<?= Url::to(['/disputes']) ?>">Арбитраж</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <?php if($report = Yii::$app->session->getFlash('disputes-report')): ?>
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4>	<i class="icon fa fa-check"></i> <?= $report['message'] ?></h4>
            </div>
        <?php endif; ?>

        <div class="row">
            <div class="col-xs-12">

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Список споров</h3>
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
                                <th>Заказчик</th>
                                <th>Исполнитель</th>
                                <th>Дата</th>
                                <th>Статус</th>
                                <th>Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($disputes as $dispute): /** @var $dispute \common\models\Dispute */?>
                                <tr>
                                    <td>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" style="cursor: pointer">
                                            </label>
                                        </div>
                                    </td>
                                    <td><?= $dispute->client->firstname . ' ' . $dispute->client->lastname ?></td>
                                    <td><?= $dispute->expert->firstname . ' ' . $dispute->expert->lastname ?></td>
                                    <td><?= date_create($dispute->date)->format("d.m.Y H:i:s") ?></td>
                                    <td><?= ([ 1 => "Открыт", 2 => "Закрыт" ])[$dispute->status] ?></td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a href="<?= Url::to(['/disputes/dispute', 'id' => $dispute->id]) ?>" class="btn btn-success"><i class="fa fa-edit"></i></a>
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
                            <th>Заказчик</th>
                            <th>Исполнитель</th>
                            <th>Дата</th>
                            <th>Статус</th>
                            <th>Действия</th>
                            </tfoot>
                        </table>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </section><!-- /.content -->

<?php

$script = <<< JS
$("#example1").DataTable({
            "infoCallback": function( settings, start, end, max, total, pre ) {
                return "<div>" + pre + "</div></br>" +
                    "<div class=\"btn-group\">" +
                    "                      <button type=\"button\" class=\"btn btn-default\">Выполнить с выделенными</button>" +
                    "                      <button type=\"button\" class=\"btn btn-default dropdown-toggle\" data-toggle=\"dropdown\" aria-expanded=\"false\">" +
                    "                        <span class=\"caret\"></span>" +
                    "                        <span class=\"sr-only\">Toggle Dropdown</span>" +
                    "                      </button>" +
                    "                      <ul class=\"dropdown-menu\" role=\"menu\">" +
                    "                        <li><a href=\"#\">Удалить</a></li>" +
                    "                      </ul>" +
                    "                    </div>";
            },

            "columns": [
                { "orderable": false },
                { "orderable": true },
                { "orderable": true },
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

        $('#example1 thead,#example1 tfoot').on('change', '[type=checkbox]', function () {
            var checked = $(this).is(':checked');
            var checkboxes = $("#example1").find('[type=checkbox]');
            checkboxes.prop('checked', checked);
        });

        $("#example1 tbody").on('change', '[type=checkbox]', function(){
            $('#example1 thead [type=checkbox],#example1 tfoot [type=checkbox]').prop('checked', false);
        });
JS;
$this->registerJs($script, \yii\web\View::POS_READY);