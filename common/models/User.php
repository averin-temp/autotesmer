<?php
namespace common\models;

use common\classes\OrderType;
use common\validators\NameValidator;
use common\validators\PhoneValidator;
use Yii;
use yii\db\ActiveRecord;
use yii\db\Query;
use yii\helpers\Url;
use yii\rbac\Role;
use yii\web\IdentityInterface;
use yii\base\Exception;
use common\notifications\Notification;

/**
 * User model
 *
 * @property integer            $id                     ID записи в базе данных
 * @property string             $firstname              Имя пользователя
 * @property string             $family                 Фамилия пользователя
 * @property string             $lastname               Отчество пользователя
 * @property string             $password               Пароль пользователя
 * @property string             $email                  Почта пользователя
 * @property integer            $created_at             Дата создания аккаунта
 * @property integer            $updated_at             Дата обновления аккаунта
 * @property Role               $role                   Роль пользователя
 * @property integer            $phone                  Телефон пользователя
 * @property integer            $profile_vk             Адрес профиля Vkontakte
 * @property integer            $profile_facebook       Адрес профиля Facebook
 * @property integer            $profile_google         Адрес профиля Google
 * @property integer            $profile_twitter        Адрес профиля Twitter
 * @property integer            $profile_mailru        Адрес профиля Twitter
 * @property string             $avatar                 Url аватара пользователя
 * @property string             $photo                  имя файла аватара пользователя
 * @property City               $city                   Город
 * @property int                $city_id                  ID Города
 * @property \DateTime          $birthday               День рождения
 * @property int                $has_ip                 Имеет ИП
 * @property int                $has_ul                 Имеет Юр.Лицо
 * @property int                $gender                 Имеет Юр.Лицо
 * @property string             $resume                 Резюме
 * @property string             $about                  О себе
 * @property string             $text                   какой-то текст
 * @property string             $status                 статус
 * @property int        $busyness               занятость
 * @property int        $confirmed_email        Подтвержден ли email
 * @property int        $confirmed_phone        Подтвержден ли телефон
 * @property array      $reviews                Отзывы о клиенте
 * @property array      $ordersTotalCount       Общее количество заказов
 * @property array      $rating                 Рейтинг
 * @property array      $orders                 Все заказы пользователя
 * @property NotificationsSettings              $notificationSettings   Настройки уведомлений
 * @property array      $notifications          Уведомления
 * @property array      $packages               Пакеты ползователя
 * @property array      $completedOrders        Завершенные работы
 * @property array      $completedOrdersCount   Количество завершенных работ
 * @property array      $registrationTermLabel   Времени зарегистрирован
 * @property array      $favorites              Избранные эксперты
 * @property array      $positiveReviews        Положительные отзывы
 * @property array      $negativeReviews        Негативные отзывы
 * @property int        $videos                 Видео пользователя
 * @property array      $groups                 Группы пользователя
 * @property int        $category_auto          Заказы категории 'авто'
 * @property int        $category_freight       Заказы категории 'грузовые'
 * @property int        $category_moto          Заказы категории 'мото'
 * @property int        $category_commerce      Заказы категории 'коммерческий'
 * @property int        $category_water         Заказы категории 'водный'
 * @property string     $profileUrl             Заказы категории 'водный'
 * @property string     $activation_key         Код активации аккаунта
 * @property string     $active                 Флаг, указывающий что аккаунт активирован
 * @property int        $card_id                ID карты
 * @property Card       $card                   Карта
 * @property UserDocument[]     $documents             Документы пользователя
 *
 */
class User extends ActiveRecord implements IdentityInterface
{
    const IS_ADMIN = 1;
    const IS_CLIENT = 2;
    const IS_EXPERT = 3;


    const SCENARIO_ADMIN_SAVE = 1;
    const SCENARIO_ADMIN_LOGIN = 2;


    const SCENARIO_CLIENT_SAVE = 3;
    const SCENARIO_CLIENT_SETTINGS = 4;

