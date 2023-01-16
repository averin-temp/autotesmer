<?php
/**
 * Created by PhpStorm.
 * User: hustler
 * Date: 25.03.2019
 * Time: 21:49
 */

namespace common\models;

use yii\db\ActiveRecord;

/**
 * Class Group
 * @package common\models
 *
 * @property int  $id
 * @property string  $name
 */
class Group extends ActiveRecord
{
    /**
     * @return string
     */
    public static function tableName()
    {
        return 'groups';
    }

    public function rules()
    {
        return [
            [['name'], 'required']
        ];
    }


}