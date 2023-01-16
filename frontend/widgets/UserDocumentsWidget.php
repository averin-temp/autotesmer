<?php

namespace frontend\widgets;

use yii\base\Widget;

class UserDocumentsWidget extends Widget
{
    /** @var \common\models\User $user */
    public $user;

    public function run()
    {
        $documents = $this->user->documents;
        return $this->render('//widgets/user-documents', ['documents' => $documents]);
    }

}