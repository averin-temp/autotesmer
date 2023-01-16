<?php

namespace common\models;

use yii\db\ActiveRecord;

/**
 * Class File
 * @package common\models
 *
 * @property $id
 * @property $name
 * @property $title
 * @property $dest
 * @property $chat_id
 * @property $image
 *
 */
class File extends ActiveRecord
{
    /**
     * @return string
     */
    public static function tableName()
    {
        return 'files';
    }

    public function rules()
    {
        return [
            [['name', 'dest', 'chat_id'], 'safe']
        ];
    }


}