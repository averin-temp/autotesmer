<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 *
 */
class NotificationsAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $js = [
        'js/notifications.js',
    ];

    public $depends = [];
}
