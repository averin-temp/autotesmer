<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class DateRangeAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'plugins/daterangepicker/daterangepicker-bs3.css',
    ];
    public $js = [
        'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js',
        'plugins/daterangepicker/daterangepicker.js',
    ];
    public $depends = [
        'yii\bootstrap\BootstrapAsset',
    ];
}
