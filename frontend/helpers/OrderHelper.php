<?php

namespace frontend\helpers;

use yii\helpers\Url;

class OrderHelper {



    public static function rangeField($fromFieldName, $toFieldName, $label, $iconUrl, $sliderOptions){

        $lowVal = $sliderOptions['low'] ? $sliderOptions['low'] : $sliderOptions['min'];
        $highVal = $sliderOptions['hi'] ? $sliderOptions['hi'] : $sliderOptions['max'];

        ?>
        <div class="row range-auto-manual-fields">

            <div class="col-md-2">
                <div class="f_group">
                    <span class="f_group_labl">
                        <?php if($iconUrl) echo "<img src=\"$iconUrl\" alt=\"\">"; ?><?= $label ?>
                    </span>
                </div>
            </div>

            <div class="col-md-4">
                <div class="f_group">
                    <div class="slider-wrapper">
                        <input class="input-range" type="text"
                               data-step="<?= $sliderOptions['step'] ?>"
                               data-low="<?= $lowVal ?>"
                               data-hi="<?= $highVal ?>"
                               data-min="<?= $sliderOptions['min'] ?>"
                               data-max="<?= $sliderOptions['max'] ?>"
                               data-label="<?= $sliderOptions['label'] ?>"
                               data-split="true"
                        />
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="f_group range-fields">
                    <input id="<?= $fromFieldName ?>" type="number" max="<?= $sliderOptions['max'] ?>" min="<?= $sliderOptions['min'] ?>" placeholder="от" value="<?= $lowVal  ?>">
                    <input id="<?= $toFieldName ?>" type="number" max="<?= $sliderOptions['max'] ?>" min="<?= $sliderOptions['min'] ?>" placeholder="до" value="<?= $highVal ?>">
                </div>
            </div>
        </div>
        <?php
    }



}