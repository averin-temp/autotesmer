<?php
/**
 * @var $this \yii\web\View
 * @var $client \common\models\User
 */

use yii\web\View;
use yii\helpers\Url;

$client = \Yii::$app->user->identity;

?>
<div class="lk_left">
    <div class="lk_left_nav">
        <ul>
            <li<?= $menu == 'contacts' ? ' class="active"' : '' ?>><a href="<?= Url::to(['/lk/contacts']) ?>">Контактная информация</a></li>
            <li<?= $menu == 'orders' ? ' class="active"' : '' ?>><a href="<?= Url::to(['/lk/current']) ?>">Мои заказы</a></li>
            <li<?= $menu == 'experts' ? ' class="active"' : '' ?>><a href="<?= Url::to(['/lk/experts']) ?>">Избранные эксперты</a></li>
            <li<?= $menu == 'settings' ? ' class="active"' : '' ?>><a href="<?= Url::to(['/lk/settings']) ?>">Настройки</a></li>
            <li<?= $menu == 'notices' ? ' class="active"' : '' ?>><a href="<?= Url::to(['/lk/noticesoptions']) ?>">Уведомления</a></li>
            <li<?= $menu == 'cards' ? ' class="active"' : '' ?>><a href="<?= Url::to(['/lk/cards']) ?>">Карты</a></li>
        </ul>
    </div>
    <div class="lk_left_body">
        <div class="lk_left_body_photo">
            <form id="form-upload-photo" action="" method="post" enctype="multipart/form-data">
                <label for="upload-photo">
                    <input id="upload-photo" name="image" type="file">
                    <img id="userpic" class="lk_left_body_photo_top" src="<?= $client->getAvatar() ?>">
                </label>
            </form>

        <div class="lk_left_body_photo_middle">Загрузите вашу фотографию</div>
        <div class="lk_left_body_photo_bot">(Минимальный размер:
            180×180 px)
        </div>
    </div>
    <div class="lk_left_body_name"><?= $client->firstname . ' ' . $client->lastname ?></div>
    <div class="lk_left_body_info">
        <div class="lk_left_body_info_header">Информация</div>
        <div class="lk_left_body_info_body">
            <ul>
                <li>Возраст: <span><?= $client->age ? $client->age . ' лет' : 'не указан' ?></span></li>
                <li>Город: <span><?= $client->city->name ?></span></li>
                <li>Кол-во опубликованных
                    заявок: <span><?= $client->ordersTotalCount ?></span></li>
            </ul>

        </div>
        <div class="lk_left_body_info_prof">
            <a href="<?= Url::to(['lk/settings']) ?>">Редактировать профиль</a>
        </div>
    </div>
</div>
<?php
$upload_url = Url::to(['client/image']);
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
