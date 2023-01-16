<?php

namespace frontend\controllers;

use yii\web\Controller;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;
use common\models\VehicleBrand;
/**
 * Orders controller
 */
class AjaxController extends Controller
{

    /**
     * @param $mark_id
     * @return string
     * @throws BadRequestHttpException
     * @throws NotFoundHttpException
     */
    public function actionModels($id){

        if(!\Yii::$app->request->isAjax){
            throw new BadRequestHttpException("Неверный формат запроса");
        }

        $mark = VehicleBrand::findOne($id);

        if($mark == null){
            throw new NotFoundHttpException("Не найдена марка");
        }

        $models = $mark->getModels()->select('id,name')->orderBy('name')->indexBy('id')->asArray()->all();

        $selected = empty($models) ? " selected" : '';

        $html = '<option value=""' . $selected . '>Любая</option>';

        foreach($models as $model){
            $html .= "<option value=\"{$model['id']}\">{$model['name']}</option>";
        }

        return $html;

    }



}