<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        '//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css',
        'css/style.css',
        'css/fonts.css',
        'css/media.css',
    ];

    public $js = [
        'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js',
        'js/common.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'frontend\assets\NiceScrollAsset'
    ];
}
