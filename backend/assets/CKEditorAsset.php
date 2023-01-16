<?php

namespace backend\assets;

use yii\web\AssetBundle;
use yii\web\View;

/**
 * Main backend application asset bundle.
 */
class CKEditorAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [];
    public $jsOptions = [ 'position' => View::POS_END ];
    public $js = [
        'https://cdn.ckeditor.com/4.4.3/standard/ckeditor.js',
    ];
    public $depends = [];
}
