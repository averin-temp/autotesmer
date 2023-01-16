<?php
/** @var $this \yii\web\View*/
/** @var $menus \common\models\Menu[] */

use yii\helpers\Url;

foreach($menus as $menu) { ?>
    <ul>
        <?php foreach($menu->items as $item):
            /** @var $item \common\models\MenuItem */
            if($item->name == "Личный кабинет") {
                ?><li><a href="<?= \Yii::$app->user->isGuest ? Url::to(['/login']) : Url::to('/lk') ?>"><i class="fa fa-angle-right"></i><span>Личный кабинет</span></a></li><?php
                continue;
            }
        ?>
        <li><a href="<?= Url::to($item->url) ?>"><i class="fa fa-angle-right"></i><span><?= $item->name ?></span></a></li>
        <?php endforeach; ?>
    </ul>
<?php }




