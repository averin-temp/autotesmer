<?php
/** @var $this \yii\web\View */
/** @var $payment \common\models\Payment */
/** @var $promocodeUrl string */

use frontend\assets\PromocodesAsset;
use common\models\Payment;

PromocodesAsset::register($this);

?>

<main>
    <div class="container">
        <div class="row" style="padding: 50px 0;">
            <div class="col-md-12">
                <div class="content">

                    <?php  if($payment->type == Payment::TYPE_RESERVE): ?>
                        <h2>Резервирование средств на выплату вознаграждения за сделку.</h2>
                        <p>Эксперт: <?= (\common\models\Dial::findOne($payment->target))->expert->fullName() ?></p>
                        <p>Cумма: <span><?= $payment->sum ?></span></p>
                    <?php endif; ?>


                    <?php if($payment->type == Payment::TYPE_PACKAGE_PAYMENT) : ?>
                        <h2>Оплата пакета "<?= (\common\models\UserPackage::findOne($payment->target))->packageVariant->name ?>"</h2>
                        <p>Cумма: <span><?= $payment->sum ?></span></p>
                    <?php endif; ?>



                    <?php if($payment->type == Payment::TYPE_PACKAGE_EXTENSION) : ?>
                        <h2>Оплата продления пакета "<?= (\common\models\UserPackage::findOne($payment->target))->packageVariant->name ?>"</h2>
                        <p>Cумма: <span><?= $payment->sum ?></span></p>
                    <?php endif; ?>


                    <?php if($payment->promocode): ?>
                        <p>Применен промокод <?= $payment->promocode->set ?></p>
                        <p><?= $payment->promocode->code ?></p>
                        <p><?= $payment->base_sum ?> - <?= $payment->discount * 100 ?>%  </p>
                    <?php  endif; ?>

                    <?php if($payment->hasErrors('promocode')): ?>
                    <div class="promocode-error"><?= $payment->getFirstError('promocode'); ?></div>
                    <?php endif; ?>

                    <?php if($payment->canSetPromocode()): ?>
                    <div class="promo">
                        <button id="have-promocode" class="have-promocode-button">У меня есть промокод!</button>
                        <form class="promocode-form" action="<?= \yii\helpers\Url::to(['/payment', 'id' => $payment->id ]) ?>" method="get">
                            <input type="text" name="promocode" value="<?= $payment->promocode ?>">
                            <button>Применить промокод</button>
                        </form>
                    </div>
                    <?php endif; ?>

                    <button id="submit-payment" data-payment="<?= $payment->id ?>" >Оплатить</button>

                </div>
            </div>
        </div>
    </div>
</main>


