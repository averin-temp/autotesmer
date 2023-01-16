<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class ICheckAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'plugins/iCheck/all.css',
    ];
    public $js = [
        'plugins/iCheck/icheck.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
