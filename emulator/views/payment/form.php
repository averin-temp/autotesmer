<?php
/** @var $this \yii\web\View */
/** @var $formdata array */

use yii\helpers\Url;

?>

<style>

    .wrapper-x1{
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    button.btn-x1, a.btn-x1{
        display:inline-block;
        padding:0.7em 1.4em;
        margin:10px 0.3em 0.3em 10px;
        border: 0;
        border-radius:0.15em;
        box-sizing: border-box;
        text-decoration:none;
        font-family:'Roboto',sans-serif;
        text-transform:uppercase;
        font-weight:400;
        color:#FFFFFF;
        background-color:#3369ff;
        box-shadow:inset 0 -0.6em 0 -0.35em rgba(0,0,0,0.17);
        text-align:center;
        position:relative;
        cursor: pointer;
    }
    button.btn-x1:active, a.btn-x1:active{
        top:0.1em;
    }
    @media all and (max-width:30em){
        button.btn-x1, a.btn-x1{
            display:block;
            margin:0.4em auto;
        }
    }

</style>

<div class="wrapper-x1">

    <h1>Эта страница эмулирует платежную страницу PayU.</h1>

    <form action="<?= Url::to('save') ?>" method="post">

        <?php foreach($formdata as $field => $value):
            if(is_array($value)):

            $field .= '[]';
            $values = $value;
            foreach($values as $_value): ?>
                <input type="hidden" name="<?= $field ?>" value="<?= $_value ?>">
            <?php endforeach;

            else: ?>
                <input type="hidden" name="<?= $field ?>" value="<?= $value ?>">
        <?php endif;

        endforeach; ?>

        <button class="btn-x1">оплатить</button>
    </form>

    <a href="<?= Url::to(['/lk/packages_added']) ?>" class="btn-x1" style="background-color:#668fff"">передумать и уйти</a>
</div>