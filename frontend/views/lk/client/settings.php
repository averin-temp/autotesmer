<?php
/**
 * @var $this \yii\web\View
 * @var $model \frontend\models\ClientSettings
 * @var $cities array
 */

use yii\helpers\Url;
use frontend\assets\InputmaskAsset;
InputmaskAsset::register($this);

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
                    <?php $menu = 'settings'; include __DIR__ . '/left-sidebar.php' ?>
                </div>
            </div>
            <div class="col-md-9">
                <div class="lk_expert_body">
                    <div class="lk_expert_body_packejes">
                        <form action="<?= Url::to(['client/settings']) ?>" method="post">
                        <div class="lk_expert_body_sets">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="reg_exp_page_3">
                                        <h2>Настройки</h2>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="f_group">
                                        <label for="">Фамилия</label>
                                        <input name="family" type="text" placeholder="Введите фамилию" required value="<?= $model->family ?>">
                                    </div>
                                    <?= $model->errorField('family') ?>
                                </div>
                                <div class="col-md-4">
                                    <div class="f_group">
                                        <label for="">Имя</label>
                                        <input name="firstname" type="text" placeholder="Введите имя" required value="<?= $model->firstname ?>">
                                    </div>
                                    <?= $model->errorField('firstname') ?>
                                </div>
                                <div class="col-md-4">
                                    <div class="f_group">
                                        <label for="">Отчество</label>
                                        <input name="lastname" type="text" placeholder="Введите отчество" required value="<?= $model->lastname ?>">
                                    </div>
                                    <?= $model->errorField('lastname') ?>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="f_group">
                                        <label for="">Электронная почта</label>
                                        <input name="email" type="text" placeholder="Введите e-mail" required value="<?= $model->email ?>">
                                    </div>
                                    <?= $model->errorField('email') ?>
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
                                        <input name="phone" type="text" value="<?= $model->phone ?>">
                                    </div>
                                    <?= $model->errorField('phone') ?>
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
                                            <option value="">Выберите город</option>
                                            <?php foreach($cities as $city): ?>
                                                <option value="<?= $city['id'] ?>"<?= $model->city == $city['id'] ? " selected" : "" ?>><?= $city['name'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <?= $model->errorField('city') ?>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="f_group">
                                        <label for="">Дата рождения </label>
                                        <select name="birthday[day]">
                                            <option value="0" <?= !$model->birthday ? " selected" : "" ?>>-</option>
                                            <?php for($day = 1; $day <= 31 ; $day++): ?>
                                                <option value="<?= $day ?>"<?= ( $model->birthday && $model->birthday->format("j") == $day ) ? " selected" : "" ?>><?= $day ?></option>
                                            <?php endfor; ?>
                                        </select>
                                    </div>

                                </div>
                                <div class="col-md-2">
                                    <div class="f_group">
                                        <label for=""> Месяц</label>
                                        <select name="birthday[month]">
                                            <option value="0" <?= !$model->birthday ? " selected" : "" ?>>-</option>
                                            <?php for($month = 1; $month <= 12 ; $month++): ?>
                                                <option value="<?= $month ?>"<?= ( $model->birthday && $model->birthday->format("n") == $month ) ? " selected" : "" ?>><?= $month ?></option>
                                            <?php endfor; ?>
                                        </select>
                                    </div>

                                </div>
                                <div class="col-md-2">
                                    <div class="f_group">
                                        <label for=""> </label>
                                        <select name="birthday[year]">
                                            <option value="0" <?= !$model->birthday ? " selected" : "" ?>>-</option>
                                            <?php for($year = 2001; $year >= 1930 ; $year--): ?>
                                                <option value="<?= $year ?>"<?= ( $model->birthday && $model->birthday->format('Y') == $year ) ? " selected" : "" ?>><?= $year ?></option>
                                            <?php endfor; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="f_group">
                                        <label for="">Пол </label>
                                        <ul class="ulli">
                                            <input type="hidden" name="gender" value="<?= $model->gender ?>">
                                            <li><a id="gender-man" href=""><img src="<?= $model->gender == 1 ? Url::to('@web/img/icons/man-active.png') : Url::to('@web/img/icons/man.png') ?>" alt=""></a></li>
                                            <li><a id="gender-woman" href=""><img src="<?= $model->gender == 2 ? Url::to('@web/img/icons/woman-active.png') : Url::to('@web/img/icons/woman.png') ?>" alt=""></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <?= $model->errorField('birthday') ?>

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
                                        <input name="password" type="password">
                                    </div>
                                    <?= $model->errorField('password') ?>
                                </div>
                                <div class="col-md-6">
                                    <div class="f_group">
                                        <label for=""> Повторите пароль  </label>
                                        <input name="confirm" type="password">
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




                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="button button_orange button_top_img">Сохранить</button>
                                </div>
                            </div>


                        </div>
                        </form>
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
    $('input[name=gender]').val(2);
});
$('.ulli a').click(function(e){
    e.preventDefault();
});


JS;

// плагин мешает Selenium тестировать поле
if(!YII_ENV_TEST){
    $script .= <<< JS
$('input[name=phone]').inputmask("+9 (999) 999-99-99");
JS;
}


$this->registerJs($script);