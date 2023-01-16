<?php
/* @var $this yii\web\View */
/* @var $expert \common\models\User */
/* @var $orders array */

use yii\helpers\Url;
use backend\widgets\UserPanel;
use backend\assets\InputmaskAsset;
use common\models\Order;

InputmaskAsset::register($this);
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
                        <div class="active tab-pane" id="orders">

                            <table class="table table-bordered">
                                <tbody>
                                <tr>
                                    <th>Заказ</th>
                                    <th>Дата создания</th>
                                    <th style="width: 40px">Статус</th>
                                </tr>
                                <?php if(empty($orders)): ?>
                                    <tr>
                                        <td colspan="3">Нет заказов</td>
                                    </tr>
                                <?php endif ?>


                                <?php foreach($orders as $order): /** @var $order common\models\Order */?>
                                    <tr>
                                        <td>
                                            <p><?= $order->comment ?></p>
                                        </td>
                                        <td><?= $order->publicationDate("j.n.Y") ?></td>
                                        <td>
                                            <?php
                                            if($order->status == Order::STATUS_FREE) echo "открыт";
                                            if($order->status == Order::STATUS_WORK) echo "в работе";
                                            if($order->status == Order::STATUS_CLOSED) echo "закрыт";
                                            if($order->status == Order::STATUS_WAITING_RESERVATION) echo "ожидает";
                                            ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>

                        </div><!-- /.tab-pane -->
                    </div><!-- /.tab-content -->
                </div><!-- /.nav-tabs-custom -->
            </div><!-- /.col -->
        </div><!-- /.row -->

    </section><!-- /.content -->