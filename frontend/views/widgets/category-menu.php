<?php

/** @var $active int  */
/** @var $categories array */

use common\classes\OrderCategory;
use yii\helpers\Url;

?>
<div class="lk_left_nav">
    <ul>
        <li<?= 'all' == $active ? ' class="active"' : '' ?>><a href="<?= Url::current(['category' => 'all']) ?>">Все</a></li>
        <?php foreach($categories as $category_id => $info): ?>
            <li<?= $category_id == $active ? ' class="active"' : '' ?>><a href="<?= Url::current(['category' => $category_id]) ?>"><?= $info['label'] ?></a></li>
        <?php endforeach; ?>
    </ul>
</div>