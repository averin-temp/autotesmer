<?php
/**
 * Created by PhpStorm.
 * User: hustler
 * Date: 06.05.2019
 * Time: 0:12
 */

namespace frontend\widgets;

use common\models\City;
use Yii;
use yii\base\Widget;
use yii\db\Query;

class CityLangWidget extends Widget
{

    public function run(){


        $session = Yii::$app->session;
        $city_id = $session->get('city',City::defaultCity()->id);
        $lang_id = $session->get('lang', 1);

        if(!$city_id){
            $city = ['id' => 0, 'name' => 'Россия'];
        } else {
            $city =  (new Query())->from('city')->where(['id' => $city_id ])->one();
        }
        $lang =  (new Query())->from('langs')->where(['id' => $lang_id ])->one();

        $languages = (new Query())->from('langs')->all();
        $cities = (new Query())->from('city')->orderBy('name')->all();

        return $this->render('//widgets/city-lang', [
            'city' => $city,
            'lang' => $lang,
            'langs' => $languages,
            'cities' => $cities
        ]);
    }

}