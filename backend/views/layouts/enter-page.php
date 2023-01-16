<?php
/**
 * Created by PhpStorm.
 * User: hustler
 * Date: 27.03.2019
 * Time: 15:11
 */
use backend\assets\AdminAsset;
use backend\assets\AdminLTE9Asset;
use yii\helpers\Html;
use yii\helpers\Url;


AdminAsset::register($this);
AdminLTE9Asset::register($this);
$this->beginPage();
?><!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="hold-transition login-page">
<?php $this->beginBody() ?>


<?= $content ?>




<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>