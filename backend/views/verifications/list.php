<?php

/* @var $this yii\web\View */
/* @var $verifications array */

$this->title = 'Список верификаций';

use yii\helpers\Url;
use backend\assets\DataTablesAsset;
use common\models\PassportVerification;

DataTablesAsset::register($this);


?>

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Пользователи
            <small>список верификаций</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Главная</a></li>
            <li><a href="#">Пользователи</a></li>
            <li class="active">Список верификаций</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">


        <?php if($report = Yii::$app->session->getFlash('verification-list-report')): ?>
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4>	<i class="icon fa fa-check"></i> <?= $report['message'] ?></h4>
            </div>
        <?php endif; ?>


        <div class="row">
            <div class="col-xs-12">

                <div class="box">
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped data-table">
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
                                <th>Проверка</th>
                                <th>Роль</th>
                                <th>Дата заявки</th>
                                <th>Дата проверки</th>
                                <th>Действия</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php foreach($verifications as $verification): /** @var $user \common\models\PassportVerification */
                                $user = $verification->user;
                            ?>
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
                                    <td>
                                        <?php
                                        if($verification->status == PassportVerification::STATUS_VERIFYED) echo "проверено" ;
                                        if($verification->status == PassportVerification::STATUS_REJECTED) echo "отклонено" ;
                                        if($verification->status == PassportVerification::STATUS_WAITING_VERIFICATION) echo "ожидает проверки" ;
                                        ?>
                                    </td>

                                    <td><?= $user->role->name ?></td>
                                    <td><?= date_create($verification->created)->format('d.m.Y') ?></td>
                                    <td><?= date_create($verification->verification_date)->format('d.m.Y') ?></td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a href="<?= Url::to(['/verifications/verify', 'id' => $verification->id]) ?>" class="btn btn-success"><i class="fa fa-edit"></i></a>
                                            <a href="<?= Url::to(['/verifications/reject', 'id' => $verification->id]) ?>" class="btn btn-warning"><i class="fa fa-trash"></i></a>
                                            <a href="<?= Url::to(['/verifications/delete', 'id' => $verification->id]) ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
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
                                <th>Проверка</th>
                                <th>Роль</th>
                                <th>Дата заявки</th>
                                <th>Дата проверки</th>
                                <th>Действия</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </section><!-- /.content -->








<?php
$tableActionsUrl = Url::to(['users/batchdelete']);
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
                    "                        <li><a data-action='delete' href=\"#\">Удалить</a></li>" +
                    "                        <li class=\"divider\"></li>" +
                    "                        <li><a data-action='add' href=\"#\">Добавить в группу</a></li>" +
                    "                        <li><a data-action='remove' href=\"#\">Удалить из группы</a></li>" +
                    "                      </ul>" +
                    "                    </div>";
            },

          "columns": [
            { "orderable": false },
            { "orderable": true },
            { "orderable": true },
            { "orderable": true },
            { "orderable": true },
            { "orderable": true },
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

        $('#example1 thead,#example1 tfoot').on('change', '[type=checkbox]', function () {
            var checked = $(this).is(':checked');
            var checkboxes = $("#example1").find('[type=checkbox]');
            checkboxes.prop('checked', checked);
        });

          $("#example1 tbody").on('change', '[type=checkbox]', function(){
              $('#example1 thead [type=checkbox],#example1 tfoot [type=checkbox]').prop('checked', false);
          });

          $("[data-mask]").inputmask();


          //Date range picker
          $('#filter-registration').daterangepicker();
          
          $('[data-action=delete]').click(function(){
              let ids = [];
              $('.data-table input[type=checkbox]:checked').each(function(){
                  ids.push(this.value);
              });
              modalDialog( "Удалить выбранные?", '$tableActionsUrl', { data: ids } , function(){ 
                  location.reload();
              });
          });
          
JS;
$this->registerJs($script, \yii\web\View::POS_READY);