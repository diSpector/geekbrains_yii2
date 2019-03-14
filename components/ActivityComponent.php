<?php

namespace app\components;

use app\models\Activity;
use app\models\ActivitySearch;
use yii\base\Component;
use yii\web\UploadedFile;

class ActivityComponent extends Component
{
    public $activity_class;

    /**
     * @param null $params
     * @return Activity
     */
    public function getModel($params = null)
    {
//        print_r($params);
        /** @var Activity $model */
        $model = new $this->activity_class;
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
//            $model->images = UploadedFile::getInstances($model, 'images');
//            $path = $this->getPathSaveFile();
//            foreach ($model->images as $image) {
//                $name = mt_rand(0, 9999) . time() . '.' . $image->getExtension();
//                if (!$image->saveAs($path . $name)) {
//                    $model->addError('images', 'Файл не удалось переместить');
//                    return false;
//                }
//                $model->imagesNewNames[] = $name;
//            }
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
        $model = new ActivitySearch();
        return $model->getDataProvider();
    }

    public function getSearchProviderWithQuery($query)
    {
        $model = new ActivitySearch();
        return $model->getDataProviderWithQuery($query);
    }

    // создание компонента через DAO
//    public function createActivity(&$model)
//    {
//        if ($model->validate()) {
//            $model->images = UploadedFile::getInstances($model, 'images');
//            $path = $this->getPathSaveFile();
//            foreach ($model->images as $image) {
//                $name = mt_rand(0, 9999) . time() . '.' . $image->getExtension();
//                if (!$image->saveAs($path . $name)) {
//                    $model->addError('images', 'Файл не удалось переместить');
//                    return false;
//                }
//                $model->imagesNewNames[] = $name;
//            }
//            return true;
//        }
//    }

    /**
     * Получение списка сегодняшних событий
     * @return Activity[]
     */
    public function getActivityToday()
    {
        $activities = Activity::find()
            ->andWhere('timeStart >=:date', [':date' => date('Y-m-d')])
            ->andWhere(['use_notification' => 1])->all();

        return $activities;
    }

    // вернуть ВСЕ события для пользователя с указанным user_id
    public function getAllActivitiesForUser($userId){
        $activities = Activity::find()
            ->andWhere(['user_id' => $userId])
            ->all();
        return $activities;
    }

    // вернуть все события с use_notification = 1 с указанным user_id
    public function getAllActivitiesWithNotificationsForUser($userId){
        $activities = Activity::find()
            ->andWhere(['user_id' => $userId])
            ->andWhere(['use_notification' => 1])
            ->all();
        return $activities;
    }

    // вернуть все события на сегодня с use_notification = 1 с указанным user_id
    public function getAllActivitiesForUserByToday($userId){
        $activities = Activity::find()
            ->andWhere(['user_id' => $userId])
            ->andWhere(['use_notification' => 1])
            ->andWhere(['dateAct' => date('Y-m-d')])
            ->all();

        return $activities;
    }
}