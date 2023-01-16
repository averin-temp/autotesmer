<?php
/** @var $this \yii\web\View */
/** @var $user \common\models\User */

use yii\helpers\Url;

$action = $this->context->action;

?>

<ul class="nav nav-tabs">
    <li<?= $action == 'orders' ? " class=\"active\" " : '' ?>>
        <a href="<?= Url::to(['orders', 'id' => $user->id]) ?>">Заказы</a>
    </li>
    <li<?= $action == 'settings' ? " class=\"active\" " : '' ?>>
        <a href="<?= Url::to(['settings', 'id' => $user->id]) ?>">Настройки</a>
    </li>
</ul>
