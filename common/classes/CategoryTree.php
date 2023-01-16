<?php
namespace common\classes;

use common\models\Category;
use yii\base\Model;

class CategoryTree extends Model
{

    public static $tree = [];
    public static $index;
    public static $list = [];

    public static function &getTree(){

        if(empty(self::$tree))
        {
            self::$index = Category::find()->indexBy('id')->asArray()->all();

            foreach(self::$index as &$category){
                if($category['parent_id']){
                    $parent = &self::$index[$category['parent_id']];
                    $category['parent'] = &$parent;
                    if(!isset($parent['childrens'])){
                        $parent['childrens'] = [];
                    }
                    $parent['childrens'][$category['id']] = &$category;
                } else {
                    self::$tree[$category['id']] = &$category;
                }
            }
        }

        return self::$tree;
    }

    public static function getList(){
        if(empty(self::$list)){
            $tree = self::getTree();
            self::toList($tree);
        }
        return self::$list;
    }

    public static function toList(&$categories, $level = 0){

        foreach($categories as &$category){
            self::$list[] = [ 'level' => $level ,'category' => $category ];
            if(isset($category['childrens']))
                self::toList($category['childrens'], $level + 1);
        }
    }




}