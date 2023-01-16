<?php
/**
 * Created by PhpStorm.
 * User: hustler
 * Date: 25.03.2019
 * Time: 21:49
 */

namespace common\models;

use yii\db\ActiveRecord;
use yii\base\Exception;
use yii\db\Query;
use yii\helpers\ArrayHelper;
use yii\rbac\Role;

/**
 * Class Mailing
 * @package common\models
 *
 * @property int $id
 * @property int $template_id
 * @property MailTemplate $template
 * @property int $promocodes_set_id
 * @property PromocodesSet $promocodesSet
 * @property string $name
 * @property string $created
 * @property string $shedule
 * @property int $executed
 * @property string execution_date
 * @property Role[] $roles
 * @property Group[] $groups
 *
 */
class Mailing extends ActiveRecord
{
    /**
     * @return string
     */
    public static function tableName()
    {
        return 'mailing';
    }

    public function rules()
    {
        return [

            [['name'], 'required', 'message' => 'Укажите имя рассылки'],
            [['template_id'], 'required', 'message' => 'Укажите шаблон рассылки'],
            [['template_id'], 'exist', 'targetClass' => MailTemplate::class, 'targetAttribute' => 'id',
                'message' => 'Укажите шаблон рассылки'],
            [['promocodes_set_id'], 'exist', 'targetClass' => PromocodesSet::class, 'skipOnEmpty' => true,
                'targetAttribute' => 'id', 'message' => 'Несуществующий набор промокодов'],

            ['shedule', function ($attribute, $params) {
                if (!$date = date_create($this->$attribute)) {
                    $this->addError($attribute, 'Неверный формат даты');
                    return false;
                }

                if($date < date_create())
                {
                    $this->addError($attribute, 'Неверная дата');
                    return false;
                }

                return true;

            }],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     * @throws \yii\base\InvalidConfigException
     */
    public function getGroups(){
        return $this->hasMany(Group::class, ['id' => 'group_id'])
            ->viaTable('mailing_group', ['mailing_id' => 'id']);
    }

    /**
     * Возвращает список ролей
     *
     * @return array
     */
    public function getRoles(){
        $roles = (new Query)->from('mailing_roles')
            ->select('role_name')
            ->where(['mailing_id' => $this->id])->groupBy('role_name')->all();
        return ArrayHelper::getColumn($roles, 'role_name');
    }

    public function getPromocodesSet(){
        return $this->hasOne(PromocodesSet::class, ['id' => 'promocodes_set_id']);
    }


    public function send($user, $code = ''){
        $content = $this->template->render($user,$code);
        \Yii::$app->mailer->compose()
            ->setFrom('my@domain.com')
            ->setTo($user->email)
            ->setSubject('Рассылка')
            ->setHtmlBody($content)
            ->send();
    }


    public function targetUsers(){

        $auth = \Yii::$app->authManager;
        $userIdsByRole = [];
        /** @var string $role */
        foreach($this->getRoles() as $roleName){
            $userIdsByRole = array_merge($userIdsByRole, $auth->getUserIdsByRole($roleName));
        }

        $userIdsByGroupQuery = (new Query)->from(['m' => 'mailing_group','u' => 'user_group'])
            ->select('user_id')
            ->where('m.group_id = u.group_id')
            ->andWhere(['mailing_id' => $this->id])
            ->groupBy('user_id');

        return User::findAll([$userIdsByGroupQuery, $userIdsByRole]);
    }


    /**
     * Выполняет рассылку писем email
     *
     */
    public function execute(){

        if($this->executed) return false;

        $now = date('Y.m.d H:i:s');

        $users = $this->targetUsers();

        if($promocodesSet = $this->promocodesSet){
            $usePromocode = true;
            $promocodes = $promocodesSet->getPromocodes()->where(['used' => 0])->all();

            $usersCount = count($users);
            $promocodesCount = count($promocodes);

            if($promocodesCount < $usersCount){
                throw new Exception("Недостаточно кодов! Количество пользователей $usersCount, кодов $promocodesCount.");
            }


        } else {
            $usePromocode = false;
        }

        foreach($users as $user){

            if($usePromocode){

                $promocode = array_shift($promocodes);
                $this->send($user, $promocode->code);
                $promocode->spend();

            } else {
                $this->send($user);
            }
        }

        $this->executed = 1;
        $this->execution_date = $now;
        return $this->save(false);
    }


    /**
     * @param $groups
     * @throws \yii\db\Exception
     */
    public function updateGroups($groups){

        $this->clearGroups();

        $data = [];
        foreach($groups as $group_id){
            $data[] = [$this->id, $group_id];
        }
        \Yii::$app->db->createCommand()
            ->batchInsert('mailing_group',[
                'mailing_id',
                'group_id'
            ],$data)->execute();
    }


    /**
     * @param $groups
     * @throws \yii\db\Exception
     */
    public function updateRoles($roles){

        $this->clearRoles();

        $data = [];
        foreach($roles as $role_name){
            $data[] = [$this->id, $role_name];
        }
        \Yii::$app->db->createCommand()
            ->batchInsert('mailing_roles',[
                'mailing_id',
                'role_name'
            ],$data)->execute();
    }

    /**
     * @throws \yii\db\Exception
     */
    public function clearGroups(){
        \Yii::$app->db->createCommand()
            ->delete('mailing_group', [
                'mailing_id' => $this->id
            ])->execute();

    }

    /**
     * @throws \yii\db\Exception
     */
    public function clearRoles(){
        \Yii::$app->db->createCommand()
            ->delete('mailing_roles', [
                'mailing_id' => $this->id
            ])->execute();

    }

    /**
     * @return bool|void
     * @throws \yii\db\Exception
     */
    public function beforeDelete(){
        $this->clearGroups();
        return true;
    }



    /**
     *
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTemplate(){
        return $this->hasOne(MailTemplate::class, ['id' => 'template_id']);
    }


}