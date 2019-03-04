<?php

namespace app\components;

use app\models\Activity;
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
//            print_r($model->errors);
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

    private function getPathSaveFile()
    {
        return \Yii::getAlias('@app/web/images/');
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
}