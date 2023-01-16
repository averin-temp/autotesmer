<?php

/* @var $this yii\web\View */
/* @var $user \common\models\User */
/* @var $promocodesSets array */

use yii\web\View;

use yii\helpers\Url;
use backend\assets\DataTablesAsset;
use backend\assets\InputmaskAsset;
use backend\assets\DateRangeAsset;

DataTablesAsset::register($this);
DateRangeAsset::register($this);
InputmaskAsset::register($this);

?>

<?= $this->render('//modals/dialog') ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Наборы кодов
    </h1>
    <ol class="breadcrumb">
        <li><a href=""><i class="fa fa-dashboard"></i> Главная</a></li>
        <li class="active"><a href="#">Наборы</a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <?php if($report = Yii::$app->session->getFlash('promocode-edit')): ?>
        <div class="alert <?= $report['status'] == 'success' ? "alert-success" : "alert-danger" ?> alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4>	<i class="icon fa fa-check"></i> <?= $report['message'] ?></h4>
        </div>
    <?php endif; ?>


    <div class="row">
        <div class="col-xs-12">

            <div class="box">
                <div class="box-body">
                    <table id="promocode-table" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" id="check_all" style="cursor: pointer">
                                    </label>
                                </div>
                            </th>
                            <th>Название</th>
                            <th>Количество</th>
                            <th>Использовано</th>
                            <th>Активен</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($promocodesSets as $promocodesSet): /** @var $promocodesSet \common\models\PromocodesSet */?>
                            <tr>
                                <td>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" style="cursor: pointer" value="<?= $promocodesSet->id ?>">
                                        </label>
                                    </div>
                                </td>
                                <td><?= $promocodesSet->name ?></td>
                                <td><?= $promocodesSet->getPromocodes()->count() ?></td>
                                <td><?= $promocodesSet->usedPromocodes ?></td>
                                <td><?= $promocodesSet->isActive ? 'Да' : 'Нет' ?></td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="<?= Url::to(['promocodes/edit', 'id' => $promocodesSet->id]) ?>" class="btn btn-success"><i class="fa fa-edit"></i></a>
                                        <a href="<?= Url::to(['promocodes/delete', 'id' => $promocodesSet->id]) ?>" class="btn btn-danger delete-row"><i class="fa fa-trash"></i></a>
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
                            <th>Название</th>
                            <th>Количество</th>
                            <th>Использовано</th>
                            <th>Активен</th>
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

$script = <<<JS
$("#promocode-table").DataTable({
            "infoCallback": function( settings, start, end, max, total, pre ) {
                return "<div>" + pre + "</div></br>";
            },

            "columns": [
                { "orderable": false },
                { "orderable": true },
                { "orderable": true },
                { "orderable": false },
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

        $("[data-mask]").inputmask();
        
        //Date range picker
        $('#reservation').daterangepicker();
JS;
$this->registerJS($script, View::POS_READY);
