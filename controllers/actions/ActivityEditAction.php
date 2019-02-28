<?php

namespace app\controllers\actions;


use app\components\DaoComponent;
use yii\base\Action;

class ActivityEditAction extends Action
{
    public function run()
    {
        $comp = \Yii::$app->activity; // компонент активности
        /** @var DaoComponent $dao */
        $dao = \Yii::$app->dao; // компонент БД

        // если пришел post-запрос после нажатия на кнопку "Изменить"
        if (\Yii::$app->request->isPost) {
            /** @var \app\models\Activity $activity */
            $activity = $comp->getModel(\Yii::$app->request->post());
            // id записи можно взять из адреса с помощью get-массива
            $id = \Yii::$app->request->get('id');

//            $id = \Yii::$app->request->post('id');
//            $id = $activity->id;
//            print_r($activity);
////            $activity->setScenario($activity::SCENARIO_CUSTOM);
//
////            if(\Yii::$app->request->isAjax){
////                \Yii::$app->response->format = Response::FORMAT_JSON;
////                return ActiveForm::validate($activity);
////            }
            if ($comp->createActivity($activity)) {
                $dao->updateActivity($activity, $id);
                $activityFromDB = $dao->getActivityByID($id);
                return $this->controller->render('create-confirm',
                    ['activity' => $activity,
                        'id' => $id,
                        'activityFromDB' => $activityFromDB,

                    ]);
            }
        } else {
            $activity = $comp->getModel();
        }
        $id = \Yii::$app->request->get('id');
        $activityFromDB = $dao->getActivityByID($id);
        return $this->controller->render('edit',
            ['activity' => $activity,
                'id' => $id,
                'activityFromDB' => $activityFromDB,

            ]);
    }


//    public function run()
//    {
//        $comp = \Yii::$app->activity; // компонент активности
//        /** @var DaoComponent $dao */
//        $dao = \Yii::$app->dao; // компонент БД
//
//        // если пришел запрос вида /activity/edit/id, расшифровать его (правила заданы в web.php),
//        // сделать запрос в БД, отобразить в полях данные
//        if (\Yii::$app->request->isGet) {
//            $activity = $comp->getModel();
//            $id = \Yii::$app->request->get('id');
//            $activityFromDB = $dao->getActivityByID($id);
//            return $this->controller->render('edit',
//                [
//                    'activity' => $activity,
//                    'activityFromDB' => $activityFromDB,
//                    'id' => $id
//                ]);
//
//        }
//
//        // если пришел post-запрос после нажатия на кнопку "Изменить"
//        if (\Yii::$app->request->isPost) {
//            /** @var \app\models\Activity $activity */
//            $activity = $comp->getModel(\Yii::$app->request->post());
//            // id записи можно взять из адреса с помощью get-массива
//            $id = \Yii::$app->request->get('id');
//
////            $id = \Yii::$app->request->post('id');
////            $id = $activity->id;
////            print_r($activity);
//////            $activity->setScenario($activity::SCENARIO_CUSTOM);
////
//////            if(\Yii::$app->request->isAjax){
//////                \Yii::$app->response->format = Response::FORMAT_JSON;
//////                return ActiveForm::validate($activity);
//////            }
//            if ($comp->createActivity($activity)) {
////                $session = \Yii::$app->session;
////                $session->set('activity', $activity);
//                $dao->updateActivity($activity, $id);
//                $activityFromDB = $dao->getActivityByID($id);
//                return $this->controller->render('create-confirm',
//                    ['activity' => $activity,
//                        'id' => $id,
//                        'activityFromDB' => $activityFromDB,
//
//                    ]);
//            }
////
//        } else {
//            $activity = $comp->getModel();
//            $id = \Yii::$app->request->get('id');
//            $activityFromDB = $dao->getActivityByID($id);
//            return $this->controller->render('create-confirm',
//                ['activity' => $activity,
//                    'id' => $id,
//                    'activityFromDB' => $activityFromDB,
//
//                ]);
//
//
//        }
//        $activity = $comp->getModel();
//        $id = \Yii::$app->request->get('id');
//        $activityFromDB = $dao->getActivityByID($id);
//        return $this->controller->render('edit',
//            ['activity' => $activity,
//                'id' => $id,
//                'activityFromDB' => $activityFromDB,
//
//            ]);
////        return $this->controller->render('edit', ['activity' => $activity]);
//
//    }
}