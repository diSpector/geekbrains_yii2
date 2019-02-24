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
        if (\Yii::$app->request->isPost) {
            /** @var Activity $activity */
            $activity = $comp->getModel(\Yii::$app->request->post());
//            $activity->setScenario($activity::SCENARIO_CUSTOM);

//            if(\Yii::$app->request->isAjax){
//                \Yii::$app->response->format = Response::FORMAT_JSON;
//                return ActiveForm::validate($activity);
//            }
            if ($comp->createActivity($activity)) {
                $session = \Yii::$app->session;
                $session->set('title', $activity['title']);
                $session->set('dateAct', $activity['dateAct']);
                $session->set('timeStart', $activity['timeStart']);
                $session->set('timeEnd', $activity['timeEnd']);
                $session->set('use_notification', $activity['use_notification']);
                $session->set('description', $activity['description']);
                $session->set('is_blocked', $activity['is_blocked']);
                $session->set('is_repeated', $activity['is_repeated']);
                $session->set('images', $activity['imagesNewNames']);

                return $this->controller->render('create-confirm', ['activity' => $activity]);

            }

        } else {
            $activity = $comp->getModel();
        }
        return $this->controller->render('create', ['activity' => $activity]);

    }
}
