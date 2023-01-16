<?php

/** @var $this \yii\web\View */
/** @var $model \common\models\ReportAuto */
/** @var $vehicleBrands array */
/** @var $vehicleBodies array */

use frontend\assets\ReportAsset;

ReportAsset::register($this);
?>
<main>
    <form id="report-form" action="<?= \yii\helpers\Url::to(['report/send']) ?>" enctype="multipart/form-data" method="post">
        <input name="chat_id" type="hidden" value="<?= $model->chat_id ?>">
        <input name="category" type="hidden" value="<?= $model->category ?>">
        <div class="report container">

            <div class="row">
                <div class="col-md-12">
                    <div class="breads_wrapper dark">
                        <ul>
                            <li><a href="/">Главная</a></li>
                            <li><span>&gt;</span></li>
                            <li><span>Отчет авто</span></li>
                        </ul>
                    </div>
                </div>
            </div>


            <div class="report-progress-bar">
                <div class="report-progress progress-12">
                    12.5 %
                </div>
            </div>


            <div class="report-form">

                <div class="stage" id="stage-1" data-stage="1" data-progress="12.5" data-valid="0">

                    <div class="report-head row">
                        <div class="col-md-6">
                            <h1>Кузов</h1>
                        </div>
                        <div class="col-md-6">
                            <div class="report-buttons">
                                <!--span class="report-save">сохранить</span>
                                <span class="report-edit">редактировать</span-->
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-4">
                            <div class="f_group">
                                <label for="selectYear">Год *</label>
                                <select id="selectYear" name="year" class="form-control">
                                    <option value=""<?= $model->year == 0 ? ' selected' : '' ?>>Выберите год</option>
                                    <?php for($year = 1980; $year < 2020; $year++): ?>
                                    <option value="<?= $year ?>"<?= $model->year == $year ? ' selected' : '' ?>><?= $year ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="f_group">
                                <label for="selectBrand">Марка *</label>
                                <select id="selectBrand" name="brand" class="form-control">
                                    <option selected value="">Выберите марку</option>
                                    <?php foreach($model->getBrands() as $brand): ?>
                                    <option value="<?= $brand->id ?>"><?= $brand->name ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="f_group">
                                <label for="selectModel">Модель *</label>
                                <select id="selectModel" name="model" class="form-control">
                                    <option value="" selected>Выберите марку</option>
                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-6">
                            <div class="f_group">
                                <label for="inputVin">VIN *</label>
                                <input id="inputVin" name="vin" type="text" placeholder="Введите VIN" >
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="f_group">
                                <label for="selectBody">Тип кузова</label>
                                <select id="selectBody" name="body" class="form-control">
                                    <option value=""<?= $model->body ? '' : ' selected' ?>>Выберите тип кузова</option>
                                    <?php foreach($model->getBodies() as $index => $name): ?>
                                        <option value="<?= $index ?>"<?= $model->body == $index ? ' selected' : '' ?>><?= $name ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="f_group">
                                <label for="inputDoorsNumber">Количество дверей</label>
                                <input id="inputDoorsNumber" name="doors_number" type="text" placeholder="Количество дверей">
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="f_group">
                                <label for="selectDrives">Привод</label>
                                <select id="selectDrives" name="drive" class="form-control">
                                    <option value=""<?= $model->drive ? '' : ' selected' ?>>Выберите тип привода</option>
                                    <?php foreach($model->getDrives() as $index => $name) : ?>
                                    <option value="<?= $index ?>"<?= $model->drive == $index ? ' selected' : '' ?>><?= $name ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="f_group">
                                <label for="selectAge">Возраст ТС</label>
                                <select id="selectAge" name="age" class="form-control">
                                    <option value=""<?= $model->age == 0 ? '' : ' selected' ?>>Возраст ТС</option>
                                    <?php for($i = 1; $i < 100; $i++) : ?>
                                        <option value="<?= $i ?>"<?= $model->age == $i ? ' selected' : '' ?>><?= $i ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="f_group">
                                <label for="selectVendorCountry">Страна производства</label>
                                <select id="selectVendorCountry" name="vendor_country" class="form-control">
                                    <option value=""<?= $model->vendor_country ? '' : ' selected' ?>>Выберите страну</option>
                                    <?php foreach($model->getCountries() as $country) : ?>
                                    <option value="<?= $country->id ?>"<?= $model->drive == $country->id ? ' selected' : '' ?>><?= $country->name ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="f_group">
                                <label for="selectOwnerCount">Количество владельцев</label>
                                <select id="selectOwnerCount" name="owner_count" class="form-control">
                                    <?php for($i = 0; $i < 10; $i++) : ?>
                                        <option value="<?= $i ?>"<?= $model->owner_count == $i ? ' selected' : '' ?>><?= $i ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="upload-photo-block">
                        <label>Фотография</label>
                        <div>
                            <div class="upload-photo">
                                <label>
                                    <input type="file" name="photo">
                                </label>
                            </div>
                            <div class="upload-text">
                                <span>Загрузите фотографию</span>
                                <p>
                                    Далеко-далеко за словесными горами в стране гласных и согласных живут рыбные тексты.
                                    Вдали от всех живут они в буквенных домах на берегу Семантика большого языкового океана.
                                    Маленький ручеек
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8 offset-md-2">
                            <div class="f_group enterbut">
                                <a class="button button_orange button_top_img report-next" href="#stage-2">ДАЛЬШЕ</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="stage" id="stage-2" data-stage="2" data-progress="25"  data-valid="0">


                    <div class="report-head row">
                        <div class="col-md-6">
                            <h1>Проверка автомобиля по базам</h1>
                        </div>
                        <div class="col-md-6">
                            <div class="report-buttons">
                                <!--span class="report-save">сохранить</span>
                                <span class="report-edit">редактировать</span-->
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="f_group stage2-field">
                                <label for="textareaTrafficAccidents">ДТП</label>
                                <textarea id="textareaTrafficAccidents" name="traffic_accidents"  cols="30" rows="10" placeholder="Введите текст"></textarea>
                                <label for="traffic_accidents_photo" class="attach-file">
                                    <div class="icon-attach-file"></div>
                                    <span>Прикрепить файл</span>
                                    <input id="traffic_accidents_photo" name="traffic_accidents_photo" type="file">
                                </label>
                            </div>
                        </div>

                    </div>


                    <div class="row">
                        <div class="col-md-12">
                            <div class="f_group stage2-field">
                                <label for="textareaInspectionRecords">Записи о ТО</label>
                                <textarea id="textareaInspectionRecords" name="inspection_records" cols="30" rows="10" placeholder="Введите текст"></textarea>
                                <label for="traffic_inspection_photo" class="attach-file">
                                    <div class="icon-attach-file"></div>
                                    <span>Прикрепить файл</span>
                                    <input id="traffic_inspection_photo" name="traffic_inspection_photo" type="file">
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="f_group stage2-field">
                                <label for="textareaPersonalVehicle">Частное ТС</label>
                                <textarea id="textareaPersonalVehicle" name="personal_vehicle" cols="30" rows="10" placeholder="Введите текст"></textarea>
                                <label for="personal_vehicle_photo" class="attach-file">
                                    <div class="icon-attach-file"></div>
                                    <span>Прикрепить файл</span>
                                    <input id="personal_vehicle_photo" name="personal_vehicle_photo" type="file">
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="f_group stage2-field">
                                <label for="textareaOdometerReadings">Показания одометра</label>
                                <textarea id="textareaOdometerReadings" name="odometer_readings" cols="30" rows="10" placeholder="Введите текст"></textarea>
                                <label for="odometer_readings_photo" class="attach-file">
                                    <div class="icon-attach-file"></div>
                                    <span>Прикрепить файл</span>
                                    <input id="odometer_readings_photo" name="odometer_readings_photo" type="file">
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="f_group stage2-field">
                                <label for="textareaTrafficAccidents_1">ДТП *</label>
                                <textarea id="textareaTrafficAccidents_1" name="traffic_accidents_info_1" cols="30" rows="10" placeholder="Введите текст"></textarea>
                                <label for="traffic_accidents_photo_1" class="attach-file">
                                    <div class="icon-attach-file"></div>
                                    <span>Прикрепить файл</span>
                                    <input id="traffic_accidents_photo_1" name="traffic_accidents_photo_1" type="file">
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="f_group stage2-field">
                                <label for="textareaTrafficAccidents_2">ДТП *</label>
                                <textarea id="textareaTrafficAccidents_2" name="traffic_accidents_info_2" cols="30" rows="10" placeholder="Введите текст"></textarea>
                                <label for="traffic_accidents_photo_2" class="attach-file">
                                    <div class="icon-attach-file"></div>
                                    <span>Прикрепить файл</span>
                                    <input id="traffic_accidents_photo_2" name="traffic_accidents_photo_2" type="file">
                                </label>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-8 offset-md-2">
                            <div class="f_group enterbut">
                                <a class="button button_orange button_top_img report-prev" href="#stage-1">НАЗАД</a>
                                <a class="button button_orange button_top_img report-next" href="#stage-3">ДАЛЬШЕ</a>

                            </div>
                        </div>
                    </div>

                </div>
                <div class="stage" id="stage-3" data-stage="3" data-progress="37.5"  data-valid="0">
                    <div class="report-head row">
                        <div class="col-md-6">
                            <h1>Кузов</h1>
                        </div>
                        <div class="col-md-6">
                            <div class="report-buttons">
                                <!--span class="report-save">сохранить</span>
                                <span class="report-edit">редактировать</span-->
                            </div>
                        </div>

                    </div>


                    <div class="row fieldgroup">
                        <div class="col-xl-4">
                            <div class="left-preview">
                                <span>Лево</span>
                                <div class="img-left-preview" id="i1-1" data-standartimg="/img/report-car/img/1.jpg"></div>
                                <div class="img-top-preview"></div>
                            </div>
                        </div>
                        <div class="col-xl-8"><!-- колонки с параметрами -->
                            <div class="row">
                                <div class="col-md-6">
                                    <!-- левая колонка -->
                                    <div data-imgid="i1-1" data-imgsrc="/img/report-car/img/1.jpg"  class="report-field">
                                        <div class="report-field-main">
                                            <label for="inputLeftHeadlight">Фара</label>
                                            <div class="report-field-points">
                                                <input id="inputLeftHeadlight" name="left_headlight" type="text" value="5 Баллов">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button">
                                                    <label>
                                                        <input name="left_headlight_phone" type="file">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="left_headlight_comment" id="" cols="30" rows="10"></textarea>
                                        </div>

                                    </div>

                                    <div data-imgid="i1-1" data-imgsrc="/img/report-car/img/2.jpg" class="report-field">
                                        <div class="report-field-main">
                                            <label for="inputLeftFogLights">ПТФ</label>
                                            <div class="report-field-points">
                                                <input id="inputLeftFogLights" name="left_fog_lights" type="text" value="5 Баллов">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"><label>
                                                        <input name="left_fog_lights_photo" type="file">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="left_fog_lights_comment" id="" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>

                                    <div data-imgid="i1-1" data-imgsrc="/img/report-car/img/3.jpg" class="report-field">
                                        <div class="report-field-main">
                                            <label for="inputLeftFrontWing">Крыло пер.</label>
                                            <div class="report-field-points">
                                                <input id="inputLeftFrontWing" name="left_front_wing" type="text" value="5 Баллов">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button">
                                                    <label>
                                                        <input name="left_front_wing_photo" type="file">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="left_front_wing_comment" id="" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>


                                    <div data-imgid="i1-1" data-imgsrc="/img/report-car/img/4.jpg" class="report-field">
                                        <div class="report-field-main">
                                            <label for="inputLeftBackWing">Крыло задн.</label>
                                            <div class="report-field-points">
                                                <input id="inputLeftBackWing" name="left_back_wing" type="text" value="5 Баллов">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button">
                                                    <label>
                                                        <input name="left_back_wing_photo" type="file">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="left_back_wing_comment" id="" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>


                                    <div data-imgid="i1-1" data-imgsrc="/img/report-car/img/5.jpg" class="report-field">
                                        <div class="report-field-main">
                                            <label for="inputLeftMirror">Зеркало</label>
                                            <div class="report-field-points">
                                                <input id="inputLeftMirror" name="left_mirror" type="text" value="5 Баллов">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button">
                                                    <label>
                                                        <input name="left_mirror_photo" type="file">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="left_mirror_comment" id="" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>

                                    <div  data-imgid="i1-1" data-imgsrc="/img/report-car/img/6.jpg" class="report-field">
                                        <div class="report-field-main">
                                            <label for="inputLeftFrontWheels">Диск пер.</label>
                                            <div class="report-field-points">
                                                <input id="inputLeftFrontWheels" name="left_front_wheels" type="text" value="5 Баллов">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button">
                                                    <label>
                                                        <input name="left_front_wheels_photo" type="file">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="left_front_wheels_comment" id="" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>


                                    <div data-imgid="i1-1" data-imgsrc="/img/report-car/img/7.jpg"  class="report-field">
                                        <div class="report-field-main">
                                            <label for="inputLeftBackWheels">Диск задн.</label>
                                            <div class="report-field-points">
                                                <input id="inputLeftBackWheels" name="left_back_wheels" type="text" value="5 Баллов">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button">
                                                    <label>
                                                        <input name="left_back_wheels_photo" type="file">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="left_back_wheels_comment" id="" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>

                                    <div data-imgid="i1-1" data-imgsrc="/img/report-car/img/8.jpg"  class="report-field">
                                        <div class="report-field-main">
                                            <label for="inputLeftFrontBrakeDisc">Тормозной диск пер.</label>
                                            <div class="report-field-points">
                                                <input id="inputLeftFrontBrakeDisc" name="left_front_brake_disc" type="text" value="5 Баллов">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button">
                                                    <label>
                                                        <input name="left_front_brake_disc_photo" type="file">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="left_front_brake_disc_comment" id="" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>


                                    <div data-imgid="i1-1" data-imgsrc="/img/report-car/img/9.jpg"  class="report-field">
                                        <div class="report-field-main">
                                            <label for="inputLeftBackBrakeDisc">Тормозной диск задн.</label>
                                            <div class="report-field-points">
                                                <input id="inputLeftBackBrakeDisc" name="left_back_brake_disc" type="text" value="5 Баллов">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button">
                                                    <label>
                                                        <input name="left_back_brake_disc_photo" type="file">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="left_back_brake_disc_comment" id="" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>

                                    <!-- /левая колонка -->
                                </div>
                                <div class="col-md-6">
                                    <!-- правая колонка -->

                                    <div data-imgid="i1-1" data-imgsrc="/img/report-car/img/10.jpg"  class="report-field">
                                        <div class="report-field-main">
                                            <label for="inputLeftFrontPads">Колодки пер.</label>
                                            <div class="report-field-points">
                                                <input id="inputLeftFrontPads" name="left_front_pads" type="text" value="5 Баллов">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button">
                                                    <label>
                                                        <input name="left_front_pads_photo" type="file">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="left_front_pads_comment" id="" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>

                                    <div data-imgid="i1-1" data-imgsrc="/img/report-car/img/11.jpg"  class="report-field">
                                        <div class="report-field-main">
                                            <label for="inputLeftBackPads">Колодки задн.</label>
                                            <div class="report-field-points">
                                                <input id="inputLeftBackPads" name="left_back_pads" type="text" value="5 Баллов">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"><label><input name="left_back_pads_photo" type="file">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="left_back_pads_comment" id="" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>

                                    <div data-imgid="i1-1" data-imgsrc="/img/report-car/img/12.jpg"  class="report-field">
                                        <div class="report-field-main">
                                            <label for="inputLeftFrontTire">Шина пер.</label>
                                            <div class="report-field-points">
                                                <input id="inputLeftFrontTire" name="left_front_tire" type="text" value="5 Баллов">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"><label><input name="left_front_tire_photo" type="file">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="left_front_tire_comment" id="" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>

                                    <div data-imgid="i1-1" data-imgsrc="/img/report-car/img/13.jpg"  class="report-field">
                                        <div class="report-field-main">
                                            <label for="inputLeftBackTire">Шина задн.</label>
                                            <div class="report-field-points">
                                                <input id="inputLeftBackTire" name="left_back_tire" type="text" value="5 Баллов">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"><label><input name="left_back_tire_photo" type="file">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="left_back_tire_comment" id="" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>

                                    <div data-imgid="i1-1" data-imgsrc="/img/report-car/img/14.jpg"  class="report-field">
                                        <div class="report-field-main">
                                            <label for="inputLeftThreshold">Порог</label>
                                            <div class="report-field-points">
                                                <input id="inputLeftThreshold" name="left_threshold" type="text" value="5 Баллов">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"><label><input name="left_threshold_photo" type="file">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="left_threshold_comment" id="" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>

                                    <div data-imgid="i1-1" data-imgsrc="/img/report-car/img/15.jpg"  class="report-field">
                                        <div class="report-field-main">
                                            <label for="inputLeftFrontDoor">Дверь пер.</label>
                                            <div class="report-field-points">
                                                <input id="inputLeftFrontDoor" name="left_front_door" type="text" value="5 Баллов">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"><label><input name="left_front_door_photo" type="file">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="left_front_door_comment" id="" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>

                                    <div data-imgid="i1-1" data-imgsrc="/img/report-car/img/16.jpg"  class="report-field">
                                        <div class="report-field-main">
                                            <label for="inputLeftBackDoor">Дверь задн.</label>
                                            <div class="report-field-points">
                                                <input id="inputLeftBackDoor" name="left_back_door" type="text" value="5 Баллов">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"><label><input name="left_back_door_photo" type="file">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="left_back_door_comment" id="" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>

                                    <div data-imgid="i1-1" data-imgsrc="/img/report-car/img/17.jpg"  class="report-field">
                                        <div class="report-field-main">
                                            <label for="inputLeftBackLamp">Фонарь задн.</label>
                                            <div class="report-field-points">
                                                <input id="inputLeftBackLamp" name="left_back_lamp" type="text" value="5 Баллов">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"><label><input name="left_back_lamp_photo" type="file">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="left_back_lamp_comment" id="" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>

                                    <div  data-imgid="i1-1" data-imgsrc="/img/report-car/img/18.jpg"  class="report-field">
                                        <div class="report-field-main">
                                            <label for="inputRoofWithRacks">Крыша со стойками</label>
                                            <div class="report-field-points">
                                                <input id="inputRoofWithRacks" name="roof_with_racks" type="text" value="5 Баллов">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"><label><input name="roof_with_racks_photo" type="file">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="roof_with_racks_comment" id="" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>


                                    <!-- /правая колонка -->
                                </div>

                            </div>
                        </div>
                    </div>


                    <div class="row fieldgroup">
                        <div class="col-xl-4">
                            <div class="left-preview">
                                <span>Право</span>
                                <div  id="i2-1" data-standartimg="/img/report-car/img/21.jpg" class="img-right-preview"></div>
                            </div>
                        </div>
                        <div class="col-xl-8"><!-- колонки с параметрами -->
                            <div class="row">
                                <div class="col-md-6">
                                    <!-- левая колонка -->
                                    <div  data-imgid="i2-1" data-imgsrc="/img/report-car/img/21.jpg" class="report-field">
                                        <div class="report-field-main">
                                            <label for="inputRightHeadlight">Фара</label>
                                            <div class="report-field-points">
                                                <input id="inputRightHeadlight" name="right_headlight" type="text" value="5 Баллов">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"><label><input name="right_headlight_photo" type="file">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="right_headlight_comment" id="" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>

                                    <div  data-imgid="i2-1" data-imgsrc="/img/report-car/img/22.jpg" class="report-field">
                                        <div class="report-field-main">
                                            <label for="inputRightFogLights">ПТФ</label>
                                            <div class="report-field-points">
                                                <input id="inputRightFogLights" name="right_fog_lights" type="text" value="5 Баллов">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"><label><input name="right_fog_lights_photo" type="file">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="right_fog_lights_comment" id="" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>

                                    <div  data-imgid="i2-1" data-imgsrc="/img/report-car/img/23.jpg" class="report-field">
                                        <div class="report-field-main">
                                            <label for="inputrightFrontWing">Крыло пер.</label>
                                            <div class="report-field-points">
                                                <input id="inputrightFrontWing" name="right_front_wing" type="text" value="5 Баллов">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"><label><input name="right_front_wing_photo" type="file">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="right_front_wing_comment" id="" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>


                                    <div  data-imgid="i2-1" data-imgsrc="/img/report-car/img/24.jpg" class="report-field">
                                        <div class="report-field-main">
                                            <label for="inputrightBackWing">Крыло задн.</label>
                                            <div class="report-field-points">
                                                <input id="inputrightBackWing" name="right_back_wing" type="text" value="5 Баллов">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"><label><input name="right_back_wing_photo" type="file">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="right_back_wing_comment" id="" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>


                                    <div  data-imgid="i2-1" data-imgsrc="/img/report-car/img/25.jpg" class="report-field">
                                        <div class="report-field-main">
                                            <label for="inputrightMirror">Зеркало</label>
                                            <div class="report-field-points">
                                                <input id="inputrightMirror" name="right_mirror" type="text" value="5 Баллов">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"><label><input name="right_mirror_photo" type="file">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="right_mirror_comment" id="" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>

                                    <div  data-imgid="i2-1" data-imgsrc="/img/report-car/img/26.jpg" class="report-field">
                                        <div class="report-field-main">
                                            <label for="inputrightFrontWheels">Диск пер.</label>
                                            <div class="report-field-points">
                                                <input id="inputrightFrontWheels" name="right_front_wheels" type="text" value="5 Баллов">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"><label><input name="right_front_wheels_photo" type="file">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="right_front_wheels_comment" id="" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>


                                    <div  data-imgid="i2-1" data-imgsrc="/img/report-car/img/27.jpg" class="report-field">
                                        <div class="report-field-main">
                                            <label for="inputrightBackWheels">Диск задн.</label>
                                            <div class="report-field-points">
                                                <input id="inputrightBackWheels" name="right_back_wheels" type="text" value="5 Баллов">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"><label><input name="right_back_wheels_photo" type="file">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="right_back_wheels_comment" id="" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>

                                    <div  data-imgid="i2-1" data-imgsrc="/img/report-car/img/28.jpg" class="report-field">
                                        <div class="report-field-main">
                                            <label for="inputrightFrontBrakeDisc">Тормозной диск пер.</label>
                                            <div class="report-field-points">
                                                <input id="inputrightFrontBrakeDisc" name="right_front_brake_disc" type="text" value="5 Баллов">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"><label><input name="right_front_brake_disc_photo" type="file">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="right_front_brake_disc_comment" id="" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>


                                    <div  data-imgid="i2-1" data-imgsrc="/img/report-car/img/29.jpg" class="report-field">
                                        <div class="report-field-main">
                                            <label for="inputrightBackBrakeDisc">Тормозной диск задн.</label>
                                            <div class="report-field-points">
                                                <input id="inputrightBackBrakeDisc" name="right_back_brake_disc" type="text" value="5 Баллов">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"><label><input name="right_back_brake_disc_photo" type="file">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="right_back_brake_disc_comment" id="" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>

                                    <!-- /левая колонка -->
                                </div>
                                <div class="col-md-6">
                                    <!-- правая колонка -->

                                    <div data-imgid="i2-1" data-imgsrc="/img/report-car/img/30.jpg" class="report-field">
                                        <div class="report-field-main">
                                            <label for="inputrightFrontPads">Колодки пер.</label>
                                            <div class="report-field-points">
                                                <input id="inputrightFrontPads" name="right_front_pads" type="text" value="5 Баллов">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"><label><input name="right_front_pads_photo" type="file">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="right_front_pads_comment" id="" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>

                                    <div data-imgid="i2-1" data-imgsrc="/img/report-car/img/31.jpg" class="report-field">
                                        <div class="report-field-main">
                                            <label for="inputrightBackPads">Колодки задн.</label>
                                            <div class="report-field-points">
                                                <input id="inputrightBackPads" name="right_back_pads" type="text" value="5 Баллов">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"><label><input name="right_back_pads_photo" type="file">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="right_back_pads_comment" id="" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>

                                    <div data-imgid="i2-1" data-imgsrc="/img/report-car/img/32.jpg" class="report-field">
                                        <div class="report-field-main">
                                            <label for="inputrightFrontTire">Шина пер.</label>
                                            <div class="report-field-points">
                                                <input id="inputrightFrontTire" name="right_front_tire" type="text" value="5 Баллов">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"><label><input name="right_front_tire_photo" type="file">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="right_front_tire_comment" id="" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>

                                    <div data-imgid="i2-1" data-imgsrc="/img/report-car/img/33.jpg" class="report-field">
                                        <div class="report-field-main">
                                            <label for="inputrightBackTire">Шина задн.</label>
                                            <div class="report-field-points">
                                                <input id="inputrightBackTire" name="right_back_tire" type="text" value="5 Баллов">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"><label><input name="right_back_tire_photo" type="file">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="right_back_tire_comment" id="" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>

                                    <div data-imgid="i2-1" data-imgsrc="/img/report-car/img/34.jpg" class="report-field">
                                        <div class="report-field-main">
                                            <label for="inputrightThreshold">Порог</label>
                                            <div class="report-field-points">
                                                <input id="inputrightThreshold" name="right_threshold" type="text" value="5 Баллов">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"><label><input name="right_threshold_photo" type="file">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="right_threshold_comment" id="" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>

                                    <div data-imgid="i2-1" data-imgsrc="/img/report-car/img/35.jpg" class="report-field">
                                        <div class="report-field-main">
                                            <label for="inputrightFrontDoor">Дверь пер.</label>
                                            <div class="report-field-points">
                                                <input id="inputrightFrontDoor" name="right_front_door" type="text" value="5 Баллов">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"><label><input name="right_front_door_photo" type="file">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="right_front_door_comment" id="" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>

                                    <div data-imgid="i2-1" data-imgsrc="/img/report-car/img/36.jpg" class="report-field">
                                        <div class="report-field-main">
                                            <label for="inputrightBackDoor">Дверь задн.</label>
                                            <div class="report-field-points">
                                                <input id="inputrightBackDoor" name="right_back_door" type="text" value="5 Баллов">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"><label><input name="right_back_door_photo" type="file">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="right_back_door_comment" id="" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>

                                    <div data-imgid="i2-1" data-imgsrc="/img/report-car/img/37.jpg" class="report-field">
                                        <div class="report-field-main">
                                            <label for="inputrightBackLamp">Фонарь задн.</label>
                                            <div class="report-field-points">
                                                <input id="inputrightBackLamp" name="right_back_lamp" type="text" value="5 Баллов">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"><label><input name="right_back_lamp_photo" type="file">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="right_back_lamp_comment" id="" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>


                                    <!-- /правая колонка -->
                                </div>


                            </div>
                        </div>
                    </div>


                    <div class="row fieldgroup">
                        <div class="col-xl-4">
                            <div class="left-preview">
                                <span>перед</span>
                                <div  id="i3-1" data-standartimg="/img/report-car/img/42.jpg"  class="img-front-preview"></div>
                            </div>
                        </div>
                        <div class="col-xl-8"><!-- колонки с параметрами -->
                            <div class="row">
                                <div class="col-md-6">
                                    <!-- левая колонка -->
                                    <div  data-imgid="i3-1" data-imgsrc="/img/report-car/img/42.jpg"  class="report-field">
                                        <div class="report-field-main">
                                            <label for="inputWindshield">Стекло лобовое</label>
                                            <div class="report-field-points">
                                                <input id="inputWindshield" name="windshield" type="text" value="5 Баллов">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"><label><input name="windshield_photo" type="file">
                                                    </label>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="windshield_comment" id="" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>

                                    <div   data-imgid="i3-1" data-imgsrc="/img/report-car/img/41.jpg"  class="report-field">
                                        <div class="report-field-main">
                                            <label for="inputHood">Капот</label>
                                            <div class="report-field-points">
                                                <input id="inputHood" name="hood" type="text" value="5 Баллов">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"><label><input name="hood_photo" type="file">
                                                    </label>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="hood_comment" id="" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>


                                    <!-- /левая колонка -->
                                </div>
                                <div class="col-md-6">
                                    <!-- правая колонка -->

                                    <div  data-imgid="i3-1" data-imgsrc="/img/report-car/img/43.jpg" class="report-field">
                                        <div class="report-field-main">
                                            <label for="inputFrontBumper">Бампер передний</label>
                                            <div class="report-field-points">
                                                <input id="inputFrontBumper" name="front_bumper" type="text" value="5 Баллов">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"><label><input name="front_bumper_photo" type="file">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="front_bumper_comment" id="" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>

                                    <div  data-imgid="i3-1" data-imgsrc="/img/report-car/img/44.jpg" class="report-field">
                                        <div class="report-field-main">
                                            <label for="inputRadiatorGrille">Решетка радиатора</label>
                                            <div class="report-field-points">
                                                <input id="inputRadiatorGrille" name="radiator_grille" type="text" value="5 Баллов">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"><label><input name="radiator_grille_photo" type="file">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="radiator_grille_comment" id="" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>


                                    <!-- /правая колонка -->
                                </div>


                            </div>
                        </div>
                    </div>


                    <div class="row fieldgroup">
                        <div class="col-xl-4">
                            <div class="left-preview">
                                <span>Зад</span>
                                <div  id="i4-1" data-standartimg="/img/report-car/img/45.jpg"  class="img-back-preview"></div>
                            </div>
                        </div>
                        <div class="col-xl-8"><!-- колонки с параметрами -->
                            <div class="row">
                                <div class="col-md-6">
                                    <!-- левая колонка -->
                                    <div  data-imgid="i4-1" data-imgsrc="/img/report-car/img/46.jpg"  class="report-field">
                                        <div class="report-field-main">
                                            <label for="inputRearBumper">Бампер задний</label>
                                            <div class="report-field-points">
                                                <input id="inputRearBumper" name="rear_bumper" type="text" value="5 Баллов">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"><label><input name="rear_bumper_photo" type="file">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="rear_bumper_comment" id="" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>

                                    <div data-imgid="i4-1" data-imgsrc="/img/report-car/img/45.jpg" class="report-field">
                                        <div class="report-field-main">
                                            <label for="inputTrunkLid">Крышка багажника</label>
                                            <div class="report-field-points">
                                                <input id="inputTrunkLid" name="trunk_lid" type="text" value="5 Баллов">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"><label><input name="trunk_lid_photo" type="file">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="trunk_lid_comment" id="" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>


                                    <!-- /левая колонка -->
                                </div>
                                <div class="col-md-6">
                                    <!-- правая колонка -->

                                    <div data-imgid="i4-1" data-imgsrc="/img/report-car/img/47.jpg"  class="report-field">
                                        <div class="report-field-main">
                                            <label for="inputRearGlass">Стекло заднее</label>
                                            <div class="report-field-points">
                                                <input id="inputRearGlass" name="rear_glass" type="text" value="5 Баллов">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"><label><input name="rear_glass_photo" type="file">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="rear_glass_comment" id="" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>


                                    <!-- /правая колонка -->
                                </div>


                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8 offset-md-2">
                            <div class="f_group enterbut">
                                <a class="button button_orange button_top_img report-prev" href="#stage-2">НАЗАД</a>
                                <a class="button button_orange button_top_img report-next" href="#stage-4">ДАЛЬШЕ</a>

                            </div>
                        </div>
                    </div>

                </div>
                <div class="stage" id="stage-4" data-stage="4" data-progress="50" data-valid="0">

                    <div class="report-head row">
                        <div class="col-md-6">
                            <h1>Подкапотное пространство</h1>
                        </div>
                        <div class="col-md-6">
                            <div class="report-buttons">
                                <!--span class="report-save">сохранить</span>
                                <span class="report-edit">редактировать</span-->
                            </div>
                        </div>

                    </div>


                    <div class="row fieldgroup">
                        <div class="col-md-4">
                            <div class="left-preview">
                                <div id="i8-1" data-standartimg="/img/report-car/img/91.jpg" class="img-underhood-preview"></div>
                            </div>
                        </div>
                        <div class="col-md-8"><!-- колонки с параметрами -->
                            <div class="row">
                                <div class="col-md-6">
                                    <!-- левая колонка -->
                                    <div data-imgid="i8-1" data-imgsrc="/img/report-car/img/91.jpg"  class="report-field">
                                        <div class="report-field-main">

                                            <label for="inputPaintworkCondition">Состояние ЛКП</label>
                                            <div class="report-field-points">
                                                <input id="inputPaintworkCondition" name="paintwork_condition" type="text" value="3.2 балла">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"><label><input name="paintwork_condition_photo" type="file">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="lpc_condition_comment" id="" cols="30" rows="10"></textarea>
                                        </div>

                                    </div>

                                    <div data-imgid="i8-1" data-imgsrc="/img/report-car/img/92.jpg"  class="report-field">
                                        <div class="report-field-main">

                                            <label for="inputEngine">Двигатель</label>
                                            <div class="report-field-points">
                                                <input id="inputEngine" name="engine" type="text" value="3.2 балла">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"><label><input name="engine_photo" type="file">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="engine_comment" id="" cols="30" rows="10"></textarea>
                                        </div>

                                    </div>

                                    <!-- /левая колонка -->
                                </div>
                                <div class="col-md-6">
                                    <!-- правая колонка -->

                                    <div data-imgid="i8-1" data-imgsrc="/img/report-car/img/93.jpg"  class="report-field">
                                        <div class="report-field-main">

                                            <label for="inputPlasticParts">Пластиковые детали</label>
                                            <div class="report-field-points">
                                                <input id="inputPlasticParts" name="plastic_parts" type="text" value="3.2 балла">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"><label><input name="plastic_parts_photo" type="file">
                                                    </label>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="plastic_parts_comment" id="" cols="30" rows="10"></textarea>
                                        </div>

                                    </div>
                                    <div data-imgid="i8-1" data-imgsrc="/img/report-car/img/94.jpg"  class="report-field">
                                        <div class="report-field-main">

                                            <label for="inputAttachmentEquipment">Навесное оборудование</label>
                                            <div class="report-field-points">
                                                <input id="inputAttachmentEquipment" name="attachment_equipment" type="text" value="3.2 балла">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"><label><input name="attachment_equipment_photo" type="file">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="attachment_equipment_comment" id="" cols="30" rows="10"></textarea>
                                        </div>

                                    </div>


                                    <!-- /правая колонка -->
                                </div>


                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8 offset-md-2">
                            <div class="f_group enterbut">
                                <a class="button button_orange button_top_img report-prev" href="#stage-3">НАЗАД</a>
                                <a class="button button_orange button_top_img report-next" href="#stage-5">ДАЛЬШЕ</a>

                            </div>
                        </div>
                    </div>

                </div>
                <div class="stage" id="stage-5" data-stage="5" data-progress="62.5" data-valid="0">

                    <div class="report-head row">
                        <div class="col-md-6">
                            <h1>Салон</h1>
                        </div>
                        <div class="col-md-6">
                            <div class="report-buttons">
                                <!--span class="report-save">сохранить</span>
                                <span class="report-edit">редактировать</span-->
                            </div>
                        </div>

                    </div>


                    <div class="row fieldgroup">
                        <div class="col-md-4">
                            <div class="left-preview">
                                <div  id="i5-1" data-standartimg="/img/report-car/img/62.jpg"   class="img-cabin-preview"></div>
                            </div>
                        </div>
                        <div class="col-md-8"><!-- колонки с параметрами -->
                            <div class="row">
                                <div class="col-md-6">
                                    <!-- левая колонка -->
                                    <div data-imgid="i5-1" data-imgsrc="/img/report-car/img/62.jpg" class="report-field">
                                        <div class="report-field-main">

                                            <label for="inputFrontDriversSeat">Сиденье пер. водительское</label>
                                            <div class="report-field-points">
                                                <input id="inputFrontDriversSeat" name="front_drivers_seat" type="text" value="3.2 балла">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"><label><input name="front_drivers_seat_photo" type="file">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="front_drivers_seat_comment" id="" cols="30" rows="10"></textarea>
                                        </div>

                                    </div>
                                    <div data-imgid="i5-1" data-imgsrc="/img/report-car/img/61.jpg"  class="report-field">
                                        <div class="report-field-main">

                                            <label for="front_passenger_seat">Сиденье пер. пассажирское</label>
                                            <div class="report-field-points">
                                                <input id="front_passenger_seat" name="front_passenger_seat" type="text" value="3.2 балла">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"><label><input name="front_passenger_seat_photo" type="file">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="front_passenger_seat_comment" id="" cols="30" rows="10"></textarea>
                                        </div>

                                    </div>
                                    <div data-imgid="i5-1" data-imgsrc="/img/report-car/img/63.jpg"  class="report-field">
                                        <div class="report-field-main">

                                            <label for="inputRearSeat">Сиденье задн.</label>
                                            <div class="report-field-points">
                                                <input id="inputRearSeat" name="rear_seat" type="text" value="3.2 балла">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"><label><input name="rear_seat_photo" type="file">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="rear_seat_comment" id="" cols="30" rows="10"></textarea>
                                        </div>

                                    </div>
                                    <div data-imgid="i5-1" data-imgsrc="/img/report-car/img/65.jpg"  class="report-field">
                                        <div class="report-field-main">

                                            <label>Ошибки при диагностике</label>
                                            <div for="inputDiagnosticErrors" class="report-field-points">
                                                <input id="inputDiagnosticErrors" name="diagnostic_errors" type="text" value="3.2 балла">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"><label><input name="diagnostic_errors_photo" type="file">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="diagnostic_errors_comment" id="" cols="30" rows="10"></textarea>
                                        </div>

                                    </div>
                                    <div data-imgid="i5-1" data-imgsrc="/img/report-car/img/65.jpg" class="report-field">
                                        <div class="report-field-main">

                                            <label for="inputRecorder">Магнитола</label>
                                            <div class="report-field-points">
                                                <input id="inputRecorder" name="recorder" type="text" value="3.2 балла">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"><label><input name="recorder_photo" type="file">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="recorder_comment" id="" cols="30" rows="10"></textarea>
                                        </div>

                                    </div>
                                    <div data-imgid="i5-1" data-imgsrc="/img/report-car/img/66.jpg" class="report-field">
                                        <div class="report-field-main">

                                            <label for="inputKPP">КПП</label>
                                            <div class="report-field-points">
                                                <input id="inputKPP" name="kpp" type="text" value="3.2 балла">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"><label><input name="kpp_photo" type="file">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="kpp_comment" id="" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>
                                    <div data-imgid="i5-1" data-imgsrc="/img/report-car/img/67.jpg"  class="report-field">
                                        <div class="report-field-main">

                                            <label for="inputClimateControl">Климатическая установка</label>
                                            <div class="report-field-points">
                                                <input id="inputClimateControl" name="climate_control" type="text" value="3.2 балла">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"><label><input name="climate_control_photo" type="file">
                                                    </label>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="climate_control_comment" id="" cols="30" rows="10"></textarea>
                                        </div>

                                    </div>
                                    <!-- /левая колонка -->
                                </div>
                                <div class="col-md-6">
                                    <!-- правая колонка -->

                                    <div  data-imgid="i5-1" data-imgsrc="/img/report-car/img/68.jpg"  class="report-field">
                                        <div class="report-field-main">

                                            <label for="inputSteeringWheelAndPaddleSwitches">Руль+подрулевые переключатели</label>
                                            <div class="report-field-points">
                                                <input id="inputSteeringWheelAndPaddleSwitches" name="steering_wheel_and_paddle_switches" type="text" value="3.2 балла">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"><label><input name="steering_wheel_and_paddle_switches_photo" type="file">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="steering_wheel_and_paddle_switches_comment" id="" cols="30" rows="10"></textarea>
                                        </div>

                                    </div>

                                    <div   data-imgid="i5-1" data-imgsrc="/img/report-car/img/69.jpg" class="report-field">
                                        <div class="report-field-main">

                                            <label for="inputDashboard">Панель приборов</label>
                                            <div class="report-field-points">
                                                <input id="inputDashboard" name="dashboard" type="text" value="3.2 балла">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"><label><input name="dashboard_photo" type="file">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="dashboard_comment" id="" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>

                                    <div  data-imgid="i5-1" data-imgsrc="/img/report-car/img/70.jpg"  class="report-field">
                                        <div class="report-field-main">

                                            <label for="inputDoorTrim">Карты дверей</label>
                                            <div class="report-field-points">
                                                <input id="inputDoorTrim" name="door_trim" type="text" value="3.2 балла">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"><label><input name="door_trim_photo" type="file">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="door_cards_comment" id="" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>

                                    <div   data-imgid="i5-1" data-imgsrc="/img/report-car/img/71.jpg"  class="report-field">
                                        <div class="report-field-main">

                                            <label for="inputFloor">Пол</label>
                                            <div class="report-field-points">
                                                <input id="inputFloor" name="floor" type="text" value="3.2 балла">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"><label><input name="floor_photo" type="file">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="floor_comment" id="" cols="30" rows="10"></textarea>
                                        </div>

                                    </div>

                                    <div  data-imgid="i5-1" data-imgsrc="/img/report-car/img/72.jpg"  class="report-field">
                                        <div class="report-field-main">

                                            <label for="inputPedals">Педали</label>
                                            <div class="report-field-points">
                                                <input id="inputPedals" name="pedals" type="text" value="3.2 балла">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"><label><input name="pedals_photo" type="file">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="pedals_comment" id="" cols="30" rows="10"></textarea>
                                        </div>

                                    </div>


                                    <div   data-imgid="i5-1" data-imgsrc="/img/report-car/img/73.jpg" class="report-field">
                                        <div class="report-field-main">

                                            <label for="inputFloorMats">Коврики</label>
                                            <div class="report-field-points">
                                                <input id="inputFloorMats" name="floor_mats" type="text" value="3.2 балла">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"><label><input name="floor_mats_photo" type="file">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="floor_mats_comment" id="" cols="30" rows="10"></textarea>
                                        </div>

                                    </div>


                                    <div  data-imgid="i5-1" data-imgsrc="/img/report-car/img/74.jpg"  class="report-field">
                                        <div class="report-field-main">

                                            <label for="inputCeiling">Потолок</label>
                                            <div class="report-field-points">
                                                <input id="inputCeiling" name="ceiling" type="text" value="3.2 балла">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"><label><input name="ceiling_photo" type="file">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="ceiling_comment" id="" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>

                                    <!-- /правая колонка -->
                                </div>


                            </div>
                        </div>
                    </div>

                    <div class="row fieldgroup">
                        <div class="col-md-8 offset-md-2">
                            <div class="f_group enterbut">
                                <a class="button button_orange button_top_img report-prev" href="#stage-4">НАЗАД</a>
                                <a class="button button_orange button_top_img report-next" href="#stage-6">ДАЛЬШЕ</a>

                            </div>
                        </div>
                    </div>

                </div>
                <div class="stage" id="stage-6" data-stage="6" data-progress="75" data-valid="0">

                    <div class="report-head row">
                        <div class="col-md-6">
                            <h1>Багажник</h1>
                        </div>
                        <div class="col-md-6">
                            <div class="report-buttons">
                                <!--span class="report-save">сохранить</span>
                                <span class="report-edit">редактировать</span-->
                            </div>
                        </div>

                    </div>


                    <div class="row fieldgroup">
                        <div class="col-md-4">
                            <div class="left-preview">
                                <div id="i6-1" data-standartimg="/img/report-car/img/81.jpg"  class="img-bagaj-preview"></div>
                            </div>
                        </div>
                        <div class="col-md-8"><!-- колонки с параметрами -->
                            <div class="row">
                                <div class="col-md-6">
                                    <!-- левая колонка -->
                                    <div  data-imgid="i6-1" data-imgsrc="/img/report-car/img/81.jpg"  class="report-field">
                                        <div class="report-field-main">

                                            <label for="inputTrunkFloor">Пол</label>
                                            <div class="report-field-points">
                                                <input id="inputTrunkFloor" name="trunk_floor" type="text" value="3.2 балла">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"><label><input name="trunk_floor_photo" type="file">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="trunk_floor_comment" id="" cols="30" rows="10"></textarea>
                                        </div>

                                    </div>
                                    <div data-imgid="i6-1" data-imgsrc="/img/report-car/img/82.jpg" class="report-field">
                                        <div class="report-field-main">

                                            <label for="inputTrunkUpholstery">Обивка</label>
                                            <div class="report-field-points">
                                                <input id="inputTrunkUpholstery" name="trunk_upholstery" type="text" value="3.2 балла">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"><label><input name="trunk_upholstery_photo" type="file">
                                                    </label>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="upholstery_comment" id="" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>

                                    <div data-imgid="i6-1" data-imgsrc="/img/report-car/img/83.jpg" class="report-field">
                                        <div class="report-field-main">

                                            <label for="inputTrunkLighting">Освещение</label>
                                            <div class="report-field-points">
                                                <input id="inputTrunkLighting" name="trunk_lighting" type="text" value="3.2 балла">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"><label><input name="trunk_lighting_photo" type="file">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="lighting_comment" id="" cols="30" rows="10"></textarea>
                                        </div>

                                    </div>

                                    <div data-imgid="i6-1" data-imgsrc="/img/report-car/img/84.jpg" class="report-field">
                                        <div class="report-field-main">

                                            <label for="inputSpareWheel">Запасное колесо</label>
                                            <div class="report-field-points">
                                                <input id="inputSpareWheel" name="spare_wheel" type="text" value="3.2 балла">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"><label><input name="spare_wheel_photo" type="file">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="spare_wheel_comment" id="" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>


                                    <!-- /левая колонка -->
                                </div>
                                <div class="col-md-6">
                                    <!-- правая колонка -->

                                    <div data-imgid="i6-1" data-imgsrc="/img/report-car/img/85.jpg" class="report-field">
                                        <div class="report-field-main">

                                            <label for="inputInstruments">Инструменты</label>
                                            <div class="report-field-points">
                                                <input id="inputInstruments" name="instruments" type="text" value="3.2 балла">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"><label><input name="instruments_photo" type="file">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="instruments_comment" id="" cols="30" rows="10"></textarea>
                                        </div>

                                    </div>

                                    <div data-imgid="i6-1" data-imgsrc="/img/report-car/img/86.jpg" class="report-field">
                                        <div class="report-field-main">

                                            <label for="inputJack">Домкрат</label>
                                            <div class="report-field-points">
                                                <input id="inputJack" name="jack" type="text" value="3.2 балла">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"><label><input name="jack_photo" type="file">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="jack_comment" id="" cols="30" rows="10"></textarea>
                                        </div>

                                    </div>


                                    <div data-imgid="i6-1" data-imgsrc="/img/report-car/img/87.jpg" class="report-field">
                                        <div class="report-field-main">

                                            <label for="inputPitch">Фаркоп</label>
                                            <div class="report-field-points">
                                                <input id="inputPitch" name="hitch" type="text" value="3.2 балла">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"><label><input name="hitch_photo" type="file">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="hitch_comment" id="" cols="30" rows="10"></textarea>
                                        </div>

                                    </div>

                                    <!-- /правая колонка -->
                                </div>


                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8 offset-md-2">
                            <div class="f_group enterbut">
                                <a class="button button_orange button_top_img report-prev" href="#stage-5">НАЗАД</a>
                                <a class="button button_orange button_top_img report-next" href="#stage-7">ДАЛЬШЕ</a>

                            </div>
                        </div>
                    </div>

                </div>
                <div class="stage" id="stage-7" data-stage="7" data-progress="87" data-valid="0">

                    <div class="report-head row">
                        <div class="col-md-6">
                            <h1>Осмотр на подъемнике</h1>
                        </div>
                        <div class="col-md-6">
                            <div class="report-buttons">
                                <!--span class="report-save">сохранить</span>
                                <span class="report-edit">редактировать</span-->
                            </div>
                        </div>

                    </div>


                    <div class="row fieldgroup">
                        <div class="col-md-4">
                            <div class="left-preview">
                                <div id="i7-1" data-standartimg="/img/report-car/img/51.jpg"  class="img-bottom-preview"></div>
                            </div>
                        </div>
                        <div class="col-md-8"><!-- колонки с параметрами -->
                            <div class="row">
                                <div class="col-md-6">
                                    <!-- левая колонка -->
                                    <div data-imgid="i7-1" data-imgsrc="/img/report-car/img/51.jpg" class="report-field">
                                        <div class="report-field-main">

                                            <label for="inputAnticorrosionCoating">Антикоррозийное и антигравийное покрытие</label>
                                            <div class="report-field-points">
                                                <input id="inputAnticorrosionCoating" name="anticorrosion_coating" type="text" value="3.2 балла">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"><label><input name="anticorrosion_coating_photo" type="file">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="anticorrosion_coating_comment" id="" cols="30" rows="10"></textarea>
                                        </div>

                                    </div>


                                    <div data-imgid="i7-1" data-imgsrc="/img/report-car/img/52.jpg" class="report-field">
                                        <div class="report-field-main">

                                            <label for="inputHoses">Шланги</label>
                                            <div class="report-field-points">
                                                <input id="inputHoses" name="hoses" type="text" value="3.2 балла">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"><label><input name="hoses_photo" type="file">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="hoses_comment" id="" cols="30" rows="10"></textarea>
                                        </div>

                                    </div>

                                    <div data-imgid="i7-1" data-imgsrc="/img/report-car/img/53.jpg" class="report-field">
                                        <div class="report-field-main">

                                            <label for="inputWiring">Проводка</label>
                                            <div class="report-field-points">
                                                <input id="inputWiring" name="wiring" type="text" value="3.2 балла">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"><label><input name="wiring_photo" type="file">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="wiring_comment" id="" cols="30" rows="10"></textarea>
                                        </div>

                                    </div>

                                    <div data-imgid="i7-1" data-imgsrc="/img/report-car/img/55.jpg" class="report-field">
                                        <div class="report-field-main">

                                            <label for="inputFrontShockAbsorbers">Амортизаторы пер.</label>
                                            <div class="report-field-points">
                                                <input id="inputFrontShockAbsorbers" name="front_shock_absorbers" type="text" value="3.2 балла">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"><label><input name="front_shock_absorbers_photo" type="file">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="front_shock_absorbers_comment" id="" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>


                                    <!-- /левая колонка -->
                                </div>
                                <div class="col-md-6">
                                    <!-- правая колонка -->

                                    <div  data-imgid="i7-1" data-imgsrc="/img/report-car/img/54.jpg" class="report-field">
                                        <div class="report-field-main">

                                            <label for="inputRearShockAbsorbers">Амортизаторы зад.</label>
                                            <div class="report-field-points">
                                                <input id="inputRearShockAbsorbers" name="rear_shock_absorbers" type="text" value="3.2 балла">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"><label><input name="rear_shock_absorbers_photo" type="file">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="rear_shock_absorbers_comment" id="" cols="30" rows="10"></textarea>
                                        </div>

                                    </div>
                                    <div data-imgid="i7-1" data-imgsrc="/img/report-car/img/56.jpg" class="report-field">
                                        <div class="report-field-main">

                                            <label for="inputFrontSuspension">Передняя подвеска</label>
                                            <div class="report-field-points">
                                                <input id="inputFrontSuspension" name="front_suspension" type="text" value="3.2 балла">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"><label><input name="front_suspension_photo" type="file">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="front_suspension_comment" id="" cols="30" rows="10"></textarea>
                                        </div>

                                    </div>
                                    <div data-imgid="i7-1" data-imgsrc="/img/report-car/img/57.jpg" class="report-field">
                                        <div class="report-field-main">

                                            <label for="inputRearSuspension">Задняя подвеска</label>
                                            <div class="report-field-points">
                                                <input id="inputRearSuspension" name="rear_suspension" type="text" value="3.2 балла">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"><label><input name="rear_suspension_photo" type="file">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="rear_suspension_comment" id="" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>
                                    <div data-imgid="i7-1" data-imgsrc="/img/report-car/img/58.jpg" class="report-field">
                                        <div class="report-field-main">

                                            <label for="inputExhaustSystem">Система выхлопа</label>
                                            <div class="report-field-points">
                                                <input id="inputExhaustSystem" name="exhaust_system" type="text" value="3.2 балла">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button">
                                                    <label>
                                                        <input name="exhaust_system_photo" type="file">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="exhaust_system_comment" id="" cols="30" rows="10"></textarea>
                                        </div>

                                    </div>
                                    <!-- /правая колонка -->
                                </div>


                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8 offset-md-2">
                            <div class="f_group enterbut">
                                <a class="button button_orange button_top_img report-prev" href="#stage-6">НАЗАД</a>
                                <a class="button button_orange button_top_img report-next" href="#stage-8">ДАЛЬШЕ</a>

                            </div>
                        </div>
                    </div>


                </div>
                <div class="stage" id="stage-8" data-stage="8" data-progress="100" data-valid="0">

                    <div class="report-head row">
                        <div class="col-md-6">
                            <h1>Затраты после покупки</h1>
                        </div>
                        <div class="col-md-6">
                            <div class="report-buttons">
                                <!--span class="report-save">сохранить</span>
                                <span class="report-edit">редактировать</span-->
                            </div>
                        </div>

                    </div>


                    <div class="row">
                        <div class="col-md-6">
                            <input type="hidden" id="selectCurrency" name="currency" value="1">
                        </div>
                        <div class="col-md-6"></div>
                    </div>


                    <div class="row">
                        <div class="col-md-6">

                            <div class="report-price-field">
                                <div class="icon-car"></div>
                                <label for="inputPostPurchaseCostsBody">Кузов</label>
                                <input id="inputPostPurchaseCostsBody" name="post_purchase_costs_body" type="text" placeholder="Введите сумму">
                            </div>
                            <div class="report-price-field">
                                <div class="icon-car-glass"></div>
                                <label for="inputPostPurchaseCostsGlasses">Стекла</label>
                                <input id="inputPostPurchaseCostsGlasses" name="post_purchase_costs_glasses" type="text" placeholder="Введите сумму">
                            </div>
                            <div class="report-price-field">
                                <div class="icon-car-engine"></div>
                                <label for="inputPostPurchaseCostsEngine">Двигатель</label>
                                <input id="inputPostPurchaseCostsEngine" name="post_purchase_costs_engine" type="text" placeholder="Введите сумму">
                            </div>

                            <div class="report-price-field">
                                <div class="icon-car-trans"></div>
                                <label for="inputPostPurchaseCostsTransmission">Трансмиссия</label>
                                <input id="inputPostPurchaseCostsTransmission" name="post_purchase_costs_transmission" type="text" placeholder="Введите сумму">
                            </div>

                            <div class="report-price-field">
                                <div class="icon-car-cabin"></div>
                                <label for="inputPostPurchaseCostsSalon">Салон</label>
                                <input id="inputPostPurchaseCostsSalon" name="post_purchase_costs_salon" type="text" placeholder="Введите сумму">
                            </div>

                        </div>
                        <div class="col-md-6">

                            <div class="report-price-field">
                                <div class="icon-car-susp"></div>
                                <label for="inputPostPurchaseCostsSuspension">Подвеска</label>
                                <input id="inputPostPurchaseCostsSuspension" name="post_purchase_costs_suspension" type="text" placeholder="Введите сумму">
                            </div>

                            <div class="report-price-field">
                                <div class="icon-car-chassis"></div>
                                <label for="inputPostPurchaseCostsChassis">Ходовая часть</label>
                                <input id="inputPostPurchaseCostsChassis" name="post_purchase_costs_chassis" type="text" placeholder="Введите сумму">
                            </div>

                            <div class="report-price-field">
                                <div class="icon-car-electr"></div>
                                <label for="inputPostPurchaseCostsElectrician">Электрика</label>
                                <input id="inputPostPurchaseCostsElectrician" name="post_purchase_costs_electrician" type="text" placeholder="Введите сумму">
                            </div>

                            <div class="report-price-field">
                                <div class="icon-car-tire"></div>
                                <label for="inputSecondSetRubber">Второй комплект резины</label>
                                <input id="inputSecondSetRubber" name="second_set_rubber" type="text" placeholder="Введите сумму">
                            </div>


                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-12">
                            <div class="f_group">
                                <label for="inputCountryOrigin">Страна производства</label>
                                <textarea id="inputCountryOrigin" class="report-additional" name="country_origin" cols="30" rows="10" placeholder="Введите комментарий"></textarea>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-8 offset-md-2">
                            <div class="f_group enterbut">
                                <button type="submit" class="button button_orange button_top_img">Отправить</button>
                            </div>
                        </div>
                    </div>

                </div>

            </div><!-- report-form -->
        </div><!-- report container -->
    </form>
</main>