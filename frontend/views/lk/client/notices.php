<?php
/**
 * @var $this \yii\web\View
 * @var $settings \common\models\NotificationsSettings
 */
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
                    <?php $menu = 'notices'; include __DIR__ . '/left-sidebar.php' ?>
                </div>
            </div>
            <div class="col-md-9">
                <div class="lk_expert_body">
                    <div class="lk_expert_body_packejes">

                        <div class="lk_expert_body_packejes_tabs">
                            <ul>
                                <li class="active"><a href="<?= Url::to(['/lk/notices']) ?>">Уведомления</a></li>
                                <li><a href="<?= Url::to(['/lk/noticesoptions']) ?>">Настройка уведомлений</a></li>
                            </ul>
                        </div>
                        <div class="lk_expert_body_packejes_tabs_body">
                            <div class="lk_expert_body_sets">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="reg_exp_page_333">
                                                <h3>Уведомления</h3>
                                            </div>
                                            <div class="notifications">
                                                <?= empty($notifications) ? 'Нет уведомлений' : '' ?>
                                                <?php foreach($notifications as $notification): /** @var $notification \common\models\Notification */ ?>
                                                <div><p><?= $notification->content ?></p></div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</main>
