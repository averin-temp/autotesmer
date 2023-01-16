<?php

/* @var $this yii\web\View */
/* @var $promocodesSet \common\models\PromocodesSet */
/* @var $packages \common\models\Package[] */

$this->title = 'My Yii Application';

use yii\web\View;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
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
            Новый набор
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Главная</a></li>
            <li><a href="#">Промокоды</a></li>
            <li class="active">Новый набор</li>
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



        <div class="box">

            <form action="<?= Url::to(['promocodes/save']) ?>" method="post">

                <input name="id" type="hidden" value="<?= $promocodesSet->id ?>">

            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">

                        <div class="form-group">
                            <label>Название набора</label>
                            <input name="name" type="text" class="form-control" value="<?= $promocodesSet->name ?>">
                            <?= $promocodesSet->errorField('name') ?>
                        </div>

                        <div class="form-group">
                            <label>Применяется к пакетам</label>
                            <select name="_packages[]" multiple class="form-control">
                                <?php foreach($packages as $package): /** @var \common\models\Package $package */ ?>
                                    <option value="<?= $package->id ?>"<?= in_array($package->id, $f = ArrayHelper::getColumn($promocodesSet->packages, 'id')) ? ' selected' : ''?>><?= $package->name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Скидка</label>
                            <input name="discount" type="text" class="form-control" value="<?= $promocodesSet->discount ? $promocodesSet->discount * 100 : '' ?>">
                            <?= $promocodesSet->errorField('discount') ?>
                        </div>

                        <!-- Date range -->
                        <div class="form-group">
                            <label>Период действия:</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input name="period" type="text" class="form-control pull-right" id="reservation" value="<?= $promocodesSet->formPeriod() ?>">
                                <?= $promocodesSet->errorField('period') ?>
                            </div><!-- /.input group -->
                        </div><!-- /.form group -->




                    </div>
                </div>

            </div><!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" class="btn btn-info">Сохранить</button>
                </div>
            </form>



        </div><!-- /.box -->

        <div class="box">

            <div class="box-body">

                <?php if(!$promocodesSet->isNewRecord): ?>
                    <div class="form-group">
                        <form class="form-inline" action="<?= Url::to(['promocodes/generate']) ?>" method="post">
                            <button type="submit" class="btn btn-info">Создать</button>
                            <input name="number" type="number" class="form-control" id="inputPassword2" >
                            <input name="id" type="hidden" value="<?= $promocodesSet->id ?>">
                        </form>
                    </div>
                <?php endif; ?>

                <table id="codes" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th style="width: 40px">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" id="check_all" style="cursor: pointer">
                                </label>
                            </div>
                        </th>
                        <th>Код</th>
                        <th>Использован</th>
                        <th>Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($promocodesSet->promocodes as $promocode): /** @var $promocode \common\models\Promocode */?>
                        <tr>
                            <td>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" style="cursor: pointer" value="<?= $promocode->code ?>">
                                    </label>
                                </div>
                            </td>
                            <td><?= $promocode->code ?></td>
                            <th><?= $promocode->used ? ($promocode->user_id ? "использован пользователем" : "использован") : "не использован" ?></th>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="<?= Url::to(['promocodes/removecode', 'code' => $promocode->code ]) ?>" class="btn btn-danger delete-row"><i class="fa fa-trash"></i></a>
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
                    <th>Код</th>
                    <th>Использован</th>
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
                        <li><a data-action="delete-code" href="#">Удалить</a></li>
                    </ul>
                </div>



            </div><!-- /.box-body -->

        <div class="box-footer">
            <!--button type="button" class="btn btn-info">Скачать список кодов</button-->
        </div>



        </div><!-- /.box -->

    </section><!-- /.content -->

    <!-- Форма отправки групповых действий -->
    <form id="action-form" action="<?= Url::to(['batch']) ?>" method="post">
        <input type="hidden" name="action">
        <input type="hidden" name="ids">
    </form>


<?php

$script = <<< JS
//Date range picker
        $('#reservation').daterangepicker();

        $("#codes").DataTable({
            "infoCallback": function( settings, start, end, max, total, pre ) {
                return "<div>" + pre + "</div></br>";
            },

            "searching": false,
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
