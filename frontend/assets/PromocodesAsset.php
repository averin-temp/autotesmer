<?php

namespace frontend\assets;

use yii\web\AssetBundle;

class PromocodesAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $js = [
        'js/promocode.js',
    ];

    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
