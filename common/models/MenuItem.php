<?php
/**
 * Created by PhpStorm.
 * User: hustler
 * Date: 31.10.2019
 * Time: 19:21
 */

namespace common\models;


use yii\db\ActiveRecord;
use yii\helpers\Url;

/**
 * Class MenuItem
 * @package common\models
 *
 * @property $id int
 * @property $menu_id int
 * @property $order int
 * @property $name int
 * @property $menu Menu
 * @property $url string
 */
class MenuItem extends ActiveRecord
{
    public static function tableName()
    {
        return 'menu_items';
    }

    public function rules()
    {
        return [
            [['menu_id'], 'required', 'message' => 'не указан menu ID'],
            [['name'], 'required', 'message' => 'Укажите название пункта'],
            [['url'], 'required', 'message' => 'Укажите url пункта'],
            [['order'], 'number', 'message' => 'Укажите числовое значение'],
        ];
    }


    public function getMenu(){
        return $this->hasOne(Menu::class, ['id' => 'menu_id']);
    }


    public function getClearUrl(){
        if(Url::isRelative($this->url)) return Url::to([$this->url]);
        return $this->url;
    }



}