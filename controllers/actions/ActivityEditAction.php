<?php
/**
 * Created by PhpStorm.
 * User: Ирина
 * Date: 24.02.2019
 * Time: 18:15
 */

namespace app\controllers\actions;


use yii\base\Action;

class ActivityEditAction extends Action
{
    public function run()
    {
        $comp = \Yii::$app->activity;
//        $activity = $comp->getModel(\Yii::$app->request->post());

        if (\Yii::$app->request->isPost) {
            /** @var Activity $activity */
            $activity = $comp->getModel(\Yii::$app->request->post());
////            $activity->setScenario($activity::SCENARIO_CUSTOM);
//
////            if(\Yii::$app->request->isAjax){
////                \Yii::$app->response->format = Response::FORMAT_JSON;
////                return ActiveForm::validate($activity);
////            }
            if ($comp->createActivity($activity)) {
                $session = \Yii::$app->session;
                $session->set('activity', $activity);
                return $this->controller->render('create-confirm', ['activity' => $activity]);
            }
//
        } else {
            $activity = $comp->getModel();
        }
        return $this->controller->render('edit', ['activity' => $activity]);

    }
}