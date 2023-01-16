<?php

namespace frontend\assets;

use yii\web\AssetBundle;

class ChatAsset extends AssetBundle
{
    public $sourcePath = '@common/resources/chat';

    public $css = [
        'style.css'
    ];

    public $js = [
        'chat.js',
    ];

    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
