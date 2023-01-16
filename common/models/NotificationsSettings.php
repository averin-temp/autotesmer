<?php

namespace common\models;

use common\notifications\NotificationType;
use yii\db\ActiveRecord;

class NotificationsSettings extends ActiveRecord{


    const SCENARIO_ADMIN = 1;
    const SCENARIO_CLIENT = 2;
    const SCENARIO_EXPERT = 3;

    public function scenarios()
    {
        return [
            self::SCENARIO_ADMIN => ['user_id'],
            self::SCENARIO_CLIENT => [
                "events",
                "card_registered",
                "review_added",
                "arbitration_closed",
                "your_info_changed",
                "new_request",
                "admin_message",
                "you_created_appeal",
                "report_received",
                "you_ordered_a_selection",
                "you_made_a_deposit",
                "you_have_secured_a_deal",
                "you_confirmed_work",
            ],
            self::SCENARIO_EXPERT => [
                "events",
                "documents_approved",
                "works_in_your_region",
                "expertize_approved",
                "client_created_appeal",
                "wait_payment",
                "card_registered",
                "review_added",
                "package_obtained",
                "arbitration_closed",
                "your_info_changed",
                "admin_message",
                "you_created_appeal",
                "you_have_secured_a_deal",
            ],
        ];
    }

    public function rules()
    {
        return [];
    }


    public static function tableName()
    {
        return "notice_settings";
    }

}