<?php

use frontend\widgets\LastClosedWidget;
use frontend\widgets\LastVideosWidget;
use frontend\widgets\LastReviewsWidget;
use frontend\widgets\BannersWidget;
use frontend\widgets\TopExpertsWidget;
use frontend\widgets\ChosenExpertsWidget;

?>
<main>
    <div class="container">
        <div class="row" style="padding: 50px 0;">
            <div class="col-md-9">

                <div class="content_how_to_work">
                    <div class="content_how_to_work_header content_header">Как это работает?</div>

                    <div class="steps_conts row justify-content-md-center">
                        <div class="col-md-4 text-right"><img src="/img/icons/how/how1.jpg" alt=""></div>
                        <div class="col-md-1"><img src="/img/icons/pluses/step1.png" alt=""></div>
                        <div class="col-md-4 text-left">
                            <div class="steps_text">
                                <div class="steps_text_top">01</div>
                                <div class="steps_text_mid">Оставьте заявку</div>
                                <div class="steps_text_bot">И с вами свяжутся профессиональные эксперты</div>
                            </div>
                        </div>
                    </div>
                    <div class="steps_conts row justify-content-md-center">
                        <div class="col-md-4 text-right">
                            <img class="mob_block" src="/img/icons/how/how2.jpg" alt="">
                            <div class="steps_text">
                                <div class="steps_text_top">02</div>
                                <div class="steps_text_mid">Заключите безопасную сделку</div>
                                <div class="steps_text_bot">И не переживайте за свои деньги</div>
                            </div>
                        </div>
                        <div class="col-md-1"><img src="/img/icons/pluses/step2.png" alt=""></div>
                        <div class="col-md-4 text-left"><img class="no_mob_block" src="/img/icons/how/how2.jpg" alt="">
                        </div>
                    </div>
                    <div class="steps_conts row justify-content-md-center">
                        <div class="col-md-4 text-right"><img src="/img/icons/how/how3.jpg" alt=""></div>
                        <div class="col-md-1"><img src="/img/icons/pluses/step1.png" alt=""></div>
                        <div class="col-md-4 text-left">
                            <div class="steps_text">
                                <div class="steps_text_top">03</div>
                                <div class="steps_text_mid">Получайте отчеты</div>
                                <div class="steps_text_bot">По утвержденной форме в удобном для Вас формате</div>
                            </div>
                        </div>
                    </div>
                    <div class="steps_conts row justify-content-md-center">
                        <div class="col-md-4 text-right">
                            <img class="mob_block" src="/img/icons/how/how4.jpg" alt="">
                            <div class="steps_text">
                                <div class="steps_text_top">04</div>
                                <div class="steps_text_mid">Уезжайте на проверенном авто</div>
                                <div class="steps_text_bot">Эксплуатируйте его долго и беспроблемно</div>
                            </div>
                        </div>
                        <div class="col-md-1"><img src="/img/icons/pluses/steplast.png" alt=""></div>
                        <div class="col-md-4 text-left"><img class="no_mob_block" src="/img/icons/how/how4.jpg" alt="">
                        </div>
                    </div>
                </div>


                <?= ChosenExpertsWidget::widget() ?>




                <div class="content_pluses_services">
                    <div class="content_pluses_header content_header">Преимущества сервиса</div>

                    <div class="row mb50">
                        <div class="col-md-4">
                            <div class="content_pluses_item">
                                <div class="content_pluses_item_top"
                                     style="background-image: url(/img/icons/pluses/ico1.png);"></div>
                                <div class="content_pluses_item_mid">Выгодные цены</div>
                                <div class="content_pluses_item_bot">Частный эксперт может предложить более выгодную
                                    цену за свои услуги, потому что у него нет дополнительных расходов на секретаря,
                                    офис и рекламу.
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="content_pluses_item">
                                <div class="content_pluses_item_top"
                                     style="background-image: url(/img/icons/pluses/ico2.png);"></div>
                                <div class="content_pluses_item_mid">Надежность</div>
                                <div class="content_pluses_item_bot">Эксперты Autotesmer проходят процедуру верификации
                                    своих компетенций, отзывы о работе проверяются, качество работы контролируется
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="content_pluses_item">
                                <div class="content_pluses_item_top"
                                     style="background-image: url(/img/icons/pluses/ico3.png);"></div>
                                <div class="content_pluses_item_mid">СКОРОСТЬ</div>
                                <div class="content_pluses_item_bot">Многие эксперты готовы приступить к работе
                                    незамедлительно. А также возможно, подходящий Вам автомобиль уже был проверен
                                    экспертом ранее
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-md-center">
                        <div class="col-md-4">
                            <div class="content_pluses_item">
                                <div class="content_pluses_item_top"
                                     style="background-image: url(/img/icons/pluses/ico4.png);"></div>
                                <div class="content_pluses_item_mid">безопасность</div>
                                <div class="content_pluses_item_bot">Выбирая работу через безопасную сделку вы
                                    гарантировано получаете отличный результат
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="content_pluses_item">
                                <div class="content_pluses_item_top"
                                     style="background-image: url(/img/icons/pluses/ico5.png);"></div>
                                <div class="content_pluses_item_mid">окупаемость</div>
                                <div class="content_pluses_item_bot">Эксперт знает и умеет как аргументировано вести
                                    торг, и ваши расходы на подбор практически всегда покрываются
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <?= LastClosedWidget::widget() ?>

                <?= LastVideosWidget::widget() ?>

                <?= LastReviewsWidget::widget() ?>


            </div>
            <div class="col-md-3">

                <?= TopExpertsWidget::widget() ?>

                <?= BannersWidget::widget(['position' => 1]) ?>
            </div>
        </div>
    </div>
</main>