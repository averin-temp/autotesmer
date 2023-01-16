<?php
/* @var $this yii\web\View */
/* @var $expert \common\models\User */
/* @var $packages array */

use backend\widgets\UserPanel;
use yii\helpers\Url;

?>

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Страница пользователя (Эксперт)</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Главная</a></li>
            <li><a href="<?= Url::to(['users/index']) ?>">Пользователи</a></li>
            <li class="active">Страница пользователя (Эксперт)</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-md-3">

                <?php echo UserPanel::widget(['user' => $expert]); ?>


            </div><!-- /.col -->
            <div class="col-md-9">
                <div class="nav-tabs-custom">

                    <?= $this->render('expert-menu', ['user' => $expert]) ?>

                    <div class="tab-content">
                        <div class="active tab-pane" id="packages">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th>Название</th>
                                        <th>Приобретен</th>
                                        <th>Статус</th>
                                        <th style="width: 40px">Время окончания</th>
                                    </tr>
                                    <?php $packages=[]; foreach($packages as $package): ?>
                                    <tr>
                                        <td>Пакет минутка</td>
                                        <td>11.03.2004</td>
                                        <td>
                                            <span class="label label-success">Завершен</span>
                                        </td>
                                        <td>09.03.2004</td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>

                            <nav>
                                <ul class="pagination">
                                    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                </ul>
                            </nav>

                        </div><!-- /.tab-pane -->
                    </div><!-- /.tab-content -->
                </div><!-- /.nav-tabs-custom -->
            </div><!-- /.col -->
        </div><!-- /.row -->

    </section><!-- /.content -->