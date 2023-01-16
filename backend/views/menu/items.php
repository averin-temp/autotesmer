<?php

/* @var $this yii\web\View */
/* @var $menu \common\models\Menu */
/* @var $items \common\models\MenuItem[] */

use yii\web\View;
use backend\assets\DataTablesAsset;
use yii\helpers\Url;

DataTablesAsset::register($this);

$this->title = 'Пункты меню';
?>
    <?= $this->render('//modals/dialog') ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Пункты меню "<?= $menu->name ?>"
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= Url::to(['dashboard']) ?>"><i class="fa fa-dashboard"></i> Главная</a></li>
            <li><a href="<?= Url::to(['index']) ?>">Список меню</a></li>
            <li class="active"><a href="<?= Url::to(['items', 'menu_id' => $menu->id ]) ?>">Пункты меню <?= $menu->name ?></a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <?php if($report = Yii::$app->session->getFlash('menu-items-table')): ?>
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4>	<i class="icon fa fa-check"></i> <?= $report['message'] ?></h4>
            </div>
        <?php endif; ?>

        <div class="row">
            <div class="col-xs-12">

                <a href="<?= \yii\helpers\Url::to(['new_item', 'menu_id' => $menu->id]) ?>" class="btn btn-warning">Создать пункт меню</a>

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Пункты меню</h3>
                    </div>
                    <div class="box-body">
                        <table id="menu-items-table" class="table table-bordered table-striped">
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
                                <th>Url</th>
                                <th>Порядок</th>
                                <th>Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($items as $item): ?>
                                <tr>
                                    <td>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" style="cursor: pointer" value="<?= $item->id ?>">
                                            </label>
                                        </div>
                                    </td>
                                    <td><?= $item->name ?></td>
                                    <td><?= $item->url ?></td>
                                    <td><?= $item->order ?></td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a href="<?= Url::to(['edit_item', 'id' => $item->id])  ?>" class="btn btn-success"><i class="fa fa-edit"></i></a>
                                            <a href="<?= Url::to(['delete_item', 'id' => $item->id])  ?>" class="btn btn-danger delete-row"><i class="fa fa-trash"></i></a>
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
                            <th>Название</th>
                            <th>Url</th>
                            <th>Порядок</th>
                            <th>Действия</th>
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
                                <li><a data-action="delete_items" href="#">Удалить</a></li>
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
        <input type="hidden" name="menu_id" value="<?= $menu->id ?>">
    </form>

<?php

$script = <<< JS
$("#menu-items-table").DataTable({
            "infoCallback": function( settings, start, end, max, total, pre ) {
                return "<div>" + pre + "</div></br>";
            },

            "columns": [
                { "orderable": false },
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
JS;

$this->registerJS($script, View::POS_READY);
