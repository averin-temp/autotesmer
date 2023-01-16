<?php

namespace frontend\assets;

use yii\web\AssetBundle;

class SliderAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $js = [
        'js/slider.js',
    ];

    public $css = [
        'css/slider.css'
    ];

    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
