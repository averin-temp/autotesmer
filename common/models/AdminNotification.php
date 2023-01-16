<?php
namespace common\models;


use yii\db\ActiveRecord;

/**
 * Class AdminNotification
 * @package common\models
 *
 *
 * @property int $id
 * @property string $content
 * @property string $time
 * @property int $viewed
 * @property int $target_id
 */
class AdminNotification extends ActiveRecord{

    /**
     * @return string
     */
    public static function tableName()
    {
        return 'admin_notification';
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['content', 'viewed' ], 'safe'],
        ];
    }

    public static function send($content)
    {
        $adminIDs = \Yii::$app->authManager->getUserIdsByRole("Администратор");
        foreach($adminIDs as $id){
            $new = new self(['target_id' => $id, 'content' => $content]);
            $new->save(false);
        }
    }


}