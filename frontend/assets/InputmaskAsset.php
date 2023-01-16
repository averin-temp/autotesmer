<?php

namespace frontend\assets;

use yii\web\AssetBundle;

class InputmaskAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $js = [
        'plugins/input-mask/jquery.inputmask.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset'
    ];
}
