<?php
namespace emulator\models;

use yii\db\ActiveRecord;

class Payment extends ActiveRecord
{
    public static function tableName()
    {
        return 'payment';
    }

    public function getData()
    {
        return json_decode($this->order_data,true);
    }

    public function setData($data)
    {
        $this->order_data =  json_encode($data);
    }
}