<?php

namespace app\components;

use yii\base\Component;

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

    public function createActivity(&$model){
        return $model->validate();
    }
}