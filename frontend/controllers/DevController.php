<?php

namespace frontend\controllers;

use common\helpers\CurlHelper;
use common\helpers\UserHelper;
use common\models\City;
use common\models\Invite;
use common\models\Payment;
use common\models\Payout;
use Yii;
use yii\base\Exception;
use yii\db\Query;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\Response;
use common\models\Card;
use common\notifications\Notification;
use common\models\User;
use common\models\UserPackage;



class DevController extends Controller{



    /*public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['*'],
                        //'roles' => ['Администратор'],
                    ],
                ],
            ],
        ];
    }*/

    /**
     *
     */
    public function actionExperts()
    {
        $data = json_decode(file_get_contents("experts.json"), true);

        foreach($data as $index => $userData)
        {
            $city = City::findOne(['name' => $userData['region'] ]);
            $user = UserHelper::createExpert([
                'active' => true ,
                'firstname' =>  $userData['firstname'],
                'lastname' =>  $userData['patronymic'],
                'family' =>  $userData['lastname'],
                'city_id' => $city->id,
                'phone' => $userData['phone'],
                'confirmed_phone' => 1,
                'category_auto' => 1,
            ] );

            $invite = new Invite();
            $invite->key = uniqid();
            $invite->user_id = $user->id;
            $invite->save(false);
        }
    }



