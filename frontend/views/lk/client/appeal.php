<?php
/** @var $this \yii\web\View */
/** @var $appeal \common\models\Appeal */


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

                        <h3>Создание жалобы</h3>




                        <div>




                            <form action="<?= Url::to(['/dispute/appeal', 'dial_id' => $appeal->dial_id]) ?>" method="post">
                                <input type="hidden" name="dial_id" value="<?= $appeal->dial_id ?>">

                                <div class="f_group">
                                    <label for="content">Текст жалобы</label>
                                    <textarea name="content" id="content" cols="30" rows="10"><?= $appeal->content ?></textarea>
                                </div>



                                <?php if($appeal->hasErrors('content')): ?>
                                <p><?= $appeal->getFirstError('content') ?></p>
                                <?php endif; ?>

                                <button>Отправить</button>
                            </form>
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>

</main>
