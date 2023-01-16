<?php
/* @var $this yii\web\View */
/* @var $expert \common\models\User */
/* @var $reviews array */

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
                        <div class="active tab-pane" id="comments">

                            <?php foreach($reviews as $review): /** @var $review \common\models\Review */
                            /** @var \common\models\User $sender */
                                $sender = $review->sender;

                            ?>
                                <div class="post clearfix">
                                    <div class="user-block">
                                        <img class="img-circle img-bordered-sm" src="<?= $sender->avatar ?>" alt="user image">
                                        <span class="username">
                                        <a href="<?= Url::to(['users/edit', 'id' => $sender->id]) ?>"><?= ucfirst($sender->firstname) . ' ' . ucfirst($sender->family) ?></a>
                                    </span>
                                    </div><!-- /.user-block -->
                                    <p><?= $review->content ?></p>
                                </div>
                            <?php endforeach; ?>

                        </div><!-- /.tab-pane -->
                    </div><!-- /.tab-content -->
                </div><!-- /.nav-tabs-custom -->
            </div><!-- /.col -->
        </div><!-- /.row -->

    </section><!-- /.content -->