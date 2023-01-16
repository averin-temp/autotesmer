<?php
namespace emulator\models;

use yii\db\ActiveRecord;

class Payout extends ActiveRecord
{
    public static function tableName()
    {
        return 'payout';
    }

    public function formName()
    {
        return '';
    }

    public function rules()
    {
        return [
            [['outerId','status', 'token'], 'safe'],
        ];
    }


    public static function statuses()
    {
        return [
            1 => 'PENDING',
            2 => 'ABORTED',
            3 => 'CANCELLED',
            4 => 'FINALIZED',
        ];
    }
}