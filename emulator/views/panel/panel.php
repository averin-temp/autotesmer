<?php
/** @var $this \yii\web\View */
/** @var $payments \emulator\models\Payment[] */
/** @var $payouts \emulator\models\Payout[] */
/** @var $cards \emulator\models\Card[] */

use yii\helpers\Url;
?>

<style>
    html,
    body {
        height: 100%;
    }
    body {
        margin: 0;
        background: linear-gradient(45deg, #49a09d, #5f2c82);
        font-family: sans-serif;
        font-weight: 100;
    }
    .container {
        position: absolute;
        top: 50%;
        left: 50%;
        -webkit-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
    }
    table {
        width: 800px;
        border-collapse: collapse;
        overflow: hidden;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    }
    th,
    td {
        padding: 15px;
        background-color: rgba(255, 255, 255, 0.2);
        color: #fff;
    }
    th {
        text-align: left;
    }
    thead th {
        background-color: #55608f;
    }
    tbody tr:hover {
        background-color: rgba(255, 255, 255, 0.3);
    }
    tbody td {
        position: relative;
    }
    tbody td:hover:before {
        content: "";
        position: absolute;
        left: 0;
        right: 0;
        top: -9999px;
        bottom: -9999px;
        background-color: rgba(255, 255, 255, 0.2);
        z-index: -1;
    }


    button.btn-x2{
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
    button.btn-x2:active{
        box-shadow:inset 0 0.6em 2em -0.3em rgba(0,0,0,0.15),inset 0 0 0em 0.05em rgba(255,255,255,0.12);
    }
    @media all and (max-width:30em){
        button.btn-x2{
            display:block;
            margin:0.4em auto;
        }
    }

</style>



<div class="container">
    <table id="payment-table">
        <thead>
        <tr>
            <th colspan="7" style="text-align: center">Операции оплат</th>
        </tr>
        <tr>
            <th>ID</th>
            <th>Название операции</th>
            <th colspan="5" style="text-align: center">Вернуть статус операции</th>
        </tr>
        </thead>
        <tbody>

        <?php if(empty($payments)): ?>
            <tr>
                <td colspan="5">Нет операций</td>
            </tr>
        <?php endif; ?>

        <?php $counter = 1; foreach ($payments as $payment): ?>
            <tr class="row-<?= $counter++ ?>">
                <td><?= $payment->order_id ?></td>
                <td><?= $payment->description ?></td>
                <?php foreach(\emulator\helpers\PayUHelper::paymentStatuses() as $status => $description): ?>
                <td>
                    <form action="<?= Url::to(['/payment/reply']) ?>" method="post">
                        <input type="hidden" name="payment_id" value="<?= $payment->order_id ?>">
                        <input type="hidden" name="status" value="<?= $status ?>">
                        <button class="btn-x2" style="background-color:#2979FF"><?= $description ?> <?= $status ?> </button>
                    </form>
                </td>
                <?php endforeach; ?>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <table id="card-table">
        <thead>
        <tr>
            <th colspan="7" style="text-align: center">Запросы на привязку карты</th>
        </tr>
        <tr>
            <th>ID запроса</th>
            <th>ID клиента</th>
            <th colspan="5" style="text-align: center">Управление</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $action = Url::to(['/card/reply']); $counter = 1;
        foreach($cards as $card): ?>
        <tr class="row-<?= $counter++ ?>">
            <td><?= $card->RequestID ?></td>
            <td><?= $card->CardOwnerId ?></td>
            <td>
                <form action="<?= $action ?>" method="post">
                    <input name="RequestID" type="hidden" value="<?= $card->RequestID ?>">
                    <button>Отправить уведомление</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>


    <table id="payout-table">
        <thead>
        <tr>
            <th colspan="7" style="text-align: center">Выплаты на карты</th>
        </tr>
        <tr>
            <th>ID запроса</th>
            <th colspan="5" style="text-align: center">Управление</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $checkUrl = Url::to(['/payout/check']);  $counter = 1;
        foreach($payouts as $payout): ?>
            <tr class="row-<?= $counter++ ?>">
                <td><?= $payout->outerId ?></td>
                <?php foreach(\emulator\models\Payout::statuses() as $id => $status): ?>
                    <td>
                        <form action="<?= Url::to(['/payout/set', 'outerId' => $payout->outerId ]) ?>" method="post">
                            <input name="outerId" type="hidden" value="<?= $payout->outerId ?>">
                            <input name="status" type="hidden" value="<?= $id ?>">
                            <button><?= $status ?></button>
                        </form>
                    </td>
                <?php endforeach; ?>
            </tr>
        <?php endforeach; ?>
            <tr>
                <th colspan="7" style="text-align: center">
                    <form action="<?= $checkUrl ?>" method="post">
                        <button>Вызвать проверку статусов на сайте</button>
                    </form>
                </th>
            </tr>
        </tbody>
    </table>

</div>