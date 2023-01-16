<?php
/**
 * Created by PhpStorm.
 * User: hustler
 * Date: 06.05.2019
 * Time: 1:47
 */

namespace frontend\widgets;


use common\models\User;
use yii\base\Widget;

class ProfileUserPanel extends Widget
{
    /** @var $expert User */
    public $expert;

    public function run()
    {
        $show_add_favorite_button = false;
        $show_offer_button = false;

        if(!\Yii::$app->user->isGuest){
            /** @var User $user */
            $user = \Yii::$app->user->identity;
            if($user->can('Клиент')){
                $show_offer_button = true;
                if(!$user->hasFavorite($this->expert->id)){
                    $show_add_favorite_button = true;
                }
            }
        }

        return $this->render('//widgets/profile-user-panel', [
            'expert' => $this->expert,
            'show_add_favorite_button' => $show_add_favorite_button,
            'show_offer_button' => $show_offer_button,
        ]);
    }

}