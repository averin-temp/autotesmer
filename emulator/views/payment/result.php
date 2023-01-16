<?php
/** @var $this \yii\web\View */
/** @var string $successUrl */
/** @var string $errorUrl */

?>

<style>
    html,
    body {
        height: 100%;
    }

    body {
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 0;
        background: linear-gradient(45deg, #49a09d, #5f2c82);
        font-family: sans-serif;
        font-weight: 100;
    }

    a.btn-x2{
        display:inline-block;
        padding:0.7em 1.7em;
        margin:0 0.3em 0.3em 0;
        border:0;
        border-radius:0.2em;
        box-sizing: border-box;
        text-decoration:none;
        font-family:'Roboto',sans-serif;
        font-weight:400;
        color:#FFFFFF;
        background-color:#3369ff;
        box-shadow:inset 0 -0.6em 1em -0.35em rgba(0,0,0,0.17),inset 0 0.6em 2em -0.3em rgba(255,255,255,0.15),inset 0 0 0em 0.05em rgba(255,255,255,0.12);
        text-align:center;
        position:relative;
        cursor: pointer;
    }

    a.btn-x2:active{
        box-shadow:inset 0 0.6em 2em -0.3em rgba(0,0,0,0.15),inset 0 0 0em 0.05em rgba(255,255,255,0.12);
    }

</style>

    <div style="display: flex">
        <a class="btn-x2 success" href="<?= $urlSuccess ?>">Успешная оплата</a>
        <a class="btn-x2 fail" href="<?= $urlError ?>">Ошибка</a>
    </div>


