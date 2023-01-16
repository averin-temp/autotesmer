<?php
/**
 * Created by PhpStorm.
 * User: hustler
 * Date: 30.04.2019
 * Time: 19:59
 */

namespace common\models;


use yii\db\ActiveRecord;
use yii\db\Query;

class Category extends ActiveRecord
{

    public static function tableName()
    {
        return 'category';
    }

    public function rules()
    {
        return [
            [['name'], 'required', 'message' => "Укажите название категории"],
            [['parent_id'], 'validateParent'],
        ];
    }


    public function validateParent($attribute, $params){
        if($this->id == $this->$attribute){
            $this->addError($attribute, "Категория не может быть потомком самой себя");
        }
    }

    public function getParent(){
        return $this->hasOne(Category::class, ['id' => 'parent_id']);
    }


    public function beforeDelete()
    {
        \Yii::$app->db->createCommand()->update('category', ['parent_id' => 0], ['parent_id' => $this->id])->execute();
        return true;
    }


    public function getPages(){
        return $this->hasMany(Page::class, ['category_id' => 'id']);
    }


    /**
     * Возвращает категорию по имени
     *
     * @param $name
     * @return array|ActiveRecord|null
     */
    public static function getCategoryByName($name)
    {
        return Category::find()->where(['name' => $name])->one();
    }

}