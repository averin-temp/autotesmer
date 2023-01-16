<?php
namespace frontend\widgets;

use common\classes\OrderCategory;
use common\models\Service;
use common\models\User;
use yii\base\Widget;
use yii\db\Query;
use yii\helpers\Html;

class ChosenExpertsWidget extends Widget
{

    public function run()
    {

        $ids = \Yii::$app->authManager->getUserIdsByRole('Эксперт');

        $users = User::find()
            ->from([ 'subquery' => (new Query())
                        ->from([ 's' => Service::tableName() ])
                        ->select('s.activation_date, s.user_id, u.*')
                        ->where(['>','s.expire_date', date_create()->format('Y-m-d H:i:s') ])
                        ->andWhere(['s.service_type' => Service::TYPE_EDITORS_CHOICE])
                        ->leftJoin([ 'u' => User::tableName() ] , 's.user_id = u.id')
            ])
            ->where(['subquery.id' => $ids])
            ->groupBy('subquery.id')
            ->orderBy('subquery.activation_date')
            ->all();

        return $this->render('//widgets/chosen-experts', ['experts' => $users ]);
    }

}