<?php


use yii\helpers\Url;
use frontend\widgets\PackagesForExperts;

?>
<main>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="reg_top_string clearfix active_1">
                    <div class="reg_top_string_item reg_top_string_item_1">
                        <span>Преимущества сервиса</span></div>
                    <div class="reg_top_string_item reg_top_string_item_2">
                            <span>Создание учетной записи</span></div>
                    <div class="reg_top_string_item reg_top_string_item_3"><span>Подтверждение регистрации</span></div>
                </div>
            </div>
        </div>
        <div class="reg_exp_page_1st">
            <div class="row">
                <div class="col-md-12">
                    <div class="reg_exp_page_3">
                        <h2>Преимущества сервиса</h2>
                    </div>
                </div>
            </div>
            <div class="reg_exp_page_1st_1">
                <div class="row">
                    <div class="col-md-3">
                        <div class="reg_exp_page_1st_1_top"
                             style="background-image: url(<?= Url::to('@web/img/icons/regics/1.png') ?>);"></div>
                        <div class="reg_exp_page_1st_1_middle">Достойный заработок</div>
                        <div class="reg_exp_page_1st_1_bot">Повышайте свой рейтинг успешно выполняя сложные задания по
                            подбору, публикуйте свои видео с отзывами клиентов - получайте больше прямых обращений
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="reg_exp_page_1st_1_top"
                             style="background-image: url(<?= Url::to('@web/img/icons/regics/2.png') ?>);"></div>
                        <div class="reg_exp_page_1st_1_middle">Свободный график</div>
                        <div class="reg_exp_page_1st_1_bot">Вы знаете что такое ответственность и ваше время принадлежит
                            только Вам, занимайтесь подбором качественной технике в свободное от основной работы время
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="reg_exp_page_1st_1_top"
                             style="background-image: url(<?= Url::to('@web/img/icons/regics/2.png') ?>);"></div>
                        <div class="reg_exp_page_1st_1_middle">Безопасный сервис</div>
                        <div class="reg_exp_page_1st_1_bot">Деньги от клиента блокируются на депозитном счете, и вы
                            можете быть уверены что ваши услуги будут оплачены
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="reg_exp_page_1st_1_top"
                             style="background-image: url(<?= Url::to('@web/img/icons/regics/4.png') ?>);"></div>
                        <div class="reg_exp_page_1st_1_middle">Экономия на рекламе</div>
                        <div class="reg_exp_page_1st_1_bot">Autotesmer уже потратился на рекламу и маркетинг, вам
                            остается только искать качественную технику для ваших клиентов!
                        </div>
                    </div>
                </div>
            </div>


        </div>

    </div>
    <div class="reg_exp_page_1st_2">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="reg_exp_page_3">
                        <h2>Как это работает?</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="reg_exp_page_1st_2_1">
                        <img src="<?= Url::to('@web/img/icons/regics/11.png') ?>" alt="">
                    </div>
                    <div class="reg_exp_page_1st_2_2">
                        <img src="<?= Url::to('@web/img/icons/regics/are.png') ?>" alt="">
                    </div>
                    <div class="reg_exp_page_1st_2_3">Станьте экспертом и заполните профиль</div>

                </div>
                <div class="col-md-4">
                    <div class="reg_exp_page_1st_2_1">
                        <img src="<?= Url::to('@web/img/icons/regics/22.png') ?>" alt="">
                    </div>
                    <div class="reg_exp_page_1st_2_2">
                        <img src="<?= Url::to('@web/img/icons/regics/are.png') ?>" alt="">
                    </div>
                    <div class="reg_exp_page_1st_2_3">Выберите заявку на подбор
                        и ответьте на нее
                    </div>

                </div>
                <div class="col-md-4">
                    <div class="reg_exp_page_1st_2_1">
                        <img src="<?= Url::to('@web/img/icons/regics/33.png') ?>" alt="">
                    </div>
                    <div class="reg_exp_page_1st_2_2">
                        <img src="<?= Url::to('@web/img/icons/regics/are.png') ?>" alt="">
                    </div>
                    <div class="reg_exp_page_1st_2_3">Получите оплату сразу после завершения задания</div>

                </div>
            </div>
        </div>
    </div>


    <?= PackagesForExperts::widget(['packages' => $packages])  ?>



</main>
