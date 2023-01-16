<?php
/** @var $banners array */

?>

<div class="banners-wrapper">
<?php foreach($banners as $banner): /** @var $banner \common\models\Banner */ ?>
    <a href="<?= $banner->url ?>" target="_blank" class="adv_link">
        <img src="<?= $banner->getImageUrl() ?>" alt="">
    </a>
<?php endforeach; ?>
</div>




