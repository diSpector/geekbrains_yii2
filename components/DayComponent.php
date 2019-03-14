<?php

namespace app\components;

use yii\base\Component;

class DayComponent extends Component
{
    public $day_class;

    public function getModel($params = null){
        $model = new $this->day_class;
        if ($params && is_array($params)){
            $model->load($params);
        }
        return $model;
    }

    public function createDay(&$model){
        return $model->validate();
    }
}
