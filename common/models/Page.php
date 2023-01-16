<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * Page model
 *
 * @property string $content
 * @property string $url
 * @property string $name
 * @property int $category_id
 *
 *
 */
class Page extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pages';
    }

    public function rules()
    {
        return [
            [['content'], 'string', 'message' => 'неверное значение параметра'],
            [['url'], 'required', 'message' => 'Укажите url страницы'],
            ['url', 'validateUrl'],
            [['name'], 'required', 'message' => 'Укажите имя страницы'],
            [['category_id'], 'exist', 'targetClass' => Category::class, 'skipOnEmpty' => true,
                'targetAttribute' => 'id', 'message' => 'несуществующая категория'],
        ];
    }

    public function getCategory(){
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }


    public function validateUrl($attribute, $params){

        $this->$attribute = preg_replace ("/[^\w\/]/iu","", $this->$attribute);
        $this->$attribute = preg_replace ("/\/{2,}/","", $this->$attribute);

        if(Page::find()->where([ 'and' , ['url' => $this->$attribute],  [ '!=' , "id" , $this->id ] ])->one()){
            $this->addError($attribute, "Такой url уже используется");
            return false;
        }

        return true;
    }
}
