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

    public function createCalendar(&$model){
        return $model->validate();
    }
}