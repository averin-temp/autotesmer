<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class NiceScrollAsset extends AssetBundle
{
    public $sourcePath = '@common/resources/nicescroll';

    public $js = [
        'jquery.nicescroll.js',
    ];

    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
