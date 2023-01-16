<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Invite frontend application asset bundle.
 */
class InviteAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        '//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css',
        'css/fonts.css',
        'css/invite.css',
    ];

    public $js = [];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
