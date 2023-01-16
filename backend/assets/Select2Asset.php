<?php

namespace backend\assets;

use yii\web\AssetBundle;
use yii\web\View;

/**
 * Main backend application asset bundle.
 */
class Select2Asset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [];
    public $jsOptions = [ 'position' => View::POS_READY ];
    public $js = [
        'plugins/select2/select2.full.min.js',
    ];
    public $depends = [];
}
