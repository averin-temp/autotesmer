<?php
/** @var $this \yii\web\View */
/** @var $expert \common\models\User */
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
                    <?php $menu = 'contacts'; include __DIR__ . '/left-sidebar.php'; ?>
                </div>
            </div>
            <div class="col-md-9">
                <div class="lk_expert_body">
                    <div class="lk_expert_body_general_body">
                        <div class="lk_left_body_info_body">
                            <ul>
                                <li>Город:   <span><?= $expert->city->name ?></span></li>
                                <li>Возраст:   <span><?= $expert->age ? $expert->age . ' лет' : 'не указан' ?></span></li>
                                <?php
                                $icon = $expert->confirmed_phone ? Url::to('@web/img/icons/steps/ok.jpg') : Url::to('@web/img/icons/steps/nok.png');
                                $label = $expert->confirmed_phone ? "Проверенный телефон" : "Телефон не проверен";
                                ?>
                                <li>
                                    <img src="<?= $icon ?>" alt=""> <?= $label ?>:   <span><?= $expert->phone ?></span>
                                </li>
                            </ul>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</main>