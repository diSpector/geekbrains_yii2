<?php
/**
 * Created by PhpStorm.
 * User: Ирина
 * Date: 20.02.2019
 * Time: 0:11
 */

namespace app\controllers;

use app\base\BaseController;
use app\controllers\actions\ActivityCreateAction;
//use app\models\Activity;

class ActivityController extends BaseController
{

    public function actions(){
        return [
            'create' => [
                'class' => ActivityCreateAction::class
//                'class' => 'app\controllers\actions\ActivityCreateAction'
            ]
        ];
    }
//    public function actionCreate()
//    {
//        $activity = new Activity();
//
//        if(\Yii::$app->request->isPost){
//            $activity->load(\Yii::$app->request->post());
//            $activity->validate();
//
//        }
//
//        $activity->is_blocked= 1;
//        $activity->description = 'Hello';
//        return $this->render('create', ['activity' => $activity]);
//    }
}