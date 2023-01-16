<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $name;
?>

<main>
    <div class="welcome_page">
        <div class="container h-100">
            <div class="row h-100 justify-content-center align-items-center">
                <div class="col-md-12 text-center">
                    <h1><?= nl2br(Html::encode($message)) ?></h1>
                    <p>
                        The above error occurred while the Web server was processing your request.
                    </p>
                    <p>
                        Please contact us if you think this is a server error. Thank you.
                    </p>
                    <div class="wspam2" style="margin-top: 50px">
                        <a class="button button_orange button_top_img" href="<?= Url::home() ?>">На главную</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>