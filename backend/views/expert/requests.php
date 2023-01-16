<?php
/* @var $this yii\web\View */
/* @var $expert \common\models\User */
/* @var $orders array */

use yii\helpers\Url;
use backend\widgets\UserPanel;
use backend\assets\InputmaskAsset;

InputmaskAsset::register($this);
?>
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
                    <div class="active tab-pane" id="orders">

                        <table class="table table-bordered">
                            <tbody>
                            <tr>
                                <th>Номер заказа</th>
                                <th>Комментарий</th>
                                <th>Дата создания</th>
                            </tr>
                            <?php $requests = $expert->requests; if(empty($requests)): ?>
                                <tr>
                                    <td colspan="3">Нет заказов</td>
                                </tr>
                            <?php endif ?>

                            <?php foreach($requests as $request): /** @var $order common\models\Request */?>
                                <tr>
                                    <th><?= $request->order->id ?></th>
                                    <th><?= $request->content ?></th>
                                    <th><?= date_create($request->created)->format("d.m.Y") ?></th>
                                </tr>
                            <?php endforeach; ?>
                            <tr>
                                <th>Номер заказа</th>
                                <th>Комментарий</th>
                                <th>Дата создания</th>
                            </tr>
                            </tbody>
                        </table>

                        <?php if(false): ?>
                        <nav>
                            <ul class="pagination">
                                <li class="page-item"><a class="page-link" href="#">Предыдущая</a></li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">Следующая</a></li>
                            </ul>
                        </nav>
                        <?php endif; ?>

                    </div><!-- /.tab-pane -->
                </div><!-- /.tab-content -->
            </div><!-- /.nav-tabs-custom -->
        </div><!-- /.col -->
    </div><!-- /.row -->

</section><!-- /.content -->