    /**
     * @return Response
     * @throws Exception
     * @throws \yii\db\Exception
     */
    public function actionClear(){

        if(YII_ENV == 'prod')
            throw new Exception("Недопустимая команда");



        $clear = [
            'users',
            'user_group',
            'user_category',
            'user_package',
            'video',
            'video_tag',
            'tags',
            'service',
            'review',
            'requests',
            'invites',
            'promocodes_packages',
            'promocodes',
            'payment',
            //'pages',
            'order_category',
            'orders',
            'notifications',
            'notice_settings',
            'mail_templates',
            //'service_options',
            'mailing_roles',
            'mailing_group',
            'mailing',
            //'menu',
            //'menu_items',
            //'menu_position',
            //'menu_positions',
            'groups',
            'files',
            'favorites',
            'promocodes_sets',
            'promocodes_packages',
            'chat_messages',
            'chat',
            //'category',
            //'package_variant',
            //'packages',
            'brief',
            'banners',
            'banner_group',
            'banner_position',
            'dial',
            'payout',
            'emul_operations',
            'emul_card_registration',
            'card_registration_request',
            'cards',
            'dispute',
            'appeal',
            'passport_verification',
        ];


        if(YII_ENV_TEST || YII_ENV_DEV)
        CurlHelper::post(Url::to('@web-emulator/panel/clear'),[]);

        $db = Yii::$app->db;
        foreach($clear as $tableName){
            $db->createCommand()->delete($tableName)->execute();
        }

        $testAdmin = new User([
            'email' => 'admin@mail.ru',
            'family' => 'adminov',
            'firstname' => 'admin',
            'lastname' => 'adminovich',
            'password' => '1',
            'active' => 1
        ]);
        $testAdmin->save(false);


        $auth = Yii::$app->authManager;

        $auth->removeAll();

        $createSiteReview = $auth->createPermission('createSiteReview');
        $createSiteReview->description = 'Оставлять отзывы о сайте';
        $auth->add($createSiteReview);

        $accessBackend = $auth->createPermission('accessBackend');
        $accessBackend->description = 'Доступ к административному разделу';
        $auth->add($accessBackend);

        $accessUsers = $auth->createPermission('accessUsers');
        $accessUsers->description = 'Доступ к пользователям';
        $auth->add($accessUsers);

        $auth->addChild($accessUsers, $accessBackend);

        $editUsers = $auth->createPermission('editUsers');
        $editUsers->description = 'Редактирование пользователей';
        $auth->add($editUsers);

        $auth->addChild($editUsers, $accessUsers);


        $accessRoles = $auth->createPermission('accessRoles');
        $accessRoles->description = 'Доступ к ролям';
        $auth->add($accessRoles);

        $auth->addChild($accessRoles, $accessBackend);

        $editRoles = $auth->createPermission('editRoles');
        $editRoles->description = 'Редактирование ролей';
        $auth->add($editRoles);

        $auth->addChild($editRoles, $accessRoles);



        $accessBanners = $auth->createPermission('accessBanners');
        $accessBanners->description = 'Доступ к баннерам';
        $auth->add($accessBanners);

        $auth->addChild($accessBanners, $accessBackend);

        $editBanners = $auth->createPermission('editBanners');
        $editBanners->description = 'Редактирование баннеров';
        $auth->add($editBanners);

        $auth->addChild($editBanners, $accessBanners);



        $accessMailing = $auth->createPermission('accessMailing');
        $accessMailing->description = 'Доступ к рассылкам';
        $auth->add($accessMailing);

        $auth->addChild($accessMailing, $accessBackend);

        $editMailing = $auth->createPermission('editMailing');
        $editMailing->description = 'Редактирование ролей';
        $auth->add($editMailing);

        $auth->addChild($editMailing, $accessMailing);


        $accessPages = $auth->createPermission('accessPages');
        $accessPages->description = 'Доступ к страницам';
        $auth->add($accessPages);

        $auth->addChild($accessPages, $accessBackend);

        $editPages = $auth->createPermission('editPages');
        $editPages->description = 'Редактирование страниц';
        $auth->add($editPages);

        $auth->addChild($editPages, $accessPages);


        $accessVerifications = $auth->createPermission('accessVerifications');
        $accessVerifications->description = 'Доступ к проверкам документов';
        $auth->add($accessVerifications);

        $auth->addChild($accessVerifications, $accessBackend);

        $editVerifications = $auth->createPermission('editVerifications');
        $editVerifications->description = 'Управление проверкой документов';
        $auth->add($editVerifications);

        $auth->addChild($editVerifications, $accessVerifications);


        $accessMenu = $auth->createPermission('accessMenu');
        $accessMenu->description = 'Доступ к меню';
        $auth->add($accessMenu);

        $auth->addChild($accessMenu, $accessBackend);

        $editMenu = $auth->createPermission('editMenu');
        $editMenu->description = 'Управление меню';
        $auth->add($editMenu);

        $auth->addChild($editMenu, $accessMenu);


        $accessPromocodes = $auth->createPermission('accessPromocodes');
        $accessPromocodes->description = 'Доступ к промокодам';
        $auth->add($accessPromocodes);

        $auth->addChild($accessPromocodes, $accessBackend);

        $editPromocodes = $auth->createPermission('editPromocodes');
        $editPromocodes->description = 'Редактирование промокодов';
        $auth->add($editPromocodes);

        $auth->addChild($editPromocodes, $accessPromocodes);



        $accessPackages = $auth->createPermission('accessPackages');
        $accessPackages->description = 'Доступ к пакетам';
        $auth->add($accessPackages);

        $auth->addChild($accessPackages, $accessBackend);

        $editPackages = $auth->createPermission('editPackages');
        $editPackages->description = 'Редактирование пакетов';
        $auth->add($editPackages);

        $auth->addChild($editPackages,$accessPackages);



        $accessCategories = $auth->createPermission('accessCategories');
        $accessCategories->description = 'Доступ к категориям';
        $auth->add($accessCategories);

        $auth->addChild($accessCategories, $accessBackend);

        $editCategories = $auth->createPermission('editCategories');
        $editCategories->description = 'Редактирование категорий';
        $auth->add($editCategories);

        $auth->addChild($editCategories, $accessCategories);



        $accessArbitrage = $auth->createPermission('accessArbitrage');
        $accessArbitrage->description = 'Доступ к арбитражу';
        $auth->add($accessArbitrage);

        $auth->addChild($accessArbitrage, $accessBackend);

        $editArbitrage = $auth->createPermission('editArbitrage');
        $editArbitrage->description = 'Редактирование арбитража';
        $auth->add($editArbitrage);

        $auth->addChild($editArbitrage, $accessArbitrage);



        $accessGroups = $auth->createPermission('accessGroups');
        $accessGroups->description = 'Доступ к группам';
        $auth->add($accessGroups);

        $auth->addChild($accessGroups, $accessBackend);

        $editGroups = $auth->createPermission('editGroups');
        $editGroups->description = 'Редактирование групп';
        $auth->add($editGroups);

        $auth->addChild($editGroups, $accessGroups);



        $accessMailTemplates = $auth->createPermission('accessMailTemplates');
        $accessMailTemplates->description = 'Доступ к почтовым шаблонам';
        $auth->add($accessMailTemplates);

        $auth->addChild($accessMailTemplates, $accessBackend);

        $editMailTemplates = $auth->createPermission('editMailTemplates');
        $editMailTemplates->description = 'Редактирование почтовых шаблонов';
        $auth->add($editMailTemplates);

        $auth->addChild($editMailTemplates,$accessMailTemplates);



        $accessLK = $auth->createPermission('accessLK');
        $accessLK->description = 'Доступ к личному кабинету';
        $auth->add($accessLK);


        $accessProfile = $auth->createPermission('accessProfile');
        $accessProfile->description = 'Доступ к профилю';
        $auth->add($accessProfile);

        $roleAdministrator = $auth->createRole('Администратор');
        $roleAdministrator->description = 'Администратор';
        $auth->add($roleAdministrator);

        $accessAdvertising = $auth->createPermission('accessAdvertising');
        $accessAdvertising->description = 'Доступ к заявкам на рекламу';
        $auth->add($accessAdvertising);

        $editAdvertising = $auth->createPermission('editAdvertising');
        $editAdvertising->description = 'Удаление заявок на рекламу';
        $auth->add($editAdvertising);

        $auth->addChild($roleAdministrator, $editUsers);
        $auth->addChild($roleAdministrator, $editRoles);
        $auth->addChild($roleAdministrator, $editBanners);
        $auth->addChild($roleAdministrator, $editArbitrage);
        $auth->addChild($roleAdministrator, $editMailing);
        $auth->addChild($roleAdministrator, $editPromocodes);
        $auth->addChild($roleAdministrator, $editPackages);
        $auth->addChild($roleAdministrator, $editPages);
        $auth->addChild($roleAdministrator, $editMailTemplates);
        $auth->addChild($roleAdministrator, $editVerifications);
        $auth->addChild($roleAdministrator, $editMenu);
        $auth->addChild($roleAdministrator, $editCategories);
        $auth->addChild($roleAdministrator, $editGroups);
        $auth->addChild($roleAdministrator, $createSiteReview);
        $auth->addChild($roleAdministrator, $accessAdvertising);
        $auth->addChild($roleAdministrator, $editAdvertising);



        $roleModerator = $auth->createRole('Модератор');
        $roleModerator->description = 'Модератор';
        $auth->add($roleModerator);

        $auth->addChild($roleModerator, $editBanners);
        $auth->addChild($roleModerator, $editMailing);



        $roleClient = $auth->createRole('Клиент');
        $roleClient->description = 'Клиент';
        $auth->add($roleClient);

        $auth->addChild($roleClient, $accessProfile);
        $auth->addChild($roleClient, $createSiteReview);




        $roleExpert = $auth->createRole('Эксперт');
        $roleExpert->description = 'Эксперт';
        $auth->add($roleExpert);

        $auth->addChild($roleExpert, $accessProfile);
        $auth->addChild($roleExpert, $createSiteReview);

        $authManager = \Yii::$app->authManager;

        $role = $authManager->getRole('Администратор');
        $authManager->assign($role, $testAdmin->id);

        return $this->goHome();
    }

}