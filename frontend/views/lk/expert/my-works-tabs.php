<?php
/** @var $this \yii\web\View */

use yii\helpers\Url;

$action = $this->context->action->id;

?>

<div class="lk_expert_body_packejes_tabs">
    <ul>
        <li<?= $action == 'new'     ? ' class="active"' : '' ?>><a href="<?= Url::to(['/lk/new']) ?>">Новая</a></li>
        <li<?= $action == 'current'      ? ' class="active"' : '' ?>><a href="<?= Url::to(['/lk/current']) ?>">В работе</a></li>
        <li<?= $action == 'completed'   ? ' class="active"' : '' ?>><a href="<?= Url::to(['/lk/completed']) ?>">Завершенные</a></li>
        <li<?= $action == 'disputes' || $action == 'dispute'   ? ' class="active"' : '' ?>><a href="<?= Url::to(['/lk/disputes']) ?>">Арбитраж</a></li>
    </ul>
</div>
