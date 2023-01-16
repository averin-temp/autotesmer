<?php

namespace app\models;

use common\helpers\DataHelper;
use common\models\User;
use common\validators\PhoneValidator;
use yii\base\Model;
use yii\db\Query;

class UsersSearch extends Model
{
    public $city;
    public $groups = [];
    public $roles = [];
    public $family;
    public $firstname;
    public $lastname;
    public $phone;
    public $registration;

    public function rules()
    {
        return [
            [['city'], 'integer'],
            [['groups', 'phone', 'roles'], 'safe'],
            [['groups','roles'], 'default', 'value' => []],
            [['family', 'firstname', 'lastname'], 'trim'],
            [['registration'], function ($attribute, $params) {
                    if(!$this->unpackDates($this->$attribute)) {
                        $this->$attribute = null;
                        $this->addError($attribute, 'Неверный формат дат');
                    }
                }
            ],
        ];
    }

    /**
     * @param $params
     * @return array|\yii\db\ActiveRecord[]
     */
    public function search($params)
    {
        $query = User::find();

        if ($this->load($params,'') && $this->validate()) {

            $this->phone = DataHelper::onlyNumbers($this->phone);

            $query->andFilterWhere([ 'city_id'  => $this->city ]);

            if($this->groups){
                $subquery = (new Query())->select('user_id')->from('user_group')->where(['group_id' => $this->groups ]);
                $query->andFilterWhere([ 'id' => $subquery ]);
            }

            if($this->roles){
                $userIds = [];
                foreach($this->roles as $roleName){
                    $userIds = array_merge($userIds,\Yii::$app->authManager->getUserIdsByRole($roleName));
                }
                $query->andFilterWhere([ 'id'  => $userIds ]);
            }

            $query->andFilterWhere([ 'like', 'phone',     $this->phone ]);
            $query->andFilterWhere([ 'like', 'family',    $this->family ]);
            $query->andFilterWhere([ 'like', 'firstname', $this->firstname ]);
            $query->andFilterWhere([ 'like', 'lastname',  $this->lastname ]);

            if($this->registration){
                $dates = $this->unpackDates($this->registration);
                $from = $dates['from']->format("Y-m-d H:i:s");
                $to = $dates['to']->format("Y-m-d H:i:s");
                $query->andFilterWhere([ 'BETWEEN', 'created_at' , $from, $to ]);
            }
        }

        return $query->all();
    }

    private function unpackDates($string){
        $parts = explode('-', $string);
        if(!empty($parts) && count($parts) == 2){
            $from = date_create_from_format("m/d/Y", trim($parts[0]));
            $to = date_create_from_format("m/d/Y", trim($parts[1]));
            if($from && $to){
                return [
                    'from' => $from,
                    'to' => $to
                ];
            }
        }
        return null;
    }
}