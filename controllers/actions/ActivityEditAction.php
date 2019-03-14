<?php

namespace app\controllers\actions;


use app\components\ActivityComponent;
use app\components\DaoComponent;
use app\models\Activity;
use yii\base\Action;
use yii\web\HttpException;


class ActivityEditAction extends Action
{
    public function run($id)
    {

        /** @var ActivityComponent $comp */
//        $comp = \Yii::$app->activity;
        // DI
        $comp = \Yii::$container->get('app\components\activity\ActivityInterface');

        // получить id события из адресной строки
//        $id = \Yii::$app->request->get('id');
        if (!isset($id)) {
            throw new HttpException(400, 'Не указан id активности');
        }
        // получить запись (ActiveRecord) события
        $activity = $comp->getActivity($id);
        if (!$activity) {
            throw new HttpException(400, 'Активности с таким id не существует');
        }

        // проверка, что пользователь не является создателем активности (может его просматривать) и админом
        if (!\Yii::$app->rbac->canViewActivity($activity) && !\Yii::$app->rbac->canViewEditAll()) {
//        if (!\Yii::$app->rbac->canViewEditAll()) {
//            return $this->controller->redirect(['/auth/sign-in']);
            throw new HttpException(403, 'У вас нет прав на редактирование этой активности');
        }

        // если пришел post-запрос
        if (\Yii::$app->request->isPost) {
            // загрузить post-данные в запись события
            $activity->load(\Yii::$app->request->post());
            if ($comp->updateActivity($activity)) { // если удалось сделать update, перейти на страницу подтверждения
                if (\Yii::$app->rbac->canViewEditAll()) {
                    return $this->controller->redirect(['/admin/activities']);
                } else {
                    return $this->controller->render('create-confirm',
                        ['activity' => $activity,]);
                }

            }
        }

        return $this->controller->render('edit', ['activity' => $activity]);

    }

//class ActivityEditAction extends Action
//{
//    // работа с редактированием активности через ActiveRecord
//    public function run()
//    {
//        // если нет прав на редактирование события, перенаправить на авторизацию
//        if(!\Yii::$app->rbac->canCreateActivity()){
//            return $this->controller->redirect(['/auth/sign-in']);
//        }
//        /** @var ActivityComponent $comp */
//        $comp = \Yii::$app->activity; // компонент активности
////        $activity = $comp->getModel(\Yii::$app->request->post());
////        $activity = $comp->getModel();
//
//        // id записи можно взять из адреса с помощью get-массива
//        $id = \Yii::$app->request->get('id');
//        // если пришел post-запрос после нажатия на кнопку "Изменить"
//        if (\Yii::$app->request->isPost) {
//            $activity = $comp->getModel(\Yii::$app->request->post());
//            echo "Дата, пришедшая из POST - " . $activity->dateAct;
//            $activity->id = $id;
//            echo "Дата, полученная от пользователя - " . $activity->dateAct;
//            $activity->user_id = \Yii::$app->user->id; // записать в модель Активности id текущего залогиненного пользователя
//            if($comp->updateActivity($activity)){
//                $activity = $comp->getActivity($id);
////                print_r($activity);
//                \Yii::$app->session->addFlash('success', 'Событие успешно изменено');
//                return $this->controller->render('create-confirm',
//                    [ 'activity' => $activity ,
////                        'id' => $id,
//                        ]);
//            }
//        }
//
//        // id записи можно взять из адреса с помощью get-массива
////        $id = \Yii::$app->request->get('id');
//        $activity = $comp->getActivity($id);
////        $activity->user_id = \Yii::$app->user->id; // записать в модель Активности id текущего залогиненного пользователя
//
//        return $this->controller->render('edit',
//            [
//                'activity' => $activity,
////                'id' => $id,
//            ]
//        );
//    }


// работа с редактированием активности через dao
//    public function run()
//    {
//        $comp = \Yii::$app->activity; // компонент активности
//        /** @var DaoComponent $dao */
//        $dao = \Yii::$app->dao; // компонент БД
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
//                $dao->updateActivity($activity, $id);
//                $activityFromDB = $dao->getActivityByID($id);
//                return $this->controller->render('create-confirm',
//                    ['activity' => $activity,
//                        'id' => $id,
//                        'activityFromDB' => $activityFromDB,
//
//                    ]);
//            }
//        } else {
//            $activity = $comp->getModel();
//        }
//        $id = \Yii::$app->request->get('id');
//        $activityFromDB = $dao->getActivityByID($id);
//        return $this->controller->render('edit',
//            ['activity' => $activity,
//                'id' => $id,
//                'activityFromDB' => $activityFromDB,
//
//            ]);
//    }


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