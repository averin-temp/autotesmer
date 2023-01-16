<?php
/**
 * @var $this \yii\web\View
 * @var $expert \common\models\User
 * @var $model \frontend\models\ExpertInfoModel
 */

use yii\helpers\Url;
use common\models\User;

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
                            <li><span>Настройки</span></li>
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
                                <li><a href="<?= Url::to(['lk/noticesoptions']) ?>">Уведомления</a></li>
                                <li><a href="<?= Url::to(['lk/expertise']) ?>">Пройти экспертизу</a></li>
                                <li class="active"><a href="<?= Url::to(['lk/info']) ?>">Информация</a></li>
                                <li><a href="<?= Url::to(['lk/cards']) ?>">Карты</a></li>
                            </ul>
                        </div>
                        <div class="lk_expert_body_packejes_tabs_body">
                            <div class="lk_expert_body_sets">
                                <form action="<?= Url::to(['expert/info']) ?>" method="post">

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="reg_exp_page_3">
                                            <h2>Информация</h2>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="f_group">
                                            <label for="">Статус</label>
                                            <textarea name="status" cols="10" rows="10"><?= $expert->status ?></textarea>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="f_group">
                                            <label for="">Занятость</label>
                                            <select name="busyness">
                                                <?php foreach(User::busynessVariants() as $key => $variant): ?>
                                                    <option value="<?= $key ?>"<?= $expert->busyness == $key ? " selected" : "" ?>><?= $variant ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>   
                                    
                                    
                                    
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="f_group">
                                            <label for="">Текст</label>
                                            <textarea name="text" id="" cols="30" rows="10"><?= $expert->text ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="f_group">
                                            <label for="">О себе</label>
                                            <textarea name="about" id="" cols="30" rows="10" placeholder="О себе"><?= $expert->about ?></textarea>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="f_group">
                                            <label for="">Резюме</label>
                                            <textarea name="resume" id="" cols="30" rows="10"><?= $expert->resume ?></textarea>
                                        </div>
                                    </div>

                                </div>


                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <button type="submit" class="button button_orange button_top_img">Сохранить</button>
                                    </div>
                                </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</main>
