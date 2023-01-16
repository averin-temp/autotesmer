<?php
/**
 * Created by PhpStorm.
 * User: hustler
 * Date: 27.09.2019
 * Time: 9:27
 */

namespace common\models;


use yii\db\ActiveRecord;

/**
 * Class Promocode
 * @package common\models
 *
 * @property PromocodesSet $set
 * @property $set_id    int
 * @property $code      string
 */
class Promocode extends ActiveRecord
{
    public static function tableName()
    {
        return 'promocodes';
    }

    /**
     *
     */
    public function spend(){
        $this->used = 1;
        $this->save(false);
    }

    public function activate(){
        $this->used = 0;
        $this->save(false);
    }

    public function getSet(){
        return $this->hasOne(PromocodesSet::class, ['id' => 'set_id']);
    }

}