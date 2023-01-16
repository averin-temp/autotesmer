<?php
/**
 * @var $this \yii\web\View
 * @var $settings \common\models\NotificationsSettings
 * @var $descriptions array
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
                    <?php $menu = 'settings'; include __DIR__ . '/left-sidebar.php'; ?>
                </div>
            </div>
            <div class="col-md-9">
                <div class="lk_expert_body">
                    <div class="lk_expert_body_packejes">

                        <div class="lk_expert_body_packejes_tabs">
                            <ul>
                                <li><a href="<?= Url::to(['lk/settings']) ?>">Общие настройки</a></li>
                                <li class="active"><a href="<?= Url::to(['lk/noticesoptions']) ?>">Уведомления</a></li>
                                <li><a href="<?= Url::to(['lk/expertise']) ?>">Пройти экспертизу</a></li>
                                <li><a href="<?= Url::to(['lk/info']) ?>">Информация</a></li>
                            </ul>
                        </div>
                        <div class="lk_expert_body_packejes_tabs_body">
                            <div class="lk_expert_body_sets">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="reg_exp_page_333">
                                            <h3>Какие уведомления вы хотите получать на свой e-mail?</h3>
                                        </div>
                                        <div class="reg_exp_page_3332 ccheck">
                                            <?php foreach($settings->safeAttributes() as $setting): ?>
                                                <div class="custom-control custom-checkbox">
                                                    <input name="<?= $setting ?>" type="hidden" value="0">
                                                    <input name="<?= $setting ?>" type="checkbox" id="<?= $setting ?>" value="1" class="custom-control-input" <?= $settings->$setting ? " checked" : "" ?>>
                                                    <label class="custom-control-label" for="<?= $setting ?>"><?= $descriptions[$setting] ?></label>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <a class="button button_orange button_top_img" href="">Сохранить</a>
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
