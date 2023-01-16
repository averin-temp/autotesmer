<?php
/**
 * Created by PhpStorm.
 * User: hustler
 * Date: 07.08.2019
 * Time: 0:13
 */

namespace common\classes;

use yii\base\Component;

class Oauth extends Component
{
    public $socialNetworks = [];

    /**
     * @param $network
     * @return null|object
     * @throws \yii\base\InvalidConfigException
     */
    public function get($network){
        if(isset($this->socialNetworks[$network])){
            $config = $this->socialNetworks[$network];
            return \Yii::createObject($config);
        }

        return null;
    }

    public function getSocials(){
        $socials = [];
        foreach($this->socialNetworks as $label => $config){
            $socials[$label] = \Yii::createObject($config);
        }
        return $socials;
    }


}