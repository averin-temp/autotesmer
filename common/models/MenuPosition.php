<?php

namespace common\models;

use yii\db\ActiveRecord;

/**
 * Class MenuPosition
 * @package common\models
 *
 * @property $id int
 * @property $menus Menu[]
 */
class MenuPosition extends ActiveRecord
{
    public static function tableName()
    {
        return 'menu_positions';
    }

    /**
     * @return \yii\db\ActiveQuery
     * @throws \yii\base\InvalidConfigException
     */
    public function getMenus(){
        return $this->hasMany(Menu::class,['id' => 'menu_id'])
            ->viaTable('menu_position', ['position_id' => 'id']);
    }
}