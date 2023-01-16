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
 * Class MailTemplate
 * @package common\models
 *
 * @property int $id
 * @property string $name
 * @property string $content
 *
 */
class MailTemplate extends ActiveRecord
{
    /**
     * @return string
     */
    public static function tableName()
    {
        return 'mail_templates';
    }

    public function rules()
    {
        return [
            [['content'], 'safe'],
            [['name'], 'required', 'message' => 'Укажите название шаблона']
        ];
    }

    /**
     * @param $user User
     * @return string
     */
    public function render($user, $promocode = null){

        $placeholders = [ '[username]', '[promocode]' ];
        $replace = [ $user->firstname, $promocode ];

        return str_replace($placeholders, $replace, $this->content);
    }

}