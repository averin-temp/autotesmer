<?php

/** @var $this \yii\web\View */
/** @var $cities array */
/** @var $langs array */
/** @var $city array */
/** @var $lang array */

use yii\helpers\Url;


?>


<ul class="navbar-nav  main_menu_ul top_lang_region header-city-select">
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" role="button"
           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?= $city['name'] ?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="#"><?= $city['name'] ?></a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item city-0" href="<?= Url::to(['site/city', 'id' => 0 ]) ?>">Все города</a>
            <?php foreach($cities as $city): ?>
                <a class="dropdown-item city-<?= $city['id'] ?>" href="<?= Url::to(['site/city', 'id' => $city['id'] ]) ?>"><?= $city['name'] ?></a>
            <?php endforeach; ?>
        </div>
    </li>
    <!--li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" role="button"
           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?= strtoupper($lang['abbr']) ?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="#">Ru</a>
            <div class="dropdown-divider"></div>
            <?php foreach($langs as $lang): ?>
                <a class="dropdown-item" href="<?= Url::to(['site/lang', 'id' => $lang['id'] ]) ?>"><?= $lang['label'] ?></a>
            <?php endforeach; ?>
        </div>
    </li-->
</ul>
