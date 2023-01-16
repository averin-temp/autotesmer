<?php
namespace emulator\models;

use yii\db\ActiveRecord;

class Card extends ActiveRecord
{
    public static function tableName()
    {
        return 'card';
    }

    public function formName()
    {
        return '';
    }

    public function rules()
    {
        return [
            [['RequestID', 'CardOwnerId'], 'safe']
        ];
    }
}