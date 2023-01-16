<?php

use yii\helpers\Url;
use common\classes\PackageHelper;




?>


<div class="reg_exp_page_1st_3">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="reg_exp_page_3">
                    <h2>Пакеты для экспертов</h2>
                </div>
            </div>
        </div>
        <div class="reg_exp_page_1st_3_body">
            <div class="row">


                <?php foreach($packages as $package): /** @var \common\models\Package $package */?>
                <div class="col-md-five">
                    <div>

                        <div class="col-md-five_header">
                            <table>
                                <tr>
                                    <td>
                                        <?= $package->name ?>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-five_body">
                            <ul>
                                <?php /** @var  \common\models\PackageVariant $packageVariant */
                                      foreach($package->variants as $packageVariant):

                                          $icons = [];

                                          if($packageVariant->includesServices([\common\models\Service::TYPE_FULL_SELECTION])){
                                              $icons[] = '<div class="service-icon icon-full-selection"></div>';
                                          }
                                          if($packageVariant->includesServices([\common\models\Service::TYPE_EXPERT_FOR_DAY])){
                                              $icons[] = '<div class="service-icon icon-expert-for-day"></div>';
                                          }
                                          if($packageVariant->includesServices([\common\models\Service::TYPE_ONE_TIME_INSPECTION])){
                                              $icons[] = '<div class="service-icon icon-one-time-inspection"></div>';
                                          }

                                          $icons = implode('<i class="icons-plus"></i>', $icons);

                                          ?>
                                <li>
                                    <div class="col-md-five_body_top">
                                        <div class="service-icons">
                                            <?= $icons ?>
                                        </div>
                                    </div>
                                    <div class="col-md-five_body_mid"><?= implode('<br> + ', PackageHelper::getServiceNames($packageVariant)) ?></div>
                                    <div class="col-md-five_body_bot"><?= $packageVariant->price . ' руб.' ?></div>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>

                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="reg_exp_page_3">
                    <h4>Все новые эксперты получают бесплатный доступ в течение 3-х месяцев</h4>
                </div>
                <div class="mp_main_bot">
                    <a class="button button_orange button_top_img" href="<?= Url::to('/registration/step2') ?>">Стать экспертом</a>
                </div>
            </div>
        </div>
    </div>
</div>
