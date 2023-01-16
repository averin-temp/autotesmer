<?php
/**
 * Created by PhpStorm.
 * User: hustler
 * Date: 25.03.2019
 * Time: 21:49
 */

namespace common\models;

use yii\db\ActiveRecord;
use yii\db\Query;

/**
 * Class Promocode
 * @package common\models
 *
 * @property int $id
 * @property string $name
 * @property string $active_from
 * @property string $active_until
 * @property float $discount
 * @property array $packages
 * @property int $used
 * @property int $usedPromocodes
 * @property array $promocodes
 * @property bool $isActive
 */
class PromocodesSet extends ActiveRecord
{
    public $period;
    public $_packages;

    /**
     * @return string
     */
    public static function tableName()
    {
        return 'promocodes_sets';
    }


    public function rules()
    {
        return [
            [['name'], 'required', 'message' => 'Введите название'],
            [['discount'], 'required', 'message' => 'Укажите скидку'],
            [['discount'], 'number', 'min' => '0', 'max' => '100', 'message' => 'неверное значение, укажите значение от 0 до 100 (%)'],
            ['discount', 'filter', 'filter' => function ($value) { return $value / 100; }],
            [['period'], 'validatePeriod'],
            [['_packages'], 'safe'],
        ];
    }


    public function validatePeriod($attribute, $params){

        try{
            $period = $this->$attribute;
            $period = explode('-', $period);


            if(empty($period[1]) || empty($period[0])){
                throw new \Exception("неверный формат периода");
            }

            $rawfrom = trim($period[0]);
            $rawuntil = trim($period[1]);

            $from = date_create_from_format("m/d/Y", $rawfrom);
            $until = date_create_from_format("m/d/Y", $rawuntil);

            if(!$from || !$until) {
                throw new \Exception("неверный формат периода");
            }

            if($from > $until) throw new \Exception("период начинается позже чем заканчивается");

            $this->active_from = $from->format("Y-m-d H:i:s");
            $this->active_until = $until->format("Y-m-d H:i:s");

        } catch (\Exception $e){
            $this->addError($attribute, $e->getMessage());
        }
    }

    /**
     * @return string
     */
    public function createCode(){
        return uniqid();
    }


    /**
     * @param $number
     * @throws \yii\db\Exception
     */
    public function createCodes($number){

        $codes = [];
        for($i = 0; $i < $number; $i++){
            $codes[] = [
                'code' => $this->createCode(),
                'set_id' => $this->id,
            ];
        }
        \Yii::$app->db->createCommand()
            ->batchInsert('promocodes', ['code', 'set_id'], $codes)
            ->execute();
    }


    /**
     * @return \yii\db\ActiveQuery
     * @throws \yii\base\InvalidConfigException
     */
    public function getPackages(){
        return $this->hasMany(Package::class, ['id' => 'package_id'])
            ->viaTable('promocodes_packages', ['promocode_id' => 'id']);
    }


    /**
     * @throws \yii\db\Exception
     */
    public function updatePackages(){

        if(!empty($this->_packages)){
            \Yii::$app->db->createCommand()
                ->delete('promocodes_packages', [
                    'promocode_id' => $this->id
                ])->execute();


            $data = [];
            foreach ($this->_packages as $package_id) {
                $data[] = [$package_id, $this->id];
            }

            \Yii::$app->db->createCommand()
                ->batchInsert('promocodes_packages', [
                    'package_id',
                    'promocode_id'
                ], $data )->execute();
        }



    }

    public function formPeriod(){

        if(empty($this->active_from) || empty($this->active_until) ) return '';

        $active_from = date_create($this->active_from);
        if(!$active_from)
            return "неверный формат";

        $active_until = date_create($this->active_until);
        if(!$active_until)
            return "неверный формат";

        return $active_from->format('m/d/Y') . ' - ' . $active_until->format('m/d/Y');
    }


    public function errorField($attribute){
        if($this->hasErrors($attribute)){
            $error = $this->getFirstError($attribute);
            return "<div class='form-error'><p>$error</p></div>";
        }
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPromocodes(){
        return $this->hasMany(Promocode::class,['set_id' => 'id']);
    }

    /**
     * @return int
     */
    public function getUsedPromocodes(){
        return $this->getPromocodes()->where(['used' => 1])->count();
    }

    public function getIsActive(){
        return date_create() > date_create($this->active_from) && date_create() < date_create($this->active_until);
    }

}