<?php

namespace app\components;

use app\models\Activity;
use yii\base\Component;
use yii\helpers\Json;

class ActivityComponent extends Component
{
    public $activity_class;

    public function getModel($params = null){
        $model = new $this->activity_class;
        if ($params && is_array($params)){
            $model->load($params);
        }
        return $model;
    }

    /**
     * @param $model Activity
     */
    public function createActivity(&$model){
        if($model->validate()){

            $path=$this->getPathSaveFile();
            $name=mt_rand(0,9999).time().'.'.$model->image->getExtension();

            if(!$model->image->saveAs($path.$name)){
                $model->addError('image','Файл не удалось переместить');
                return false;
            }
            $model->image=$name;

            return true;


        }
    }

    private function getPathSaveFile()
    {
        return \Yii::getAlias('@app/web/images/');
    }
}