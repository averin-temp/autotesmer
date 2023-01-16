<?php
/* @var $this \yii\web\View */
/* @var $items \common\models\MenuItem[] */
/* @var $current_active int */

?>

<ul class="navbar-nav mr-auto ml-auto main_menu_ul menul">
    <?php foreach($items as $item): $current = $item->id == $current_active  ?>
        <li class="nav-item<?= $current ? ' active' : '' ?>">
            <a class="nav-link" href="<?= $item->getClearUrl() ?>"><?= $item->name . ' ' . ($current ? ' <span class="sr-only">(current)</span>' : '') ?></a>
        </li>
    <?php endforeach; ?>
</ul>
