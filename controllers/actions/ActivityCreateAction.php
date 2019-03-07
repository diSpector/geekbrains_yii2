<?php

namespace app\controllers\actions;

use app\components\ActivityComponent;
use app\models\Activity;
use yii\base\Action;
use yii\web\HttpException;
use yii\web\Response;
use yii\widgets\ActiveForm;

// работа с событием через ActiveRecord

class ActivityCreateAction extends Action
{

    public function run()
    {
        if(!\Yii::$app->rbac->canCreateActivity()){
//        if (!\Yii::$app->rbac->canViewEditAll()) {
            return $this->controller->redirect(['/auth/sign-in']);

//            throw new HttpException(403, 'Нет доступа к созданию');
        }
        /** @var ActivityComponent $comp */
        $comp = \Yii::$app->activity;
        /** @var Activity $model */
        $activity = $comp->getModel(\Yii::$app->request->post());
//        $activity->user_id = \Yii::$app->user->id; // записать в модель Активности id текущего залогиненного пользователя
        if(\Yii::$app->request->isPost){
            if($comp->createActivity($activity)){
                \Yii::$app->session->addFlash('success', 'Создано новое событие');
                return $this->controller->render('create-confirm', ['activity' => $activity]);
            }
        }
        else {
            $activity = $comp->getModel();
        }
        return $this->controller->render('create', ['activity' => $activity]);

    }
}

// работа с событием через DAO

//class ActivityCreateAction extends Action
//{
//
//    public function run()
//    {
//        if(!\Yii::$app->rbac->canCreateActivity()){
////        if (!\Yii::$app->rbac->canViewEditAll()) {
//
//            throw new HttpException(403, 'Нет доступа к созданию');
//        }
//
//        $comp = \Yii::$app->activity;
//        /** @var \app\components\DaoComponent $dao */
//        $dao = \Yii::$app->dao;
//
//        if (\Yii::$app->request->isPost) { // если пришел post-запрос
//            /** @var Activity $activity */
//            $activity = $comp->getModel(\Yii::$app->request->post());
////            $activity->setScenario($activity::SCENARIO_CUSTOM);
//
////            if(\Yii::$app->request->isAjax){
////                \Yii::$app->response->format = Response::FORMAT_JSON;
////                return ActiveForm::validate($activity);
////            }
//            if ($comp->createActivity($activity)) {
//                // если валидация прошла, можно записать данные из модели (активность) в БД
//                $dao->insertActivity($activity);
//                $id = $dao->getDb()->getLastInsertID(); // id последней вставленной записи (небезопасный вариант)
//
//                // во вьюху передаются данные из модели, а не из БД
//                // это сделано для того, чтобы не обращаться лишний раз к БД
//                // вместо того, чтобы выводить данные из БД во вьюхе create-confirm,
//                // они будут выводиться при нажатии на кнопку "Редактировать"
//                return $this->controller->render('create-confirm', ['activity' => $activity, 'id' => $id]);
//
//            }
//
//        } else {
//            $activity = $comp->getModel();
//        }
//        return $this->controller->render('create', ['activity' => $activity]);
//
//    }
//}