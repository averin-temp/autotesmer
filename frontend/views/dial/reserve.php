<?php
/** @var $this \yii\web\View */
/** @var $payment \common\models\Payment */
/** @var $formFields string */
/** @var $url string */


?>
<main>
<div style="display: flex; flex-direction: column; justify-content: center; padding: 200px 100px">
    <p>Вы собираетесь зарезервировать средства ...</p>
    <form action="<?= $url ?>" method="post">
        <?= $formFields ?>
        <button type="submit">Внести</button>
    </form>
</div>
</main>
