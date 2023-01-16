<?php

namespace frontend\assets;

use yii\web\AssetBundle;

class ReportAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $js = [
        'js/report.js',
    ];

    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
