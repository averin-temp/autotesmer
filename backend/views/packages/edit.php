<?php

/**
 * @var $this yii\web\View
 * @var $package \common\models\Package
 */

use yii\helpers\Url;
use yii\web\View;
use backend\assets\DataTablesAsset;

DataTablesAsset::register($this);

?>

    <?= $this->render('//modals/dialog') ?>

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Редактор пакета
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= Url::home() ?>"><i class="fa fa-dashboard"></i> Главная</a></li>
            <li><a href="<?= Url::to(['packages/list']) ?>">Пакеты</a></li>
            <li class="active">Редактор пакета</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <?php if($report = Yii::$app->session->getFlash('edit-package')): ?>
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4>	<i class="icon fa fa-check"></i> <?= $report['message'] ?></h4>
            </div>
        <?php endif; ?>

        <div class="box">
            <form action="<?= Url::to(['packages/save']) ?>" method="post">
                <input name="id" type="hidden" value="<?= $package->id ?>">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Название</label>
                                <input name="name" type="text" class="form-control" value="<?= $package->name ?>">
                            </div>
                            <?php if($package->hasErrors('name')): ?>
                                <div class="form-error"><?= $package->getFirstError('name') ?><p></p></div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div><!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" class="btn btn-info">Сохранить</button>
                </div>
            </form>
        </div><!-- /.box -->

        <div class="box">
            <h3 class="box-title">Список вариантов пакета</h3>
            <div class="box-body">

                <table id="variants-table" class="table table-bordered table-striped">
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
                        <th>Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($package->variants as $variant): /** @var $variant \common\models\PackageVariant */?>
                        <tr>

                            <td>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" style="cursor: pointer" value="<?= $variant->id ?>">
                                    </label>
                                </div>
                            </td>

                            <td><?= $variant->name ?></td>

                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="<?= Url::to(['/packages/editvariant', 'id' => $variant->id ]) ?>" class="btn btn-success"><i class="fa fa-edit"></i></a>
                                    <a href="<?= Url::to(['/packages/deletevariant', 'id' => $variant->id]) ?>" class="btn btn-danger delete-row"><i class="fa fa-trash"></i></a>
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
                                    <input type="checkbox" id="check_all" style="cursor: pointer">
                                </label>
                            </div>
                        </th>
                        <th>Название</th>
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
                        <li><a data-action="delete_variants" href="#">Удалить</a></li>
                    </ul>
                </div>

            </div><!-- /.box-body -->

        </div><!-- /.box -->

        <?php if(!$package->isNewRecord): ?>
        <div class="box-footer">
            <a href="<?= Url::to(['packages/addvariant', 'package' => $package->id]) ?>" class="btn btn-info">Добавить вариант</a>
        </div>
        <?php endif; ?>

    </section><!-- /.content -->


    <!-- Форма отправки групповых действий -->
    <form id="action-form" action="<?= Url::to(['batch', 'id' => $package->id]) ?>" method="post">
        <input type="hidden" name="action">
        <input type="hidden" name="ids">
        <input type="hidden" name="package" value="<?= $package->id ?>">
    </form>



<?php

$script = <<< JS
$("#variants-table").DataTable({
            "infoCallback": function( settings, start, end, max, total, pre ) {
                return "<div>" + pre + "</div></br>";
            },

            "columns": [
                { "orderable": false },
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