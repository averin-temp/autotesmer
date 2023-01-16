<?php

/** @var $model \frontend\models\ExpertRegistration */
/** @var $this \yii\web\View */

use yii\helpers\Url;
use yii\web\View;
use common\models\City;
use frontend\assets\InputmaskAsset;

InputmaskAsset::register($this);

?>
<main>
    <div class="container">
        <div class="reg_exp_page">
            <div class="row">
                <div class="col-md-12">
                    <div class="reg_top_string clearfix active_2">
                        <div class="reg_top_string_item reg_top_string_item_1">
                            <span>Преимущества сервиса</span></div>
                        <div class="reg_top_string_item reg_top_string_item_2">
                            <span>Создание учетной записи</span></div>
                        <div class="reg_top_string_item reg_top_string_item_3"><span>Подтверждение регистрации</span>
                        </div>
                    </div>
                </div>
            </div>

            <?= \frontend\widgets\SocialRegistrationWidget::widget(['userType' => 2 ]) ?>

            <div class="reg_exp_page_2">
                <div class="row">
                    <div class="col-md-12">
                        <div class="reg_exp_page_2_1">
                            Выполнять задания Autotesmer могут только эксперты, которые прошли процедуру
                            верификации.<br>
                            Мы оставляем за собой право отказать в присвоении статуса эксперта без объяснения причин.
                        </div>
                    </div>
                </div>
            </div>
            <div class="reg_exp_page_3">
                <h2>Личные данные</h2>
            </div>
            <div class="reg_exp_page_4">
                <form id="expert-registration-form" action="<?= Url::to(['/registration/step2']) ?>" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="f_group">
                                <label for="inputFamily">Фамилия</label>
                                <input name="family" id="inputFamily" type="text" placeholder="Введите фамилию" required value="<?= $model->family ?>">
                            </div>
                            <?php $model->errorField('family'); ?>
                        </div>
                        <div class="col-md-4">
                            <div class="f_group">
                                <label for="inputFirstname">Имя</label>
                                <input name="firstname" id="firstname" type="text" placeholder="Введите имя" required value="<?= $model->firstname ?>">
                            </div>
                            <?php $model->errorField('firstname'); ?>
                        </div>
                        <div class="col-md-4">
                            <div class="f_group">
                                <label for="inputLastname">Отчество</label>
                                <input name="lastname" id="lastname" type="text" placeholder="Введите отчество" required value="<?= $model->lastname ?>">
                            </div>
                            <?php $model->errorField('lastname'); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="f_group">
                                <label for="inputEmail">Электронная почта</label>
                                <input name="email" id="inputEmail" type="text" placeholder="Введите e-mail" required value="<?= $model->email ?>">
                            </div>
                            <?php $model->errorField('email'); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="f_group">
                                <label for="inputCity">Город</label>
                                <select name="city" id="inputCity">
                                    <?php foreach(City::find()->orderBy('name')->all() as $city) {
                                        $selected = $model->city == $city->id ? "selected" : '';
                                        echo "<option value=\"$city->id\" $selected>$city->name</option>";
                                    } ?>
                                </select>
                            </div>
                            <?php $model->errorField('city'); ?>
                        </div>
                        <div class="col-md-2">
                            <div class="f_group">
                                <label for="day">Дата рождения</label>
                                <select name="day" id="day">
                                    <?php for($i = 1; $i <= 31; $i++) {
                                        $selected = $model->day == $i ? "selected" : '';
                                        echo "<option value='$i' $selected>$i</option>";
                                    } ?>
                                </select>
                            </div>
                            <?php $model->errorField('day'); ?>
                        </div>
                        <div class="col-md-2">
                            <div class="f_group">
                                <label for="month"></label>
                                <select name="month" id="month">
                                    <?php for($i = 1; $i <= 12; $i++) {
                                        $selected = $model->month == $i ? "selected" : '';
                                        echo "<option value='$i' $selected>$i</option>";
                                    } ?>
                                </select>
                            </div>
                            <?php $model->errorField('month'); ?>
                        </div>
                        <div class="col-md-2">
                            <div class="f_group">
                                <label for="year"></label>
                                <select name="year" id="year">
                                    <?php for($i = 2010; $i >= 1910; $i--) {
                                        $selected = $model->year == $i ? "selected" : '';
                                        echo "<option value='$i' $selected>$i</option>";
                                    } ?>
                                </select>
                            </div>
                            <?php $model->errorField('year'); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="f_group">
                                <label for="inputPassword">Пароль</label>
                                <input name="password" type="password" id="inputPassword" placeholder="пароль" required value="<?= $model->password ?>">
                            </div>
                            <?php $model->errorField('password'); ?>
                        </div>
                        <div class="col-md-4">
                            <div class="f_group">
                                <label for="inputConfirm">Подтвреждение</label>
                                <input name="confirm" type="password" id="inputConfirm" placeholder="подтверждение" required value="<?= $model->confirm ?>">
                            </div>
                            <?php $model->errorField('confirm'); ?>
                        </div>
                        <div class="col-md-4">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="f_group">
                                <label for="">Фотография</label>
                                <div class="f_group_12_upl clearfix">
                                    <div class="f_group_12_upl_test f_group_12_upl_test_1">
                                        <label for="image">
                                            <img  id="preview" src="<?= Url::to('@web/img/icons/steps/upload.png') ?>" alt="">
                                            <input type="file" name="image" id="image">
                                        </label>
                                    </div>
                                    <div class="f_group_12_upl_test f_group_12_upl_test_2">
                                        <div>Загрузите вашу фотографию </div>
                                        <div>(Хорошее качество, лицо крупным планом. Минимальный размер: 180×180 px)<br>
                                            Профили без фото отклоняются во время проверки данных.</div>
                                    </div>
                                </div>
                            </div>
                            <?php $model->errorField('image'); ?>

                        </div>
                    </div>

                    <div class="rdevid"></div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="reg_exp_page_3">
                                <!--h2>Подтверждение номера телефона</h2-->
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="f_group">
                                <label for="">Телефон</label>
                                <input type="text" name="phone" data-mask="" data-inputmask="&quot;mask&quot;: &quot;9 - (999) 999-9999&quot;"  required value="<?= \common\classes\DataHelper::prettyPhone($model->phone) ?>">
                            </div>
                            <?php $model->errorField('phone'); ?>
                        </div>
                        <div class="col-md-8">
                            <div class="f_group glinka">
                                <!--a href="##">Подтвердить номер</a-->
                            </div>
                        </div>
                    </div>

                    <div class="rdevid"></div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="reg_exp_page_3">
                                <h2>Дополнительные сведения</h2>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="reg_exp_page_333">
                                <h3>Выберите категории в которых вы готовы работать</h3>
                            </div>
                            <div class="reg_exp_page_3332 ccheck">
                                <div class="custom-control custom-checkbox">
                                    <input type="hidden" name="category_auto" value="0" >
                                    <input type="checkbox" class="custom-control-input" name="category_auto" value="1" id="category_auto"<?= $model->category_auto ? ' checked' : '' ?>>
                                    <label class="custom-control-label" for="category_auto">Легковая</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="hidden" name="category_freight" value="0" >
                                    <input type="checkbox" class="custom-control-input" name="category_freight" value="1"
                                           id="category_freight"<?= $model->category_freight ? ' checked' : '' ?>>
                                    <label class="custom-control-label" for="category_freight">Грузовая</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="hidden" name="category_commerce" value="0" >
                                    <input type="checkbox" class="custom-control-input" name="category_commerce" value="1"
                                           id="category_commerce"<?= $model->category_commerce ? ' checked' : '' ?>>
                                    <label class="custom-control-label" for="category_commerce">Коммерческий транспорт</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="hidden" name="category_moto" value="0" >
                                    <input type="checkbox" class="custom-control-input" name="category_moto" value="1"
                                           id="category_moto"<?= $model->category_moto ? ' checked' : '' ?>>
                                    <label class="custom-control-label" for="category_moto">Мото</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="hidden" name="category_water" value="0" >
                                    <input type="checkbox" class="custom-control-input" name="category_water" value="1"
                                           id="category_water"<?= $model->category_water ? ' checked' : '' ?>>
                                    <label class="custom-control-label" for="category_water">Водный транспорт</label>
                                </div>

                                <?php $model->errorField('category_auto'); ?>


                            </div>
                            <div class="reg_exp_page_333 reg_exp_page_3332">
                                <h3>Владеете ли вы ИП?</h3>
                            </div>
                            <div class="reg_exp_page_3332 ccheck">
                                <div class="custom-control custom-checkbox">
                                    <input type="hidden" name="has_ip" value="0" >
                                    <input type="checkbox" class="custom-control-input" name="has_ip" id="has_ip" <?= $model->has_ip ? ' checked' : '' ?> value="1">
                                    <label class="custom-control-label" for="has_ip">У меня есть ИП</label>
                                </div>

                            </div>
                            <div class="reg_exp_page_333 reg_exp_page_3332">
                                <h3>Владеете ли вы юридическим лицом?</h3>
                            </div>
                            <div class="reg_exp_page_3332 ccheck">
                                <div class="custom-control custom-checkbox">
                                    <input type="hidden" name="has_ul" value="0" >
                                    <input type="checkbox" class="custom-control-input" name="has_ul" id="has_ul" <?= $model->has_ul ? ' checked' : '' ?> value="1" >
                                    <label class="custom-control-label" for="has_ul">У меня есть ЮЛ</label>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="rdevid"></div>
                    <div class="reg_exp_page_3332 ccheck">
                        <div class="custom-control custom-checkbox">
                            <input type="hidden" name="first_time_verification" value="0" >
                            <input type="checkbox" class="custom-control-input" name="first_time_verification" id="first_time_verification"<?= $model->first_time_verification ? ' checked' : '' ?> value="1">
                            <label class="custom-control-label" for="first_time_verification">Подтверждаю, что я прохожу верификацию Autotesmer впервые</label>
                        </div>

                        <?php if($model->hasErrors('first_time_verification')): ?>
                            <div class="custom-control custom-error">
                                <?= $model->getFirstError('first_time_verification') ?>
                            </div>
                        <?php endif; ?>




                        <div class="custom-control custom-checkbox">
                            <input type="hidden" name="data_authentic" value="0" >
                            <input type="checkbox" class="custom-control-input" name="data_authentic" id="data_authentic"<?= $model->data_authentic ? ' checked' : '' ?> value="1">
                            <label class="custom-control-label" for="data_authentic">Подтверждаю, что я указал свои личные данные достоверно</label>
                        </div>

                        <?php if($model->hasErrors('data_authentic')): ?>
                            <div class="custom-control custom-error">
                                <?= $model->getFirstError('data_authentic') ?>
                            </div>
                        <?php endif; ?>

                        <div class="custom-control custom-checkbox">
                            <input type="hidden" name="personal_data_processing_agree" value="0" >
                            <input type="checkbox" class="custom-control-input" name="personal_data_processing_agree" id="personal_data_processing_agree"<?= $model->personal_data_processing_agree ? ' checked' : '' ?> value="1">
                            <label class="custom-control-label" for="personal_data_processing_agree">Я согласен с соглашением на обработку персональных данных</label>
                        </div>

                        <?php if($model->hasErrors('personal_data_processing_agree')): ?>
                            <div class="custom-control custom-error">
                                <?= $model->getFirstError('personal_data_processing_agree') ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <br><br>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mp_main_bot">
                                <button class="button button_orange button_top_img">Зарегистрироваться</button>
                            </div>
                        </div>
                    </div>

                    <br>



                </form>
            </div>
        </div>

    </div>
</main>

<?php

$script = <<< JS

$('#image').change(function(){
    var reader = new FileReader();

    reader.onload = function(e) {
      $('#preview').attr('src', e.target.result);
      $('#preview').css('display', 'block');
    }

    reader.readAsDataURL($(this).get(0).files[0]);
});
JS;


if(!YII_ENV_TEST)
{
    $script .= '$("[data-mask]").inputmask()';
}

$this->registerJs($script,View::POS_READY, 'preview-script');