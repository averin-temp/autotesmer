<?php
/** @var $this \yii\web\View */
/** @var $user \common\models\User */

use yii\helpers\Url;

$action = $this->context->action->id;

?>

<ul class="nav nav-tabs">
    <li<?= $action == 'orders' ? " class=\"active\" " : '' ?>>
        <a href="<?= Url::to(['orders', 'id' => $user->id]) ?>">Заказы</a>
    </li>
    <li<?= $action == 'requests' ? " class=\"active\" " : '' ?>>
        <a href="<?= Url::to(['requests', 'id' => $user->id]) ?>">Заявки</a>
    </li>
    <li<?= $action == 'info' ? " class=\"active\" " : '' ?>>
        <a href="<?= Url::to(['info', 'id' => $user->id]) ?>">Информация</a>
    </li>
    <li<?= $action == 'settings' ? " class=\"active\" " : '' ?>>
        <a href="<?= Url::to(['settings', 'id' => $user->id]) ?>">Настройки</a>
    </li>
    <li<?= $action == 'video' ? " class=\"active\" " : '' ?>>
        <a href="<?= Url::to(['video', 'id' => $user->id]) ?>">Видео</a>
    </li>
    <li<?= $action == 'reviews' ? " class=\"active\" " : '' ?>>
        <a href="<?= Url::to(['reviews', 'id' => $user->id]) ?>">Отзывы</a>
    </li>
</ul>
