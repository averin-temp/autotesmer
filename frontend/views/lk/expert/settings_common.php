<?php

/** @var $this \yii\web\View */
/** @var $model \frontend\models\ExpertSettings */
/** @var $cities array */
/** @var $socials \common\interfaces\OauthInterface[] */

use yii\helpers\Url;
use frontend\widgets\PassportVerificationWidget;
use frontend\assets\InputmaskAsset;
use frontend\widgets\UserDocumentsWidget;
InputmaskAsset::register($this);




?><main class="lk">
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
                                <li class="active"><a href="<?= Url::to(['lk/settings']) ?>">Общие настройки</a></li>
                                <li><a href="<?= Url::to(['lk/noticesoptions']) ?>">Уведомления</a></li>
                                <li><a href="<?= Url::to(['lk/expertise']) ?>">Пройти экспертизу</a></li>
                                <li><a href="<?= Url::to(['lk/info']) ?>">Информация</a></li>
                                <li><a href="<?= Url::to(['lk/cards']) ?>">Карты</a></li>
                            </ul>
                        </div>
                        <div class="lk_expert_body_packejes_tabs_body">
                            <div class="lk_expert_body_sets">

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="reg_exp_page_3">
                                            <h2>Общие настройки</h2>
                                        </div>
                                    </div>
                                </div>

                                <form action="<?= Url::to(['/expert/settings']) ?>" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="f_group">
                                            <label for="">Фамилия</label>
                                            <input type="text" placeholder="Введите фамилию" required=""
                                                   name="family" value="<?= $model->family ?>">
                                        </div>
                                        <?php $model->errorField('family') ?>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="f_group">
                                            <label for="">Имя</label>
                                            <input type="text" placeholder="Введите имя" required=""
                                                   name="firstname" value="<?= $model->firstname ?>">
                                        </div>
                                        <?php $model->errorField('firstname') ?>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="f_group">
                                            <label for="">Отчество</label>
                                            <input type="text" placeholder="Введите отчество" required=""
                                                   name="lastname" value="<?= $model->lastname ?>">
                                        </div>
                                        <?php $model->errorField('lastname') ?>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="f_group">
                                            <label for="">Электронная почта</label>
                                            <input type="text" placeholder="Введите e-mail" required=""
                                                   name="email" value="<?= $model->email ?>">
                                        </div>
                                        <?php $model->errorField('email') ?>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="f_group">
                                            <a href="" class="suba">Подтвердить e-mail</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="f_group">
                                            <label for="">Телефон</label>
                                            <input name="phone" type="text" required value="<?= $model->phone ?>">
                                        </div>
                                        <?php $model->errorField('phone') ?>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="f_group">
                                            <a href="" class="suba">Подтвердить номер</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="f_group">
                                            <label for="">Город </label>
                                            <select name="city">
                                                <option value="0">Выберите город</option>
                                                <?php foreach($cities as $city): ?>
                                                    <option value="<?= $city['id'] ?>"<?= $model->city == $city['id'] ? " selected" : "" ?>><?= $city['name'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <?php $model->errorField('city') ?>

                                </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="f_group">
                                                <label for="">Дата рождения </label>
                                                <select name="day">
                                                    <?php for($day = 1; $day <= 31 ; $day++): ?>
                                                        <option value="<?= $day ?>"<?= $model->day == $day ? " selected" : "" ?>><?= $day ?></option>
                                                    <?php endfor; ?>
                                                </select>
                                            </div>

                                        </div>
                                        <div class="col-md-2">
                                            <div class="f_group">
                                                <label for=""> Месяц</label>
                                                <select name="month">
                                                    <?php for($month = 1; $month <= 12 ; $month++): ?>
                                                        <option value="<?= $month ?>"<?= $model->month == $month ? " selected" : "" ?>><?= $month ?></option>
                                                    <?php endfor; ?>
                                                </select>
                                            </div>

                                        </div>
                                        <div class="col-md-2">
                                            <div class="f_group">
                                                <label for=""> </label>
                                                <select name="year">
                                                    <?php for($year = 2001; $year >= 1930 ; $year--): ?>
                                                        <option value="<?= $year ?>"<?= $model->year == $year ? " selected" : "" ?>><?= $year ?></option>
                                                    <?php endfor; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="f_group">
                                                <label for="">Пол </label>
                                                <ul class="ulli">
                                                    <input type="hidden" name="gender" value="<?= $model->gender ?>">
                                                    <li><a id="gender-man" href=""><img src="<?= $model->gender ? Url::to('@web/img/icons/man-active.png') : Url::to('@web/img/icons/man.png') ?>" alt=""></a></li>
                                                    <li><a id="gender-woman" href=""><img src="<?= !$model->gender ? Url::to('@web/img/icons/woman-active.png') : Url::to('@web/img/icons/woman.png') ?>" alt=""></a></li>
                                                </ul>
                                            </div>
                                        </div>

                                    </div>

                                <?php $model->errorField('day') ?>
                                <?php $model->errorField('month') ?>
                                <?php $model->errorField('year') ?>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="reg_exp_page_333">
                                            <h3>Владеете ли вы ИП или юридическим лицом?</h3>
                                        </div>
                                        <div class="reg_exp_page_3332 ccheck">
                                            <div class="custom-control custom-checkbox">
                                                <input type="hidden" value="0" name="has_ul">
                                                <input type="checkbox" class="custom-control-input" id="inputHasUL" value="1" name="has_ul"<?= $model->has_ul ? " checked" : '' ?>>
                                                <label class="custom-control-label" for="inputHasUL">У меня есть юридическое лицо</label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="hidden" value="0" name="has_ip">
                                                <input type="checkbox" class="custom-control-input" id="inputHasIP" value="1" name="has_ip"<?= $model->has_ip ? " checked" : '' ?>>
                                                <label class="custom-control-label" for="inputHasIP">У меня есть ИП</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <div class="rdevid"></div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="reg_exp_page_3">
                                            <h2>Документы </h2>
                                        </div>
                                    </div>
                                </div>


                                <?= PassportVerificationWidget::widget(['verification' => $model->_user->verification ]) ?>
                                <?php if($model->_user->verification && $model->_user->verification->status == \common\models\PassportVerification::STATUS_VERIFYED){
                                    //echo UserDocumentsWidget::widget(['user' => $model->_user ]);
                                } ?>

                                <div class="rdevid"></div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="reg_exp_page_3">
                                            <h2>Изменить пароль </h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="f_group">
                                            <label for=""> Пароль </label>
                                            <input type="text" name="password" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="f_group">
                                            <label for=""> Повторите пароль </label>
                                            <input type="text" name="confirm" value="">
                                        </div>
                                    </div>
                                </div>
                                <?php $model->errorField('password') ?>
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <button class="button button_orange button_top_img">Сохранить</button>
                                    </div>
                                </div>

                                </form>



                                <div class="rdevid"></div>


                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="reg_exp_page_3">
                                            <h2>Социальные сети </h2>
                                        </div>
                                    </div>
                                </div>

                                <?php if(count($socials)) : ?>
                                    <div class="row">
                                        <?php foreach($socials as $network): $attribute = \common\models\User::networkAttribute($network->name)?>
                                            <div class="col-md-6">
                                                <div class="f_group">
                                                    <label for=""> <?= $network->name ?></label>
                                                    <?php if($model->_user->$attribute): ?>
                                                        <a href="<?= Url::to(['/oauth/unlink', 'network' => $network->name ]) ?>">Отвязать</a>
                                                    <?php else: ?>
                                                        <a href="<?= Url::to(['/oauth/register', 'network' => $network->name]) ?>">Привязать</a>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</main>

<?php
$iconsUrl = Url::to('@web/img/icons');
$script = <<< JS
$('#gender-man').click(function(e){
    e.preventDefault();
    let img = $(this).find('img');
    img.attr('src', "$iconsUrl/man-active.png");
    $('#gender-woman img').attr('src', "$iconsUrl/woman.png");
    $('input[name=gender]').val(1);
});
$('#gender-woman').click(function(e){
    e.preventDefault();
    let img = $(this).find('img');
    img.attr('src', "$iconsUrl/woman-active.png");
    $('#gender-man img').attr('src', "$iconsUrl/man.png");
    $('input[name=gender]').val(0);
});
$('input[name=phone]').inputmask("+9 (999) 999-99-99");


JS;
$this->registerJs($script);