    const SCENARIO_EXPERT_SAVE = 5;
    const SCENARIO_EXPERT_SETTINGS = 6;
    const SCENARIO_EXPERT_INFO = 7;
    const SCENARIO_EXPERT_REGISTRATION = 8;

    const SCENARIO_LOGIN = 9;






    public $confirm;
    public $day;
    public $month;
    public $year;
    public $_groups;
    public $_role;



    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }


    public function scenarios()
    {
        return [
            self::SCENARIO_LOGIN => ['login', 'password'],

            self::SCENARIO_ADMIN_LOGIN => ['email', 'password'],
            self::SCENARIO_ADMIN_SAVE => ['email', 'password', 'confirm', 'firstname', 'lastname', 'family', 'phone', '_role', 'profile_vk', 'profile_facebook', '_groups'],

            self::SCENARIO_CLIENT_SETTINGS => ['email', 'password', 'confirm', 'firstname', 'lastname', 'family', 'phone', '_role', 'gender', 'profile_vk', 'profile_facebook', 'has_ip', 'has_ul', '_groups'],

            self::SCENARIO_EXPERT_INFO => ['resume','about', 'status', 'text'],
            self::SCENARIO_EXPERT_SETTINGS => ['email', 'password', 'confirm', 'firstname', 'lastname', 'family', 'phone', '_role', 'gender', 'profile_vk', 'profile_facebook', 'has_ip', 'has_ul', '_groups'],
            self::SCENARIO_EXPERT_REGISTRATION => ['email', 'password', 'firstname', 'lastname', 'family', 'phone', 'avatar', 'activation_key', 'active', 'category_auto', 'category_freight', 'category_moto', 'category_commerce', 'category_water'],
        ];
    }

    public function save($runValidation = true, $attributeNames = null)
    {
        $is_new_record = $this->getIsNewRecord();
        $saved = parent::save($runValidation, $attributeNames);
        if($saved && $is_new_record) {
            $settings = new NotificationsSettings(['user_id' => $this->id]);
            $settings->save(false);
        }
        return $saved;
    }


    /**
     * Активирует аккаунт
     *
     * @throws \yii\db\Exception
     */
    public function activate(){

        $this->activation_key = '';
        $this->active = 1;
        $this->save(false);

        $this->removeInactiveRecords();
    }


    /**
     * Если пользователь зарегистрировался, но не активировал аккаунт
     * и зарегистрировался повторно, создадутся 2 записи с одинаковым email,
     * которые можно активировать. Этот метод удаляет неактивные аккаунты с тем же email.
     *
     * @throws \yii\db\Exception
     */
    public function removeInactiveRecords()
    {
        \Yii::$app->db->createCommand()->delete(self::tableName(),[
            'email' => $this->email,
            'active' => 0
        ])->execute();
    }


    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [

            // SCENARIO_ADMIN_SAVE
            [['firstname', 'lastname', 'family', 'email', 'phone', 'password', 'confirm'], 'trim', 'on' => self::SCENARIO_ADMIN_SAVE],
            [['firstname'], 'required', 'message' => 'Введите имя', 'on' => self::SCENARIO_ADMIN_SAVE],
            [['lastname'], 'required', 'message' => 'Введите отчество', 'on' => self::SCENARIO_ADMIN_SAVE],
            [['family'], 'required', 'message' => 'Введите фамилию', 'on' => self::SCENARIO_ADMIN_SAVE],
            [['role_id'], 'required', 'message' => 'Необходимо задать роль пользователю', 'on' => self::SCENARIO_ADMIN_SAVE],
            [['email'], 'required', 'message' => 'Укажите email', 'on' => self::SCENARIO_ADMIN_SAVE],
            ['email', 'unique', 'targetClass' => User::class, 'targetAttribute' => 'email', 'filter' => 'id != ' . (int)$this->id, 'message' => 'Такой email занят', 'on' => self::SCENARIO_ADMIN_SAVE ],
            ['firstname', NameValidator::class, 'message' => 'Введите корректное имя'],
            ['family', NameValidator::class, 'message' => 'Введите корректную фамилию'],
            ['lastname', NameValidator::class, 'message' => 'Введите корректное отчество'],
            ['password', 'validatePasswordAdmin', 'skipOnEmpty' => false , 'on' => self::SCENARIO_ADMIN_SAVE ],
            [['role_id'], 'roleValidator', 'on' => self::SCENARIO_ADMIN_SAVE ],
            [['email'], 'email', 'message' => 'Неверный адрес почты', 'on' => self::SCENARIO_ADMIN_SAVE],
            ['phone', PhoneValidator::class , 'skipOnEmpty' => true , 'message' => 'Неверный формат номера', 'on' => self::SCENARIO_ADMIN_SAVE ],

            // SCENARIO_ADMIN_LOGIN
            [['email', 'password'], 'required', 'on' => self::SCENARIO_ADMIN_LOGIN ],

            // SCENARIO_LOGIN
            [['login', 'password'], 'required', 'on' => self::SCENARIO_LOGIN ],

            // SCENARIO_CLIENT_SETTINGS
            [['firstname', 'lastname', 'family'], 'string', 'on' => self::SCENARIO_CLIENT_SETTINGS],
            [['role_id', 'gender', 'has_ip', 'has_ul'], 'integer', 'on' => self::SCENARIO_CLIENT_SETTINGS ],
            [['has_ip', 'has_ul'], 'default', 'value' => 0, 'skipOnEmpty' => false, 'on' => self::SCENARIO_CLIENT_SETTINGS ],
            [['email'], 'email', 'on' => self::SCENARIO_CLIENT_SETTINGS],
            [['email'], 'required', 'on' => self::SCENARIO_CLIENT_SETTINGS ],
            [['phone', 'profile_vk', 'profile_facebook'], 'string', 'on' => self::SCENARIO_CLIENT_SETTINGS ],
            ['password', 'validatePasswordAdmin', 'skipOnEmpty' => false , 'on' => self::SCENARIO_CLIENT_SETTINGS ],


            // SCENARIO_EXPERT_INFO
            // ничего не нужно

            // SCENARIO_EXPERT_SETTINGS
            [['firstname', 'lastname', 'family'], 'string', 'on' => self::SCENARIO_EXPERT_SETTINGS],
            [['role_id', 'gender', 'has_ip', 'has_ul'], 'integer', 'on' => self::SCENARIO_EXPERT_SETTINGS ],
            [['has_ip', 'has_ul'], 'default', 'value' => 0, 'skipOnEmpty' => false, 'on' => self::SCENARIO_EXPERT_SETTINGS ],
            [['email'], 'email', 'on' => self::SCENARIO_EXPERT_SETTINGS],
            [['email'], 'required', 'on' => self::SCENARIO_EXPERT_SETTINGS ],
            [['phone', 'profile_vk', 'profile_facebook'], 'string', 'on' => self::SCENARIO_EXPERT_SETTINGS ],
            ['password', 'validatePasswordAdmin', 'skipOnEmpty' => false , 'on' => self::SCENARIO_EXPERT_SETTINGS ],


        ];
    }


    public function roleValidator($attribute, $params){
        if(!$this->role){
            $this->addError('role', "неверный идентификатор роли");
        }
    }


    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        //throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by email
     *
     * @param string $email
     * @return static|null
     */
    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email]);
    }


    /**
     * Finds user by login
     *
     * @param string $email
     * @return static|null
     */
    public static function findByLogin($login)
    {
        return static::findOne(['login' => $login]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $password == $this->password;
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;

        //$this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    public function validatePasswordAdmin($attribute, $params)
    {

        if($this->id && $this->password == '' && $this->confirm == ''){
            $this->password = $this->oldAttributes['password'];
            return;
        }

        if($this->password != $this->confirm){
            $this->addError($attribute,"Пароль и подтверждение пароля должны совпадать");
        }

        if($this->password == ''){
            $this->addError($attribute,"Введите пароль");
        }

    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }




    public function getGroups()
    {
        return $this->hasMany(Group::class, ['id' => 'group_id'])
            ->viaTable('user_group', ['user_id' => 'id']);
    }


    public function can($permissionName, $params = []){
        return \Yii::$app->authManager->checkAccess($this->id, $permissionName,$params);
    }

    /**
     * Возвращает url аватарки пользователя
     *
     * @return string
     */
    public function getAvatar(){

        if($this->photo)
        {
            $imageFile = \Yii::getAlias('@uploads/users/' . $this->id . '/' . $this->photo);
            if(file_exists($imageFile))
            {
                return Url::to('@web-uploads/users/' . $this->id . '/' . $this->photo);
            }
        }

        return Url::to('@frontend-web/img/icons/svg/anonymous_g.svg');
    }

    public function setAvatar($image_name){
        $this->photo = $image_name;
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRole(){
        $roles = \Yii::$app->authManager->getRolesByUser($this->id);
        return empty($roles) ? null : array_shift($roles);
    }


    /**
    * @return \DateTime
    */
    public function getBirthday()
    {
        return date_create($this->birthday);
    }


    /**
     *
     * Входит ли эксперт в первую сотню по рейтингу
     *
     *
     * @return bool
     */
    public function isTop(){

        $ids = \Yii::$app->authManager->getUserIdsByRole('Эксперт');

        $topUsers = User::find()
            ->select('id')
            ->where(['id' => $ids])
            ->orderBy(['rating' => SORT_DESC])
            ->limit(100)
            ->column();

        \Yii::warning(print_r($topUsers, true), __METHOD__);


        $keys = array_keys($topUsers, $this->id);
        if(empty($keys)) return false;

        $place = $keys[0] + 1;

        return $place;
    }

    public function getNegativeReviews(){
        return $this->getReviews()->andWhere(['evaluation' => -1]);
    }

    public function getPositiveReviews(){
        return $this->getReviews()->andWhere(['evaluation' => 1]);
    }

    public function negativeReviewsCount(){
        return $this->getNegativeReviews()->count();
    }

    public function positiveReviewsCount(){
        return $this->getPositiveReviews()->count();
    }

    public function reviewsCount(){
        return $this->getReviews()->count();
    }


    /**
     * @return \yii\db\ActiveQuery
     * @throws \yii\base\InvalidConfigException
     */
    public function getFavorites(){
        return $this->hasMany(User::class, ['id' => 'expert_id'])
                ->viaTable('favorites', ['client_id' => 'id']);
    }

    /**
     * Проверяет есть ли пользователь с таким id в списке избранных экспертов
     *
     * @param $expert_id
     * @return bool
     */
    public function hasFavorite($expert_id){
        return (new Query())->from('favorites')
            ->where([
                'expert_id' => $expert_id,
                'client_id' => $this->id
            ])->exists();
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity(){
        return $this->hasOne(City::class, ['id' => 'city_id' ]);
    }

    public function getAge(){
        return intval(date_diff($this->getBirthday(), date_create())->y);
    }

    public function getReviews(){
        return $this->hasMany(Review::class, ['to' => 'id']);
    }

    public function getPackages(){
        return $this->hasMany(UserPackage::class, ['user_id' => 'id']);
    }

    public function getVideos()
    {
        if(!$this->can('Эксперт'))
            return [];

        return Video::findAll(['user_id' => $this->id]);


    }

    public function getBusynessLabel(){
        return self::busynessVariants()[$this->busyness];
    }

    public static function busynessVariants(){
        $variants = array(
            1 => 'Свободен',
            2 => 'Частично занят',
            3 => 'Занят'
        );
        return $variants;
    }


    /**
     * Обновляет роль пользователя
     *
     * @throws Exception
     */
    public function updateRole(){

        if($this->_role == null)
            return;

        $authManager = \Yii::$app->authManager;
        $authManager->revokeAll($this->id);

        $role = \Yii::$app->authManager->getRole($this->_role);

        if($role == null)
            throw new Exception("Роль не найдена");

        $authManager = \Yii::$app->authManager;
        $authManager->assign($role, $this->id);

        $this->_role = null;
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        $this->saveGroups();
        $this->updateRole();
    }


    public function getCard(){
        return $this->hasOne(Card::class, ['user_id' => 'id']);
    }

    /**
     * Все заказы пользователя
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrders(){
        if($this->can('Эксперт'))
            return $this->hasMany(Order::class, ['expert_id' => 'id']);
        if($this->can('Клиент'))
            return $this->hasMany(Order::class, ['client_id' => 'id']);
    }

    /**
     * Возвращает общее количество заказов пользователя.
     *
     * @return int
     */
    public function getOrdersTotalCount(){
        return $this->getOrders()->count();
    }


    /**
     * @param int $points
     */
    public function updateRating($points){
        $this->updateCounters(['rating' => $points]);
    }

    /**
     * @param $points
     */
    public function increaseRating($points){
        $this->updateCounters(['rating' => $points]);
    }

    /**
     * Возвращает настройки уведомлений
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNotificationSettings(){
        return $this->hasOne(NotificationsSettings::class, ['user_id' => 'id'])->with();
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNotifications(){
        return $this->hasMany(Notification::class, ['target_user' => 'id']);
    }


    /**
     * @param $type
     * @return bool
     */
    public function haveService($type){
        $userPackages = UserPackage::findAll(['user_id' => $this->id]);
        $allServices = [];
        foreach($userPackages as $userPackage){
            $packageVariant = PackageVariant::findOne(['id' => $userPackage->variant_id ]);
            $services = $packageVariant->services;
            foreach($services as $service){
                $allServices[] = $service;
            }
        }
        //TODO: недописано!
        foreach($allServices as $service){
            if($service->type == $type)  return true;
        }

        return false;
    }



    public function getCurrentWorks(){
        return Order::findAll(['expert_id' => $this->id, 'status' => Order::STATUS_WORK]);
    }

    public function getCompletedSafeDiads(){
        return Dial::findAll(['expert_id' => $this->id, 'status' => Dial::STATUS_COMPLETED]);
    }


    /**
     * Возвращает время прошедшее после регистрации
     *
     * @return string
     */
    public function getRegistrationTermLabel(){
        $created = date_create($this->created_at);
        $current = date_create();
        $diff = date_diff($created, $current);

        $label = $diff->y ?  $diff->y . ' лет' : (
          $diff->d ? $diff->d . ' дней' : (
            $diff->h ? $diff->h . ' часов' : (
              $diff->i ? $diff->i . ' минут' :(
                $diff->s ? $diff->s . ' секунд' : ''
              )
            )
          )
        );

        return $label;
    }

    public function getCompletedOrders(){
        if($this->role->name == 'Клиент')
            return $this->hasMany(Order::class,['client_id' => 'id'])->andWhere(['status' => Order::STATUS_CLOSED]);

        if($this->role->name == 'Эксперт')
            return $this->hasMany(Order::class,['expert_id' => 'id'])->andWhere(['status' => Order::STATUS_CLOSED]);
    }

    /**
     *
     * Количество завершенных заказов
     *
     * @return int|string
     */
    public function getCompletedOrdersCount(){
        return $this->getCompletedOrders()->count();
    }

    public function getEditUrl(){
        if($this->can('Клиент')) return Url::to(['client/settings', 'id' => $this->id]);
        if($this->can('Эксперт')) return Url::to(['expert/settings', 'id' => $this->id]);
        return Url::to(['users/edit', 'id' => $this->id]);
    }


    public function saveGroups(){

        if($this->_groups === null)
            return;

        \Yii::$app->db->createCommand()->delete('user_group', ['user_id' => $this->id])->execute();

        if (!is_array($this->_groups))
            throw new Exception("Неверный формат групп");

        foreach ($this->_groups as $group_id) {
            $group = Group::findOne(intval($group_id));
            if (!$group)  throw new Exception("Группа не найдена");
            \Yii::$app->db->createCommand()->insert('user_group', ['user_id' => $this->id, 'group_id' => $group->id])->execute();
        }

        $this->_groups = null;
    }


    public function getRequests(){
        return $this->hasMany(Request::class, ['expert_id' => 'id']);
    }


    public function getProfileUrl(){
        if(!$this->can('Эксперт') && !$this->can('Клиент'))
            return '';

        return Url::to(['profile/info', 'id' => $this->id]);
    }

    public function getProfileReviewsUrl(){
        if(!$this->can('Эксперт') && !$this->can('Клиент'))
            return '';

        return Url::to(['profile/reviews', 'id' => $this->id]);
    }


    public function allowedFor($service_type){
        if($this->can('Эксперт')){
            /** @var $order Order */
            foreach($this->packages as $userPackage){
                /** @var $userPackage UserPackage */
                foreach($userPackage->services as $service){
                    /** @var $service Service */
                    if($service->service_type == $service_type && !$service->expired()){
                        return true;
                    }
                }
            }
        }

        return false;
    }

    public function getSpecialization(){
        $allowed = [];

        if($this->allowedFor(OrderType::TYPE_ONE_TIME_INSPECTION)) $allowed[] = OrderType::label(OrderType::TYPE_ONE_TIME_INSPECTION);
        if($this->allowedFor(OrderType::TYPE_EXPERT_FOR_DAY)) $allowed[] = OrderType::label(OrderType::TYPE_EXPERT_FOR_DAY);
        if($this->allowedFor(OrderType::TYPE_FULL_SELECTION)) $allowed[] = OrderType::label(OrderType::TYPE_FULL_SELECTION);

        return empty($allowed) ? ["Нет специализации"] : $allowed;
    }


    public function allowedFor2($service_type){
        if($this->can('Эксперт')){
            $service = Service::find()
                ->where([ 'user_id' => $this->id, 'service_type' => $service_type])
                ->andWhere([ '>', 'expire_date', date_create()->format('Y-m-d H:i:s') ])
                ->one();
            if($service) return true;
        }

        return false;
    }

    public static function networkAttribute($network){
        switch ($network){
            case 'facebook':
                $attribute = 'profile_facebook';
                break;
            case 'vk':
                $attribute = 'profile_vk';
                break;
            case 'google':
                $attribute = 'profile_google';
                break;
            case 'twitter':
                $attribute = 'profile_twitter';
                break;
            case 'mail.ru':
                $attribute = 'profile_mailru';
                break;
            default:
                return null;
        }

        return $attribute;
    }

    /**
     * @param $network
     * @param $uid
     * @return bool
     */
    public function attachProfile($network, $uid){
        if(!$attribute = self::networkAttribute($network))
            return false;

        $this->$attribute = $uid;
        return $this->save(false);
    }

    public static function findByUid($network, $uid){
        if(!$attribute = self::networkAttribute($network))
            return null;

        return self::findOne([$attribute => $uid]);
    }


    /**
     * @return string
     */
    public function surnameWithInitials(){
        return $this->family . ' ' .  mb_substr($this->firstname,0,1) . '. ' . mb_substr($this->lastname,0,1) . '.';
    }

    /**
     * @return string
     */
    public function fullName(){
        return $this->family . ' ' .  $this->firstname . ' ' . $this->lastname;
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVerification(){
        return $this->hasOne(PassportVerification::class,['user_id' => 'id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocuments(){
        return $this->hasMany(UserDocument::class,['user_id' => 'id']);
    }


    /**
     * Возвращает клиентов, которые добавили этого эксперта в избранные.
     *
     * @return array|ActiveRecord[]
     */
    public function electedBy(){
        return self::find()->leftJoin('favorites', 'favorites.client_id = id')
            ->where(['favorites.expert_id' => $this->id])->all();
    }


    /**
     * Отправляет уведомление этому пользователю
     *
     * @param $type
     * @param array $params
     */
    public function sendNotification($type, $params = [] ){
        $params['target_user'] = $this->id;
        Notification::send($type, $params);
    }


    public static function findByInviteKey($key){

        $invite = Invite::findOne(['key' => $key]);
        if($invite){
            return $invite->user;
        }

        return null;
    }

}
