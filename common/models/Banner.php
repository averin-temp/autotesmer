<?php
/**
 * Created by PhpStorm.
 * User: hustler
 * Date: 25.03.2019
 * Time: 21:49
 */

namespace common\models;

use yii\base\Exception;
use yii\db\ActiveRecord;
use yii\db\Query;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\UploadedFile;

/**
 * Class Banner
 * @package common\models
 *
 * @property int $id
 * @property string $name
 * @property string $url
 * @property string $position
 * @property int $view_counter
 * @property int $order
 * @property array $groups
 * @property string $image
 * @property UploadedFile $uploadedImage
 */
class Banner extends ActiveRecord
{
    public $uploadedImage;
    public $_positions;
    public $_groups;

    /**
     * @return string
     */
    public static function tableName()
    {
        return 'banners';
    }

    public function rules()
    {
        return [

            [['name'], 'required', 'message' => 'Укажите название'],
            [['order'], 'required', 'message' => 'Укажите порядок'],
            [['url'], 'required', 'message' => 'Укажите url'],
            [['name', 'url'],'trim'],
            [['order'],'number', 'message' => 'Неверный формат. Укажите число'],

            [['uploadedImage'], 'image',
                'extensions' => ['jpg','png','gif'],
                'minWidth' => 1,
                'maxWidth' => 2000,
                'minHeight' => 1,
                'maxHeight' => 2000,
                'skipOnEmpty' => false,
            ],

            [['_positions', '_groups'], 'safe'],
        ];
    }

    public function getImageUrl(){

        if($this->image){
            return Url::to('@frontend-web/uploads/banners/') . $this->image;
        } else {
            return Url::to('@frontend-web/img/noimg.png');
        }
    }


    public function shown(){
        $this->updateCounters(['view_counter' => 1]);
    }


    public function saveImage(){

        if($this->uploadedImage){
            $name = uniqid() . time() . '.' . $this->uploadedImage->extension;
            $filename = \Yii::getAlias('@uploads/banners/') . $name;
            \Yii::warning($filename, __METHOD__ );
            $this->uploadedImage->saveAs($filename);
            $this->image = $name;
        }
    }

    public function getGroups(){
        return $this->hasMany(Group::class, ['id' => 'group_id'])
            ->viaTable('banner_group',['banner_id' => 'id']);
    }

    public function getPositions(){
        return (new Query())->from('banner_position')
            ->select('position')->where(['banner_id' => $this->id ])->column();
    }

    public function save($runValidation = true, $attributeNames = null)
    {
        if(parent::save($runValidation, $attributeNames)){

            try{

                if(!empty($this->_positions) && is_array($this->_positions)){
                    \Yii::$app->db->createCommand()
                        ->delete('banner_position', ['banner_id' => $this->id])->execute();
                    foreach($this->_positions as $position){
                        \Yii::$app->db->createCommand()
                            ->insert('banner_position', ['banner_id' => $this->id, 'position' => $position ])->execute();
                    }
                }

            } catch (Exception $e){
                $this->addError('_positions', $e->getMessage());
            }

            try{

                if(!empty($this->_groups) && is_array($this->_groups)){
                    \Yii::$app->db->createCommand()
                        ->delete('banner_group', ['banner_id' => $this->id])->execute();
                    foreach($this->_groups as $group_id){
                        \Yii::$app->db->createCommand()
                            ->insert('banner_group', [ 'banner_id' => $this->id, 'group_id' => intval($group_id) ])->execute();
                    }
                }

            } catch (Exception $e){
                $this->addError('_groups', $e->getMessage());
            }

            return !$this->hasErrors();
        }

        return false;
    }


    public static function positions(){
        $positions = [
            1 => 'Лэндинг - правая колонка',
            2 => 'Заказы - правая колонка',
            3 => 'Эксперты - правая колонка',
        ];

        return $positions;
    }

}