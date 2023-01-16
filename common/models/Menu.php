<?php
/**
 * Created by PhpStorm.
 * User: hustler
 * Date: 25.03.2019
 * Time: 21:49
 */

namespace common\models;

use yii\db\ActiveRecord;
use yii\db\Query;
use yii\helpers\Url;

/**
 * Class Menu
 * @package common\models
 *
 * @property $id int
 * @property $name string
 * @property $positions string|array
 * @property $items MenuItem[]
 */
class Menu extends ActiveRecord
{
    /**
     * @return string
     */
    public static function tableName()
    {
        return 'menu';
    }

    public function rules()
    {
        return [
            [['name'], 'required', 'message' => 'Укажите название меню'],
        ];
    }


    /**
     * Назначает позиции для меню
     *
     * @param $data
     * @throws \yii\db\Exception
     */
    public function setPositions($data = []){
        if($data == null) return;
        $data = array_map('intval',$data);

        $positions = [];
        foreach($data as $position_id){
            $positions[] = [ $this->id, $position_id ];
        }

        \Yii::$app->db->createCommand()
            ->batchInsert('menu_position', ['menu_id','position_id'], $positions)
            ->execute();
    }


    /**
     *  Удаляет все пункты меню
     */
    public function deleteItems(){
        MenuItem::deleteAll(['menu_id' => $this->id]);
    }


    /**
     * @return bool
     * @throws \yii\db\Exception
     */
    public function beforeDelete()
    {
        $this->deleteItems();
        $this->clearPositions();
        return parent::beforeDelete();
    }

    /**
     * @throws \yii\db\Exception
     */
    public function clearPositions(){
        \Yii::$app->db->createCommand()
            ->delete('menu_position', ['menu_id' => $this->id])
            ->execute();
    }

    /**
     * Возвращает пункты меню
     *
     * @return \yii\db\ActiveQuery
     */
    public function getItems(){
        return $this->hasMany(MenuItem::class, ['menu_id' => 'id'])->orderBy('order');
    }

    /**
     * @return null
     */
    public function getActiveItem(){

        $currentUrl = Url::current();

        foreach($this->items as $item){
            /** @var $item MenuItem */
            if($currentUrl == $item->url)
                return $item->id;
        }

        return null;
    }

    /**
     * @return \yii\db\ActiveQuery
     * @throws \yii\base\InvalidConfigException
     */
    public function getPositions(){
        return $this->hasMany(MenuPosition::class,['id' => 'position_id'])
            ->viaTable('menu_position', ['menu_id' => 'id']);
    }

}