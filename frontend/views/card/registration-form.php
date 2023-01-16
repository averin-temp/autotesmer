<?php
/** @var $this \yii\web\View */
/** @var $user \common\models\User */
/** @var $fields array */
/** @var string $formUrl */

?>

<form action="<?= $formUrl ?>" method="post">
    <?php foreach( $fields as $field => $value): ?>
        <input type="hidden" name="<?= $field ?>" value="<?= $value ?>">
    <?php endforeach; ?>
    <button>Привязать карту</button>
</form>
