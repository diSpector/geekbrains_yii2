<?php

namespace app\components;

use yii\base\Component;

class CalendarComponent extends Component
{
    public $calendar_class;

    public function getModel($params = null){
        $model = new $this->calendar_class;
        if ($params && is_array($params)){
            $model->load($params);
        }
        return $model;
    }

    // получить все события АВТОРИЗОВАННОГО пользователя
    public function getActivities(){
        $loggedUserId = \Yii::$app->user->id;
        /** @var ActivityComponent $activityComponent */
        $activityComponent = \Yii::$app->activity;
        $allActivities = $activityComponent->getModel()::find()->andWhere(['user_id'=> $loggedUserId])->all();
        return $allActivities;
    }

    // получить ВСЕ события всех пользователей
    public function getAllActivities(){
        $activityComponent = \Yii::$app->activity;
        $allActivities = $activityComponent->getModel()::find()->all();
        return $allActivities;
    }

    // получить ВСЕ события ВСЕХ пользователей за день
    public function getAllActivitiesByDay($date){
        $activityComponent = \Yii::$app->activity;
        $allActivities = $activityComponent->getModel()::find()->andWhere(['dateAct' => $date])->all();
        return $allActivities;
    }


    // получить события пользователя, назначенные на выбранный день
    public function getActivitiesByDay($date){
        $loggedUserId = \Yii::$app->user->id;
        $activityComponent = \Yii::$app->activity;
        $allActivities = $activityComponent->getModel()::find()->andWhere(['user_id'=> $loggedUserId, 'dateAct' => $date])->all();
        return $allActivities;
    }

    public function createCalendar(&$model){
        return $model->validate();
    }
}