<?php

namespace app\controllers\actions;

use app\models\Activity;
use yii\base\Action;
use yii\web\Response;
use yii\widgets\ActiveForm;

class ActivityCreateAction extends Action
{

    public function run()
    {
        $comp = \Yii::$app->activity;
        /** @var \app\components\DaoComponent $dao */
        $dao = \Yii::$app->dao;

        if (\Yii::$app->request->isPost) { // если пришел post-запрос
            /** @var Activity $activity */
            $activity = $comp->getModel(\Yii::$app->request->post());
//            $activity->setScenario($activity::SCENARIO_CUSTOM);

//            if(\Yii::$app->request->isAjax){
//                \Yii::$app->response->format = Response::FORMAT_JSON;
//                return ActiveForm::validate($activity);
//            }
            if ($comp->createActivity($activity)) {
                // если валидация прошла, можно записать данные из модели (активность) в БД
                $dao->insertActivity($activity);
                $id = $dao->getDb()->getLastInsertID(); // id последней вставленной записи (небезопасный вариант)

                // во вьюху передаются данные из модели, а не из БД
                // это сделано для того, чтобы не обращаться лишний раз к БД
                // вместо того, чтобы выводить данные из БД во вьюхе create-confirm,
                // они будут выводиться при нажатии на кнопку "Редактировать"
                return $this->controller->render('create-confirm', ['activity' => $activity, 'id' => $id]);

            }

        } else {
            $activity = $comp->getModel();
        }
        return $this->controller->render('create', ['activity' => $activity]);

    }

    //                $session = \Yii::$app->session;
//                $session->set('title', $activity['title']);
//                $session->set('dateAct', $activity['dateAct']);
//                $session->set('timeStart', $activity['timeStart']);
//                $session->set('timeEnd', $activity['timeEnd']);
//                $session->set('use_notification', $activity['use_notification']);
//                $session->set('description', $activity['description']);
//                $session->set('is_blocked', $activity['is_blocked']);
//                $session->set('is_repeated', $activity['is_repeated']);
//                $session->set('images', $activity['imagesNewNames']);
}
