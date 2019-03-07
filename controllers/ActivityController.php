<?php
/**
 * Created by PhpStorm.
 * User: Ирина
 * Date: 20.02.2019
 * Time: 0:11
 */

namespace app\controllers;

use app\base\BaseController;
use app\components\ActivityComponent;
use app\controllers\actions\ActivityCreateAction;
use app\controllers\actions\ActivityDeleteAction;
use app\controllers\actions\ActivityEditAction;
use yii\web\HttpException;

use app\controllers\actions\ActivityIndexAction;

class ActivityController extends BaseController
{

    public function actions(){
        return [
            'create' => [
                'class' => ActivityCreateAction::class
            ],
            'edit' => [
                'class' => ActivityEditAction::class
            ],
            'delete' => [
                'class' => ActivityDeleteAction::class,
            ],
//            'index' => [
//                'class' => ActivityIndexAction::class,
//            ],

        ];
    }

//    public function actionView($id){
//        $comp = \Yii::$app->activity;
//        $activity = $comp->getActivity($id);
//        if(!$activity){
//            throw new HttpException(401, 'Activity not found');
//        }
//        // если не админ, то может просматривать только свои
//        if(!\Yii::$app->rbac->canViewEditAll()){
//            if(!\Yii::$app->rbac->canViewActivity($activity)){
//                throw new HttpException(403,'Not Access to View this Activity');
//            }
//        }
//        /** @var ActivityComponent $comp */
//        return $this->render('create-confirm', ['activity' => $activity]);
//    }
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