<?php
/** @var $this \yii\web\View */
/** @var $disputes array */


use yii\helpers\Url;

?>

<main class="lk">
    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breads_wrapper dark">
                        <ul>
                            <li><a href="/">Главная</a></li>
                            <li><span>></span></li>
                            <li><span>Личный кабинет</span></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <?php $menu = 'orders'; include __DIR__ . '/left-sidebar.php' ?>
                </div>
            </div>
            <div class="col-md-9">
                <div class="lk_user_body">

                    <?= $this->render('my-orders-tabs') ?>

                    <div class="lk_expert_body_packejes_tabs_body">

                        <h3>Все жалобы</h3>

                        <div>
                            <?php foreach($disputes as $dispute): /** @var $appeal \common\models\Appeal */ ?>
                            тут что-то написано<br>
                            <a href="<?= Url::to(['lk/dispute', 'id' => $dispute->id ]) ?>">Перейти к спору</a>
                            <?php endforeach; ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</main>
