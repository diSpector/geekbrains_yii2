<?php
/**
 * Created by PhpStorm.
 * User: Ирина
 * Date: 20.02.2019
 * Time: 1:11
 */

namespace app\controllers\actions;

use app\models\Activity;
use yii\base\Action;

class ActivityCreateAction extends Action
{
    public function run()
    {
        $comp = \Yii::$app->activity;
        if (\Yii::$app->request->isPost) {
            $activity = $comp->getModel(\Yii::$app->request->post());

            $activity['is_blocked'] = $activity['is_blocked'] === '0' ? 'Нет' : 'Да';
            $activity['is_repeated'] = $activity['is_repeated'] === '0' ? 'Нет' : 'Да';
            $comp->createActivity($activity);
            return $this->controller->render('create-confirm', ['activity' => $activity]);

            //
//            $activity->validate();
        } else {
            $activity = $comp->getModel();
            return $this->controller->render('create', ['activity' => $activity]);

        }
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