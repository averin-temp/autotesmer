<?php

/** @var $this \yii\web\View */
/** @var $order common\models\Order */
/** @var $chat common\models\Chat */

use frontend\assets\ReportAsset;

ReportAsset::register($this);
?>
<main>
    <form action="<?= \yii\helpers\Url::to(['report/send']) ?>" method="post">
        <input name="order_id" type="hidden" value="<?= $order->id ?>">
        <input name="chat_id" type="hidden" value="<?= $chat->id ?>">
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


                <div id="stage-1" data-progress="12.5">

                    <div class="report-head row">
                        <div class="col-md-6">
                            <h1>Кузов</h1>
                        </div>
                        <div class="col-md-6">
                            <div class="report-buttons">
                                <span class="report-save">сохранить</span>
                                <!--span class="report-edit">редактировать</span-->
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-4">
                            <div class="f_group">
                                <label for="">Год *</label>
                                <select name="year" class="form-control">
                                    <option selected>Выберите год</option>
                                    <option>1968</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="f_group">
                                <label for="">Марка *</label>
                                <select name="Mark" class="form-control">
                                    <option selected>Выберите марку</option>
                                    <option>...</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="f_group">
                                <label for="">Модель *</label>
                                <select name="model" class="form-control">
                                    <option selected>Выберите модель</option>
                                    <option>...</option>
                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-6">
                            <div class="f_group">
                                <label for="">VIN *</label>
                                <input name="vin" type="text" placeholder="Введите VIN" >
                            </div>
                        </div>


                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="f_group">
                                <label for="">Тип кузова</label>
                                <select name="body" class="form-control">
                                    <option selected>Выберите тип кузова</option>
                                    <option>...</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="f_group">
                                <label for="">Количество дверей</label>
                                <input name="doors_number" type="text" placeholder="Количество дверей" >
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="f_group">
                                <label for="">Привод</label>
                                <select name="drive" class="form-control">
                                    <option selected>Выберите тип привода</option>
                                    <option>...</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="f_group">
                                <label for="">Возраст ТС</label>
                                <select name="ts_age" class="form-control">
                                    <option selected>Возраст ТС</option>
                                    <option>...</option>
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="f_group">
                                <label for="">Страна производства</label>
                                <select name="country" class="form-control">
                                    <option selected>Выберите страну</option>
                                    <option>...</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="f_group">
                                <label for="">Количество владельцев</label>
                                <select name="owners_number" class="form-control">
                                    <option selected>Количество владельцев</option>
                                    <option>...</option>
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
                <div id="stage-2" data-progress="25">


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
                                <label for="">ДТП</label>
                                <textarea name="traffic_accidents" id="" cols="30" rows="10" placeholder="Введите текст"></textarea>
                                <div class="attach-file">
                                    <div class="icon-attach-file"></div>
                                    <span>Прикрепить файл</span>
                                </div>
                            </div>
                        </div>

                    </div>


                    <div class="row">
                        <div class="col-md-12">
                            <div class="f_group stage2-field">
                                <label for="">Записи о ТО</label>
                                <textarea name="to_records" cols="30" rows="10" placeholder="Введите текст"></textarea>
                                <div class="attach-file">
                                    <div class="icon-attach-file"></div>
                                    <span>Прикрепить файл</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="f_group stage2-field">
                                <label for="">Частное ТС</label>
                                <textarea name="personal_ts" id="" cols="30" rows="10" placeholder="Введите текст"></textarea>
                                <div class="attach-file">
                                    <div class="icon-attach-file"></div>
                                    <span>Прикрепить файл</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="f_group stage2-field">
                                <label for="">Показания одометра</label>
                                <textarea name="odometer" id="" cols="30" rows="10" placeholder="Введите текст"></textarea>
                                <div class="attach-file">
                                    <div class="icon-attach-file"></div>
                                    <span>Прикрепить файл</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="f_group stage2-field">
                                <label for="">ДТП *</label>
                                <textarea name="dtp1" cols="30" rows="10" placeholder="Введите текст"></textarea>
                                <div class="attach-file">
                                    <div class="icon-attach-file"></div>
                                    <span>Прикрепить файл</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="f_group stage2-field">
                                <label for="">ДТП *</label>
                                <textarea name="dtp2" cols="30" rows="10" placeholder="Введите текст"></textarea>
                                <div class="attach-file">
                                    <div class="icon-attach-file"></div>
                                    <span>Прикрепить файл</span>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-8 offset-md-2">
                            <div class="f_group enterbut">
                                <a class="button button_orange button_top_img report-next" href="#stage-3">ДАЛЬШЕ</a>
                            </div>
                        </div>
                    </div>

                </div>
                <div id="stage-3" data-progress="37.5">
                    <div class="report-head row">
                        <div class="col-md-6">
                            <h1>Кузов</h1>
                        </div>
                        <div class="col-md-6">
                            <div class="report-buttons">
                                <span class="report-save">сохранить</span>
                                <span class="report-edit">редактировать</span>
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
                                            <label>Фара</label>
                                            <div class="report-field-points">
                                                <input name="left_headlight" type="text" value="5 Баллов">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"></div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="left_headlight_comment" id="" cols="30" rows="10"></textarea>
                                        </div>

                                    </div>

                                    <div data-imgid="i1-1" data-imgsrc="/img/report-car/img/2.jpg" class="report-field">
                                        <div class="report-field-main">
                                            <label>ПТФ</label>
                                            <div class="report-field-points">
                                                <input name="left_ptf" type="text" value="5 Баллов">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"></div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="left_ptf_comment" id="" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>

                                    <div data-imgid="i1-1" data-imgsrc="/img/report-car/img/3.jpg" class="report-field">
                                        <div class="report-field-main">
                                            <label>Крыло пер.</label>
                                            <div class="report-field-points">
                                                <input name="left_front_wing" type="text" value="5 Баллов">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"></div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="left_front_wing_comment" id="" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>


                                    <div data-imgid="i1-1" data-imgsrc="/img/report-car/img/4.jpg" class="report-field">
                                        <div class="report-field-main">
                                            <label>Крыло задн.</label>
                                            <div class="report-field-points">
                                                <input name="left_back_wing" type="text" value="5 Баллов">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"></div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="left_back_wing_comment" id="" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>


                                    <div data-imgid="i1-1" data-imgsrc="/img/report-car/img/5.jpg" class="report-field">
                                        <div class="report-field-main">
                                            <label>Зеркало</label>
                                            <div class="report-field-points">
                                                <input name="left_mirror" type="text" value="5 Баллов">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"></div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="left_mirror_comment" id="" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>

                                    <div  data-imgid="i1-1" data-imgsrc="/img/report-car/img/6.jpg" class="report-field">
                                        <div class="report-field-main">
                                            <label>Диск пер.</label>
                                            <div class="report-field-points">
                                                <input name="left_front_wheels" type="text" value="5 Баллов">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"></div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="left_front_wheels_comment" id="" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>


                                    <div data-imgid="i1-1" data-imgsrc="/img/report-car/img/7.jpg"  class="report-field">
                                        <div class="report-field-main">
                                            <label>Диск задн.</label>
                                            <div class="report-field-points">
                                                <input name="left_back_wheels" type="text" value="5 Баллов">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"></div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="left_back_wheels_comment" id="" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>

                                    <div data-imgid="i1-1" data-imgsrc="/img/report-car/img/8.jpg"  class="report-field">
                                        <div class="report-field-main">
                                            <label>Тормозной диск пер.</label>
                                            <div class="report-field-points">
                                                <input name="left_front_brake_disc" type="text" value="5 Баллов">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"></div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="left_front_brake_disc_comment" id="" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>


                                    <div data-imgid="i1-1" data-imgsrc="/img/report-car/img/9.jpg"  class="report-field">
                                        <div class="report-field-main">
                                            <label>Тормозной диск задн.</label>
                                            <div class="report-field-points">
                                                <input name="left_back_brake_disc" type="text" value="5 Баллов">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"></div>
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
                                            <label>Колодки пер.</label>
                                            <div class="report-field-points">
                                                <input name="left_front_pads" type="text" value="5 Баллов">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"></div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="left_front_pads_comment" id="" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>

                                    <div data-imgid="i1-1" data-imgsrc="/img/report-car/img/11.jpg"  class="report-field">
                                        <div class="report-field-main">
                                            <label>Колодки задн.</label>
                                            <div class="report-field-points">
                                                <input name="left_back_pads" type="text" value="5 Баллов">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"></div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="left_back_pads_comment" id="" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>

                                    <div data-imgid="i1-1" data-imgsrc="/img/report-car/img/12.jpg"  class="report-field">
                                        <div class="report-field-main">
                                            <label>Шина пер.</label>
                                            <div class="report-field-points">
                                                <input name="left_front_tire" type="text" value="5 Баллов">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"></div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="left_front_tire_comment" id="" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>

                                    <div data-imgid="i1-1" data-imgsrc="/img/report-car/img/13.jpg"  class="report-field">
                                        <div class="report-field-main">
                                            <label>Шина задн.</label>
                                            <div class="report-field-points">
                                                <input name="left_back_tire" type="text" value="5 Баллов">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"></div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="left_back_tire_comment" id="" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>

                                    <div data-imgid="i1-1" data-imgsrc="/img/report-car/img/14.jpg"  class="report-field">
                                        <div class="report-field-main">
                                            <label>Порог</label>
                                            <div class="report-field-points">
                                                <input name="left_threshold" type="text" value="5 Баллов">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"></div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="left_threshold_comment" id="" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>

                                    <div data-imgid="i1-1" data-imgsrc="/img/report-car/img/15.jpg"  class="report-field">
                                        <div class="report-field-main">
                                            <label>Дверь пер.</label>
                                            <div class="report-field-points">
                                                <input name="left_front_door" type="text" value="5 Баллов">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"></div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="left_front_door_comment" id="" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>

                                    <div data-imgid="i1-1" data-imgsrc="/img/report-car/img/16.jpg"  class="report-field">
                                        <div class="report-field-main">
                                            <label>Дверь задн.</label>
                                            <div class="report-field-points">
                                                <input name="left_back_door" type="text" value="5 Баллов">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"></div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="left_back_door_comment" id="" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>

                                    <div data-imgid="i1-1" data-imgsrc="/img/report-car/img/17.jpg"  class="report-field">
                                        <div class="report-field-main">
                                            <label>Фонарь задн.</label>
                                            <div class="report-field-points">
                                                <input name="left_back_lamp" type="text" value="5 Баллов">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"></div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="left_back_lamp_comment" id="" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>

                                    <div  data-imgid="i1-1" data-imgsrc="/img/report-car/img/18.jpg"  class="report-field">
                                        <div class="report-field-main">
                                            <label>Крыша со стойками</label>
                                            <div class="report-field-points">
                                                <input name="roof_with_racks" type="text" value="5 Баллов">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"></div>
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
                                            <label>Фара</label>
                                            <div class="report-field-points">
                                                <input name="rigth_headlight" type="text" value="5 Баллов">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"></div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="rigth_headlight_comment" id="" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>

                                    <div  data-imgid="i2-1" data-imgsrc="/img/report-car/img/22.jpg" class="report-field">
                                        <div class="report-field-main">
                                            <label>ПТФ</label>
                                            <div class="report-field-points">
                                                <input name="rigth_ptf" type="text" value="5 Баллов">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"></div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="rigth_ptf_comment" id="" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>

                                    <div  data-imgid="i2-1" data-imgsrc="/img/report-car/img/23.jpg" class="report-field">
                                        <div class="report-field-main">
                                            <label>Крыло пер.</label>
                                            <div class="report-field-points">
                                                <input name="rigth_front_wing" type="text" value="5 Баллов">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"></div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="rigth_front_wing_comment" id="" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>


                                    <div  data-imgid="i2-1" data-imgsrc="/img/report-car/img/24.jpg" class="report-field">
                                        <div class="report-field-main">
                                            <label>Крыло задн.</label>
                                            <div class="report-field-points">
                                                <input name="rigth_back_wing" type="text" value="5 Баллов">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"></div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="rigth_back_wing_comment" id="" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>


                                    <div  data-imgid="i2-1" data-imgsrc="/img/report-car/img/25.jpg" class="report-field">
                                        <div class="report-field-main">
                                            <label>Зеркало</label>
                                            <div class="report-field-points">
                                                <input name="rigth_mirror" type="text" value="5 Баллов">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"></div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="rigth_mirror_comment" id="" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>

                                    <div  data-imgid="i2-1" data-imgsrc="/img/report-car/img/26.jpg" class="report-field">
                                        <div class="report-field-main">
                                            <label>Диск пер.</label>
                                            <div class="report-field-points">
                                                <input name="rigth_front_wheels" type="text" value="5 Баллов">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"></div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="rigth_front_wheels_comment" id="" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>


                                    <div  data-imgid="i2-1" data-imgsrc="/img/report-car/img/27.jpg" class="report-field">
                                        <div class="report-field-main">
                                            <label>Диск задн.</label>
                                            <div class="report-field-points">
                                                <input name="rigth_back_wheels" type="text" value="5 Баллов">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"></div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="rigth_back_wheels_comment" id="" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>

                                    <div  data-imgid="i2-1" data-imgsrc="/img/report-car/img/28.jpg" class="report-field">
                                        <div class="report-field-main">
                                            <label>Тормозной диск пер.</label>
                                            <div class="report-field-points">
                                                <input name="rigth_front_brake_disc" type="text" value="5 Баллов">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"></div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="rigth_front_brake_disc_comment" id="" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>


                                    <div  data-imgid="i2-1" data-imgsrc="/img/report-car/img/29.jpg" class="report-field">
                                        <div class="report-field-main">
                                            <label>Тормозной диск задн.</label>
                                            <div class="report-field-points">
                                                <input name="rigth_back_brake_disc" type="text" value="5 Баллов">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"></div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="rigth_back_brake_disc_comment" id="" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>

                                    <!-- /левая колонка -->
                                </div>
                                <div class="col-md-6">
                                    <!-- правая колонка -->

                                    <div data-imgid="i2-1" data-imgsrc="/img/report-car/img/30.jpg" class="report-field">
                                        <div class="report-field-main">
                                            <label>Колодки пер.</label>
                                            <div class="report-field-points">
                                                <input name="rigth_front_pads" type="text" value="5 Баллов">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"></div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="rigth_front_pads_comment" id="" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>

                                    <div data-imgid="i2-1" data-imgsrc="/img/report-car/img/31.jpg" class="report-field">
                                        <div class="report-field-main">
                                            <label>Колодки задн.</label>
                                            <div class="report-field-points">
                                                <input name="rigth_back_pads" type="text" value="5 Баллов">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"></div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="rigth_back_pads_comment" id="" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>

                                    <div data-imgid="i2-1" data-imgsrc="/img/report-car/img/32.jpg" class="report-field">
                                        <div class="report-field-main">
                                            <label>Шина пер.</label>
                                            <div class="report-field-points">
                                                <input name="rigth_front_tire" type="text" value="5 Баллов">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"></div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="rigth_front_tire_comment" id="" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>

                                    <div data-imgid="i2-1" data-imgsrc="/img/report-car/img/33.jpg" class="report-field">
                                        <div class="report-field-main">
                                            <label>Шина задн.</label>
                                            <div class="report-field-points">
                                                <input name="rigth_back_tire" type="text" value="5 Баллов">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"></div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="rigth_back_tire_comment" id="" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>

                                    <div data-imgid="i2-1" data-imgsrc="/img/report-car/img/34.jpg" class="report-field">
                                        <div class="report-field-main">
                                            <label>Порог</label>
                                            <div class="report-field-points">
                                                <input name="rigth_threshold" type="text" value="5 Баллов">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"></div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="rigth_threshold_comment" id="" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>

                                    <div data-imgid="i2-1" data-imgsrc="/img/report-car/img/35.jpg" class="report-field">
                                        <div class="report-field-main">
                                            <label>Дверь пер.</label>
                                            <div class="report-field-points">
                                                <input name="rigth_front_door" type="text" value="5 Баллов">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"></div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="rigth_front_door_comment" id="" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>

                                    <div data-imgid="i2-1" data-imgsrc="/img/report-car/img/36.jpg" class="report-field">
                                        <div class="report-field-main">
                                            <label>Дверь задн.</label>
                                            <div class="report-field-points">
                                                <input name="rigth_back_door" type="text" value="5 Баллов">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"></div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="rigth_back_door_comment" id="" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>

                                    <div data-imgid="i2-1" data-imgsrc="/img/report-car/img/37.jpg" class="report-field">
                                        <div class="report-field-main">
                                            <label>Фонарь задн.</label>
                                            <div class="report-field-points">
                                                <input name="rigth_back_lamp" type="text" value="5 Баллов">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"></div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="rigth_back_lamp_comment" id="" cols="30" rows="10"></textarea>
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
                                            <label>Стекло лобовое</label>
                                            <div class="report-field-points">
                                                <input name="windshield" type="text" value="5 Баллов">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"></div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="windshield_comment" id="" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>

                                    <div   data-imgid="i3-1" data-imgsrc="/img/report-car/img/41.jpg"  class="report-field">
                                        <div class="report-field-main">
                                            <label>Капот</label>
                                            <div class="report-field-points">
                                                <input name="hood" type="text" value="5 Баллов">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"></div>
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
                                            <label>Бампер передний</label>
                                            <div class="report-field-points">
                                                <input name="front_bumper" type="text" value="5 Баллов">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"></div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="front_bumper_comment" id="" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>

                                    <div  data-imgid="i3-1" data-imgsrc="/img/report-car/img/44.jpg" class="report-field">
                                        <div class="report-field-main">
                                            <label>Решетка радиатора</label>
                                            <div class="report-field-points">
                                                <input name="radiator_grille" type="text" value="5 Баллов">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"></div>
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
                                            <label>Бампер задний</label>
                                            <div class="report-field-points">
                                                <input name="rear_bumper" type="text" value="5 Баллов">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"></div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="rear_bumper_comment" id="" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>

                                    <div data-imgid="i4-1" data-imgsrc="/img/report-car/img/45.jpg" class="report-field">
                                        <div class="report-field-main">
                                            <label>Крышка багажника</label>
                                            <div class="report-field-points">
                                                <input name="trunk_lid" type="text" value="5 Баллов">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"></div>
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
                                            <label>Стекло заднее</label>
                                            <div class="report-field-points">
                                                <input name="rear_glass" type="text" value="5 Баллов">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"></div>
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
                                <a class="button button_orange button_top_img report-next" href="#stage-4">ДАЛЬШЕ</a>
                            </div>
                        </div>
                    </div>

                </div>
                <div id="stage-4" data-progress="50">

                    <div class="report-head row">
                        <div class="col-md-6">
                            <h1>Подкапотное пространство</h1>
                        </div>
                        <div class="col-md-6">
                            <div class="report-buttons">
                                <span class="report-save">сохранить</span>
                                <span class="report-edit">редактировать</span>
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

                                            <label>Состояние ЛКП</label>
                                            <div class="report-field-points">
                                                <input name="lpc_condition" type="text" value="3.2 балла">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"></div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="lpc_condition_comment" id="" cols="30" rows="10"></textarea>
                                        </div>

                                    </div>

                                    <div data-imgid="i8-1" data-imgsrc="/img/report-car/img/92.jpg"  class="report-field">
                                        <div class="report-field-main">

                                            <label>Двигатель</label>
                                            <div class="report-field-points">
                                                <input name="engine" type="text" value="3.2 балла">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"></div>
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

                                            <label>Пластиковые детали</label>
                                            <div class="report-field-points">
                                                <input name="plastic_parts" type="text" value="3.2 балла">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"></div>
                                            </div>

                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="plastic_parts_comment" id="" cols="30" rows="10"></textarea>
                                        </div>

                                    </div>
                                    <div data-imgid="i8-1" data-imgsrc="/img/report-car/img/94.jpg"  class="report-field">
                                        <div class="report-field-main">

                                            <label>Навесное оборудование</label>
                                            <div class="report-field-points">
                                                <input name="attachment_equipment" type="text" value="3.2 балла">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"></div>
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
                                <a class="button button_orange button_top_img report-next" href="#stage-5">ДАЛЬШЕ</a>
                            </div>
                        </div>
                    </div>

                </div>

                <div id="stage-5" data-progress="62.5">

                    <div class="report-head row">
                        <div class="col-md-6">
                            <h1>Салон</h1>
                        </div>
                        <div class="col-md-6">
                            <div class="report-buttons">
                                <span class="report-save">сохранить</span>
                                <span class="report-edit">редактировать</span>
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
                                    <div  data-imgid="i5-1" data-imgsrc="/img/report-car/img/62.jpg" class="report-field">
                                        <div class="report-field-main">

                                            <label>Сиденье пер. водительское</label>
                                            <div class="report-field-points">
                                                <input name="front_drivers_seat" type="text" value="3.2 балла">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"></div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="front_drivers_seat_comment" id="" cols="30" rows="10"></textarea>
                                        </div>

                                    </div>

                                    <div   data-imgid="i5-1" data-imgsrc="/img/report-car/img/61.jpg"  class="report-field">
                                        <div class="report-field-main">

                                            <label>Сиденье пер. пассажирское</label>
                                            <div class="report-field-points">
                                                <input name="front_passenger_seat" type="text" value="3.2 балла">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"></div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="front_passenger_seat_comment" id="" cols="30" rows="10"></textarea>
                                        </div>

                                    </div>

                                    <div   data-imgid="i5-1" data-imgsrc="/img/report-car/img/63.jpg"  class="report-field">
                                        <div class="report-field-main">

                                            <label>Сиденье задн.</label>
                                            <div class="report-field-points">
                                                <input name="rear_seat" type="text" value="3.2 балла">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"></div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="rear_seat_comment" id="" cols="30" rows="10"></textarea>
                                        </div>

                                    </div>

                                    <div   data-imgid="i5-1" data-imgsrc="/img/report-car/img/65.jpg"  class="report-field">
                                        <div class="report-field-main">

                                            <label>Ошибки при диагностике</label>
                                            <div class="report-field-points">
                                                <input name="diagnostic_errors" type="text" value="3.2 балла">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"></div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="diagnostic_errors_comment" id="" cols="30" rows="10"></textarea>
                                        </div>

                                    </div>

                                    <div   data-imgid="i5-1" data-imgsrc="/img/report-car/img/65.jpg" class="report-field">
                                        <div class="report-field-main">

                                            <label>Магнитола</label>
                                            <div class="report-field-points">
                                                <input name="recorder" type="text" value="3.2 балла">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"></div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="recorder_comment" id="" cols="30" rows="10"></textarea>
                                        </div>

                                    </div>


                                    <div   data-imgid="i5-1" data-imgsrc="/img/report-car/img/66.jpg" class="report-field">
                                        <div class="report-field-main">

                                            <label>КПП</label>
                                            <div class="report-field-points">
                                                <input name="kpp" type="text" value="3.2 балла">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"></div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="kpp_comment" id="" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>


                                    <div   data-imgid="i5-1" data-imgsrc="/img/report-car/img/67.jpg"  class="report-field">
                                        <div class="report-field-main">

                                            <label>Климатическая установка</label>
                                            <div class="report-field-points">
                                                <input name="climate_control" type="text" value="3.2 балла">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"></div>
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

                                            <label>Руль+подрулевые переключатели</label>
                                            <div class="report-field-points">
                                                <input name="steering_wheel_and_paddle_switches" type="text" value="3.2 балла">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"></div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="steering_wheel_and_paddle_switches_comment" id="" cols="30" rows="10"></textarea>
                                        </div>

                                    </div>

                                    <div   data-imgid="i5-1" data-imgsrc="/img/report-car/img/69.jpg" class="report-field">
                                        <div class="report-field-main">

                                            <label>Панель приборов</label>
                                            <div class="report-field-points">
                                                <input name="dashboard" type="text" value="3.2 балла">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"></div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="dashboard_comment" id="" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>

                                    <div  data-imgid="i5-1" data-imgsrc="/img/report-car/img/70.jpg"  class="report-field">
                                        <div class="report-field-main">

                                            <label>Карты дверей</label>
                                            <div class="report-field-points">
                                                <input name="door_cards" type="text" value="3.2 балла">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"></div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="door_cards_comment" id="" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>

                                    <div   data-imgid="i5-1" data-imgsrc="/img/report-car/img/71.jpg"  class="report-field">
                                        <div class="report-field-main">

                                            <label>Пол</label>
                                            <div class="report-field-points">
                                                <input name="floor" type="text" value="3.2 балла">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"></div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="floor_comment" id="" cols="30" rows="10"></textarea>
                                        </div>

                                    </div>

                                    <div  data-imgid="i5-1" data-imgsrc="/img/report-car/img/72.jpg"  class="report-field">
                                        <div class="report-field-main">

                                            <label>Педали</label>
                                            <div class="report-field-points">
                                                <input name="pedals" type="text" value="3.2 балла">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"></div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="pedals_comment" id="" cols="30" rows="10"></textarea>
                                        </div>

                                    </div>


                                    <div   data-imgid="i5-1" data-imgsrc="/img/report-car/img/73.jpg" class="report-field">
                                        <div class="report-field-main">

                                            <label>Коврики</label>
                                            <div class="report-field-points">
                                                <input name="floor_mats" type="text" value="3.2 балла">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"></div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="floor_mats_comment" id="" cols="30" rows="10"></textarea>
                                        </div>

                                    </div>


                                    <div  data-imgid="i5-1" data-imgsrc="/img/report-car/img/74.jpg"  class="report-field">
                                        <div class="report-field-main">

                                            <label>Потолок</label>
                                            <div class="report-field-points">
                                                <input name="ceiling" type="text" value="3.2 балла">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"></div>
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
                                <a class="button button_orange button_top_img report-next" href="#stage-6">ДАЛЬШЕ</a>
                            </div>
                        </div>
                    </div>

                </div>

                <div id="stage-6" data-progress="75">

                    <div class="report-head row">
                        <div class="col-md-6">
                            <h1>Багажник</h1>
                        </div>
                        <div class="col-md-6">
                            <div class="report-buttons">
                                <span class="report-save">сохранить</span>
                                <span class="report-edit">редактировать</span>
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

                                            <label>Пол</label>
                                            <div class="report-field-points">
                                                <input name="trunk_floor" type="text" value="3.2 балла">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"></div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="trunk_floor_comment" id="" cols="30" rows="10"></textarea>
                                        </div>

                                    </div>


                                    <div data-imgid="i6-1" data-imgsrc="/img/report-car/img/82.jpg" class="report-field">
                                        <div class="report-field-main">

                                            <label>Обивка</label>
                                            <div class="report-field-points">
                                                <input name="upholstery" type="text" value="3.2 балла">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"></div>
                                            </div>

                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="upholstery_comment" id="" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>

                                    <div data-imgid="i6-1" data-imgsrc="/img/report-car/img/83.jpg" class="report-field">
                                        <div class="report-field-main">

                                            <label>Освещение</label>
                                            <div class="report-field-points">
                                                <input name="lighting" type="text" value="3.2 балла">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"></div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="lighting_comment" id="" cols="30" rows="10"></textarea>
                                        </div>

                                    </div>

                                    <div data-imgid="i6-1" data-imgsrc="/img/report-car/img/84.jpg" class="report-field">
                                        <div class="report-field-main">

                                            <label>Запасное колесо</label>
                                            <div class="report-field-points">
                                                <input name="spare_wheel" type="text" value="3.2 балла">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"></div>
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

                                            <label>Инструменты</label>
                                            <div class="report-field-points">
                                                <input name="instruments" type="text" value="3.2 балла">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"></div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="instruments_comment" id="" cols="30" rows="10"></textarea>
                                        </div>

                                    </div>

                                    <div data-imgid="i6-1" data-imgsrc="/img/report-car/img/86.jpg" class="report-field">
                                        <div class="report-field-main">

                                            <label>Домкрат</label>
                                            <div class="report-field-points">
                                                <input name="jack" type="text" value="3.2 балла">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"></div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="jack_comment" id="" cols="30" rows="10"></textarea>
                                        </div>

                                    </div>


                                    <div data-imgid="i6-1" data-imgsrc="/img/report-car/img/87.jpg" class="report-field">
                                        <div class="report-field-main">

                                            <label>Фаркоп</label>
                                            <div class="report-field-points">
                                                <input name="hitch" type="text" value="3.2 балла">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"></div>
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
                                <a class="button button_orange button_top_img report-next" href="#stage-7">ДАЛЬШЕ</a>
                            </div>
                        </div>
                    </div>

                </div>

                <div id="stage-7" data-progress="87">

                    <div class="report-head row">
                        <div class="col-md-6">
                            <h1>Осмотр на подъемнике</h1>
                        </div>
                        <div class="col-md-6">
                            <div class="report-buttons">
                                <span class="report-save">сохранить</span>
                                <span class="report-edit">редактировать</span>
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

                                            <label>Антикоррозийное и антигравийное покрытие</label>
                                            <div class="report-field-points">
                                                <input name="anticorrosion_coating" type="text" value="3.2 балла">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"></div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="anticorrosion_coating_comment" id="" cols="30" rows="10"></textarea>
                                        </div>

                                    </div>


                                    <div data-imgid="i7-1" data-imgsrc="/img/report-car/img/52.jpg" class="report-field">
                                        <div class="report-field-main">

                                            <label>Шланги</label>
                                            <div class="report-field-points">
                                                <input name="hoses" type="text" value="3.2 балла">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"></div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="hoses_comment" id="" cols="30" rows="10"></textarea>
                                        </div>

                                    </div>

                                    <div data-imgid="i7-1" data-imgsrc="/img/report-car/img/53.jpg" class="report-field">
                                        <div class="report-field-main">

                                            <label>Проводка</label>
                                            <div class="report-field-points">
                                                <input name="wiring" type="text" value="3.2 балла">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"></div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="wiring_comment" id="" cols="30" rows="10"></textarea>
                                        </div>

                                    </div>

                                    <div data-imgid="i7-1" data-imgsrc="/img/report-car/img/55.jpg" class="report-field">
                                        <div class="report-field-main">

                                            <label>Амортизаторы пер.</label>
                                            <div class="report-field-points">
                                                <input name="front_shock_absorbers" type="text" value="3.2 балла">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"></div>
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

                                            <label>Амортизаторы зад.</label>
                                            <div class="report-field-points">
                                                <input name="rear_shock_absorbers" type="text" value="3.2 балла">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"></div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="rear_shock_absorbers_comment" id="" cols="30" rows="10"></textarea>
                                        </div>

                                    </div>

                                    <div data-imgid="i7-1" data-imgsrc="/img/report-car/img/56.jpg" class="report-field">
                                        <div class="report-field-main">

                                            <label>Передняя подвеска</label>
                                            <div class="report-field-points">
                                                <input name="front_suspension" type="text" value="3.2 балла">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"></div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="front_suspension_comment" id="" cols="30" rows="10"></textarea>
                                        </div>

                                    </div>


                                    <div data-imgid="i7-1" data-imgsrc="/img/report-car/img/57.jpg" class="report-field">
                                        <div class="report-field-main">

                                            <label>Задняя подвеска</label>
                                            <div class="report-field-points">
                                                <input name="rear_suspension" type="text" value="3.2 балла">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"></div>
                                            </div>
                                        </div>
                                        <div class="report-field-comment">
                                            <textarea name="rear_suspension_comment" id="" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>


                                    <div data-imgid="i7-1" data-imgsrc="/img/report-car/img/58.jpg" class="report-field">
                                        <div class="report-field-main">

                                            <label>Система выхлопа</label>
                                            <div class="report-field-points">
                                                <input name="exhaust_system" type="text" value="3.2 балла">
                                                <div class="points-buttons">
                                                    <div class="button-up"></div>
                                                    <div class="button-down"></div>
                                                </div>
                                            </div>

                                            <div class="param-actions">
                                                <div class="param-comment-button"></div>
                                                <div class="param-attach-button"></div>
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
                                <a class="button button_orange button_top_img report-next" href="#stage-8">ДАЛЬШЕ</a>
                            </div>
                        </div>
                    </div>


                </div>
                <div id="stage-8" data-progress="100">

                    <div class="report-head row">
                        <div class="col-md-6">
                            <h1>Затраты после покупки</h1>
                        </div>
                        <div class="col-md-6">
                            <div class="report-buttons">
                                <span class="report-save">сохранить</span>
                                <span class="report-edit">редактировать</span>
                            </div>
                        </div>

                    </div>


                    <div class="row">
                        <div class="col-md-6">
                            <div class="report-price-field">
                                <label for="">Выберите валюту</label>
                                <select name="general_currency" id="">
                                    <option value="">Руб</option>
                                    <option value="">USD</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6"></div>
                    </div>


                    <div class="row">
                        <div class="col-md-6">

                            <div class="report-price-field">
                                <div class="icon-car"></div>
                                <label for="">Кузов</label>
                                <input name="general_body" type="text" placeholder="Введите сумму">
                            </div>

                            <div class="report-price-field">
                                <div class="icon-car-glass"></div>
                                <label for="">Стекла</label>
                                <input name="general_glasses" type="text" placeholder="Введите сумму">
                            </div>

                            <div class="report-price-field">
                                <div class="icon-car-engine"></div>
                                <label for="">Двигатель</label>
                                <input name="general_engine" type="text" placeholder="Введите сумму">
                            </div>

                            <div class="report-price-field">
                                <div class="icon-car-trans"></div>
                                <label for="">Трансмиссия</label>
                                <input name="general_transmission" type="text" placeholder="Введите сумму">
                            </div>

                            <div class="report-price-field">
                                <div class="icon-car-cabin"></div>
                                <label for="">Салон</label>
                                <input name="general_salon" type="text" placeholder="Введите сумму">
                            </div>

                        </div>
                        <div class="col-md-6">

                            <div class="report-price-field">
                                <div class="icon-car-susp"></div>
                                <label for="">Подвеска</label>
                                <input name="general_suspension" type="text" placeholder="Введите сумму">
                            </div>

                            <div class="report-price-field">
                                <div class="icon-car-chassis"></div>
                                <label for="">Ходовая часть</label>
                                <input name="general_chassis" type="text" placeholder="Введите сумму">
                            </div>

                            <div class="report-price-field">
                                <div class="icon-car-electr"></div>
                                <label for="">Электрика</label>
                                <input name="general_electrician" type="text" placeholder="Введите сумму">
                            </div>

                            <div class="report-price-field">
                                <div class="icon-car-tire"></div>
                                <label for="">Второй комплект резины</label>
                                <input name="general_second_set_rubber" type="text" placeholder="Введите сумму">
                            </div>


                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-12">
                            <div class="f_group">
                                <label for="">Страна производства</label>
                                <textarea class="report-additional" name="general_country_origin" cols="30" rows="10"
                                          placeholder="Введите комментарий"></textarea>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-8 offset-md-2">
                            <div class="f_group enterbut">
                                <button type="submit" class="button button_orange button_top_img" href="#stage-1">Отправить</button>
                            </div>
                        </div>
                    </div>

                </div>

            </div><!-- report-form -->
        </div><!-- report container -->
    </form>
</main>