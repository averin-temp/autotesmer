<?php

namespace frontend\assets;

use yii\web\AssetBundle;

class VerificationAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $js = [
        'js/verification.js',
    ];

    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
