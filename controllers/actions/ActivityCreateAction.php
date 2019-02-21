<?php
/**
 * Created by PhpStorm.
 * User: Ирина
 * Date: 20.02.2019
 * Time: 1:11
 */

namespace app\controllers\actions;

use app\components\ActivityComponent;
use app\models\Activity;
use yii\base\Action;
use yii\web\Response;
use yii\widgets\ActiveForm;

class ActivityCreateAction extends Action
{
    public function run()
    {
        /** @var ActivityComponent $comp */
        $comp = \Yii::$app->activity;
        if (\Yii::$app->request->isPost) {

            /** @var Activity $activity */
            $activity = $comp->getModel(\Yii::$app->request->post());
//            $activity->setScenario($activity::SCENARIO_CUSTOM);

            if(\Yii::$app->request->isAjax){
                \Yii::$app->response->format=Response::FORMAT_JSON;

                return ActiveForm::validate($activity);
            }


//            $activity['is_blocked'] = $activity['is_blocked'] === '0' ? 'Нет' : 'Да';
//            $activity['is_repeated'] = $activity['is_repeated'] === '0' ? 'Нет' : 'Да';
            if($comp->createActivity($activity)) {
                return $this->controller->render('create-confirm', ['activity' => $activity]);
            }
            //
//            $activity->validate();
        } else {
            $activity = $comp->getModel();

        }

        return $this->controller->render('create', ['activity' => $activity]);
    }

}

//        $activity = new Activity();
//        $activity = \Yii::$app->activity->getModel();
//        if (\Yii::$app->request->isPost) {
//            $activity->load(\Yii::$app->request->post());
//            $activity->validate();
//        }
//
//        $activity->is_blocked = 1;
//        $activity->description = 'Hello';