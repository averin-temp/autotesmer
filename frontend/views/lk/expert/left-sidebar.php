<?php
/** @var $this \yii\web\View */

use yii\helpers\Url;
use yii\web\View;

/** @var \common\models\User $expert */
$expert = \Yii::$app->user->identity;

?>
<div class="lk_left">
    <div class="lk_left_nav">
        <ul>
            <li<?= $menu == 'contacts' ? ' class="active"' : '' ?>><a href="<?= Url::to(['/lk/contacts']) ?>">Контактная информация</a></li>
            <li<?= $menu == 'video' ? ' class="active"' : '' ?>><a href="<?= Url::to(['/lk/video']) ?>">Мои видео</a></li>
            <li<?= $menu == 'works' ? ' class="active"' : '' ?>><a href="<?= Url::to(['/lk/requests']) ?>">Мои заявки</a></li>
            <li<?= $menu == 'packages' ? ' class="active"' : '' ?>><a href="<?= Url::to(['/lk/packages']) ?>">Пакеты</a></li>
            <li<?= $menu == 'settings' ? ' class="active"' : '' ?>><a href="<?= Url::to(['/lk/settings']) ?>">Настройки</a></li>
        </ul>
    </div>
    <div class="lk_left_body">
        <div class="lk_left_body_photo">
            <form id="form-upload-photo" action="" method="post" enctype="multipart/form-data">
                <label for="upload-photo">
                    <input id="upload-photo" name="image" type="file">
                    <img id="userpic" class="lk_left_body_photo_top" src="<?= $expert->getAvatar() ?>">
                </label>
            </form>
        <div class="lk_left_body_photo_middle">Загрузите вашу фотографию </div>
        <div class="lk_left_body_photo_bot">(Минимальный размер:
            180×180 px)</div>
    </div>
    <div class="lk_left_body_name"><?= $expert->firstname . ' ' . $expert->lastname ?></div>
    <div class="lk_left_body_info">
        <div class="lk_left_body_info_header">Информация</div>
        <div class="lk_left_body_info_body">
            <ul>
                <li>Возраст:   <span><?= $expert->age ? $expert->age . ' лет' : 'не указан' ?></span></li>
                <li>Город:   <span><?= $expert->city->name ?></span></li>
                <li>Кол-во выполненных<br>
                    заявок:   <span><?= $expert->completedOrdersCount ?></span></li>
                <li>В избранном:   <span><?= count($expert->electedBy()) ?></span></li>
                <li>Рейтинг:   <span><?= $expert->rating ?></span></li>




                <li>
                    <div class="r_top_experts_inner_rew">
                        Отзывы:
                        <span class="r_top_experts_inner_rew_r_plus"><a href="<?= Url::to(['/profile/reviews', 'id' => $expert->id, 'param' => 'pos' ]) ?>">+ <?= $expert->positiveReviewsCount() ?></a></span>
                        <span class="r_top_experts_inner_rew_r_netral"><a href="">0</a></span>
                        <span class="r_top_experts_inner_rew_r_minus"><a href="<?= Url::to(['/profile/reviews', 'id' => $expert->id, 'param' => 'neg' ]) ?>">- <?= $expert->negativeReviewsCount() ?></a></span>
                    </div>
                </li>
            </ul>

        </div>
        <div class="lk_left_body_info_prof">
            <a href="<?= Url::to(['lk/settings']) ?>">Редактировать профиль</a>
        </div>


        <?php if(\Yii::$app->PayU->emulation): ?>
            <a href="<?= Url::to(['/payuemul/panel']) ?>">Панель эмулятора</a>
        <?php endif; ?>


    </div>
</div>
<?php
$upload_url = Url::to(['expert/image']);
$script = <<< JS
$('#upload-photo').change(function(){
    let image = document.getElementById('userpic');
    let form = document.getElementById('form-upload-photo');
    let data = new FormData(form);
    $.ajax({
        url: "$upload_url",
        type: "POST",
        data: data,
        processData: false,
        contentType: false,
        dataType: 'json'
    }).done(function(response){
        if('errors' in response)
            alert(response.errors);
        else{
            document.getElementById('header-avatar').src = image.src = response.imageSource;
        }
    });
    
});
JS;

$this->registerJS($script,View::POS_READY, 'side-panel-script');