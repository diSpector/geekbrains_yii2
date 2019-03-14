<?php

namespace app\components\activity;


use yii\base\Component;

class ActivityService implements ActivityInterface
{

//    public $activity_entity;
//
//
//    // DI
//    public function __construct(ActivityEntity $activity_entity)
//    {
//        $this->activity_entity = $activity_entity;
//    }

    /**
     * @param null $params
     * @return ActivityEntity
     */
    public function getModel($params = null)
    {
//        print_r($params);
        /** @var Activity $model */
//        $model = $this->activity_class;
        $model = \Yii::$container->get('ActivityEntity');
        if ($params && is_array($params)) {
            $model->load($params);
        }
        $model->trigger($model::EVENT_MY_EVENT);
        return $model;
    }

    /**
     * @param $id
     * @return Activity|array|null|\yii\db\ActiveRecord
     */
    public function getActivity($id)
    {
        return $this->getModel()::find()->andWhere(['id' => $id])->one();
    }

    // создание компонента через ActiveRecord

    /**
     * @param $model Activity
     */
    public function createActivity(&$model)
    {
        $model->user_id = \Yii::$app->user->id; // записать в модель Активности id текущего залогиненного пользователя
        if ($model->validate()) {
            $model->save();
            return true;
        } else {
            print_r($model->errors);
            return false;
        }

    }

    /**
     * @param $model Activity
     * @return bool
     */
    public function updateActivity(&$model)
    {
        if ($model->validate()) {
            $model->update();
            return true;

        } else {
//            print_r($model->errors);
            return false;
        }
    }

    public function deleteActivity($id)
    {
        if ($this->getActivity($id)->delete()) {
            return true;
        } else {
            print_r("Ошибка при удалении");
            return false;
        }
    }


    private function getPathSaveFile()
    {
        return \Yii::getAlias('@app/web/images/');
    }

    /**
     * @param $params
     * @return \yii\data\ActiveDataProvider
     */
    public function getSearchProvider($params)
    {
//        $model = new ActivitySearch();
        $model = \Yii::$container->get('app\components\activity\SearchInterface');
        return $model->getDataProvider();
    }

    public function getSearchProviderWithQuery($query)
    {
//        $model = new ActivitySearch();
        $model = \Yii::$container->get('app\components\activity\SearchInterface');
        return $model->getDataProviderWithQuery($query);
    }


    /**
     * Получение списка сегодняшних событий
     * @return Activity[]
     */
    public function getActivityToday()
    {
//        $activities = Activity::find()
        $activities = \Yii::$container->get('ActivityEntity')::find()
            ->andWhere('timeStart >=:date', [':date' => date('Y-m-d')])
            ->andWhere(['use_notification' => 1])->all();

        return $activities;
    }

    // вернуть ВСЕ события для пользователя с указанным user_id
    public function getAllActivitiesForUser($userId)
    {
//        $activities = Activity::find()
        $activities = \Yii::$container->get('ActivityEntity')::find()
            ->andWhere(['user_id' => $userId])
            ->all();
        return $activities;
    }

    // вернуть все события с use_notification = 1 с указанным user_id
    public function getAllActivitiesWithNotificationsForUser($userId)
    {
//        $activities = Activity::find()
        $activities = \Yii::$container->get('ActivityEntity')::find()
            ->andWhere(['user_id' => $userId])
            ->andWhere(['use_notification' => 1])
            ->all();
        return $activities;
    }

    // вернуть все события на сегодня с use_notification = 1 с указанным user_id
    public function getAllActivitiesForUserByToday($userId)
    {
//        $activities = Activity::find()
        $activities = \Yii::$container->get('ActivityEntity')::find()
            ->andWhere(['user_id' => $userId])
            ->andWhere(['use_notification' => 1])
            ->andWhere(['dateAct' => date('Y-m-d')])
            ->all();

        return $activities;
    }
}