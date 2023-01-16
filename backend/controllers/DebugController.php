<?php

namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

class DebugController extends Controller{


    public function actionClear(){

        $db = Yii::$app->db;
        $db->createCommand()->truncateTable('users');
        $db->createCommand()->truncateTable('user_group');
        $db->createCommand()->truncateTable('user_category');
        $db->createCommand()->truncateTable('user_package');
        $db->createCommand()->truncateTable('video');
        $db->createCommand()->truncateTable('video_tag');
        $db->createCommand()->truncateTable('tags');
        $db->createCommand()->truncateTable('service');
        $db->createCommand()->truncateTable('review');
        $db->createCommand()->truncateTable('requests');
        $db->createCommand()->truncateTable('promocodes_packages');
        $db->createCommand()->truncateTable('promocodes');
        $db->createCommand()->truncateTable('payment');
        $db->createCommand()->truncateTable('pages');
        $db->createCommand()->truncateTable('package_variant');
        $db->createCommand()->truncateTable('packages');
        $db->createCommand()->truncateTable('order_category');
        $db->createCommand()->truncateTable('orders');
        $db->createCommand()->truncateTable('notifications');
        $db->createCommand()->truncateTable('notice_settings');
        $db->createCommand()->truncateTable('mail_templates');
        $db->createCommand()->truncateTable('mailing_roles');
        $db->createCommand()->truncateTable('mailing_group');
        $db->createCommand()->truncateTable('mailing');
        $db->createCommand()->truncateTable('groups');
        $db->createCommand()->truncateTable('files');
        $db->createCommand()->truncateTable('favorites');
        $db->createCommand()->truncateTable('codes');
        $db->createCommand()->truncateTable('chat_messages');
        $db->createCommand()->truncateTable('chat');
        $db->createCommand()->truncateTable('category');
        $db->createCommand()->truncateTable('brief');
        $db->createCommand()->truncateTable('banners');




        return $this->redirect(['/users']);
    }

}