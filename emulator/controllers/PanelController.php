<?php

namespace emulator\controllers;

use emulator\models\Card;
use emulator\models\Payment;
use emulator\models\Payout;
use yii\db\Query;
use yii\web\Controller;
use yii\web\ServerErrorHttpException;

/**
 * Main emulator controller
 */
class PanelController extends Controller
{
    public function actionIndex(){
        $payments = Payment::find()->all();
        $payouts = Payout::find()->all();
        $cards = Card::find()->all();
        
        return $this->render('panel', [
            'payments' => $payments,
            'payouts' => $payouts,
            'cards' => $cards
        ]);
    }

    public function actionClear()
    {
        Payment::deleteAll();
        Card::deleteAll();
        Payout::deleteAll();

        return 'OK';
    }

}