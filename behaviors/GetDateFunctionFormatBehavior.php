<?php

namespace app\behaviors;

use yii\base\Behavior;

class GetDateFunctionFormatBehavior extends Behavior
{
    public $attribute_name;

    public function getDate(){
        $date = $this->owner->{$this->attribute_name};

        return \Yii::$app->formatter->asDate($date);
    }
}