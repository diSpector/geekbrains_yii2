<?php

namespace app\models\rules;

use yii\validators\Validator;

class DateTodayPlusRule extends Validator
{
    public function validateAttribute($model, $attribute)
    {
        // сравнение даты, которую ввел пользователь, со сегодняшней датой
        $dayByUser  = mktime(date('h')+3, 0, 0, date("m"), date("d"), date("Y"));
        $today = strtotime($model->$attribute); // дата, которую ввел пользователь преобразована в timestamp

        if ($today < $dayByUser){
            $model->addError($attribute, "Нельзя назначить событие на прошедшую дату");
        }
    }
}