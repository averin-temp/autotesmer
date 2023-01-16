<?php
/**
 * Created by PhpStorm.
 * User: hustler
 * Date: 01.11.2019
 * Time: 16:04
 */

namespace frontend\controllers;

use common\models\Video;
use yii\web\Controller;

class VideosController extends Controller
{

    public function actionIndex(){

        $videos = Video::find()->all();

        return $this->render('index', [
            'videos' => $videos
        ]);

    }


    public function actionWatch($id)
    {
        $video = Video::findOne($id);
        return $this->render('watch', ['video' => $video]);
    }

}