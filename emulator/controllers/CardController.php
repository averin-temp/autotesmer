<?php

namespace emulator\controllers;

use common\helpers\CurlHelper;
use emulator\models\Card;
use yii\db\Query;
use yii\web\Controller;
use yii\web\ServerErrorHttpException;

/**
 * Main emulator controller
 */
class CardController extends Controller
{

    /**
     * @return string
     * @throws \yii\db\Exception
     */
    public function actionRegister(){


        $card = new Card();
        $card->load(\Yii::$app->request->post());
        $card->save();

        return $this->redirect(['/panel']);
    }

    public function actionReply()
    {

        $RequestID = \Yii::$app->request->post('RequestID');

        $card = Card::findOne($RequestID);

        $data = [
            'RequestID' => $card->RequestID,
            'Token' => "ASDJKOLWIJPWQASD",
            'CardMask' => '4111-2222-3333-1111',
            'Timestamp' => date('Y-m-d H:i:s'),
        ];

        $baseFields = $data;
        unset($baseFields['Timestamp']);

        ksort($baseFields);

        $baseString = '';
        foreach($baseFields as $value){
            $baseString .= $value;
        }

        $data['Signature'] = md5($baseString);

        $result = CurlHelper::post('http://autotesmer-test.local/card/register', $data);

        return $this->redirect(['/panel']);


    }

}