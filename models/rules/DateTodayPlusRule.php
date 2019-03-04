<?php

namespace app\models\rules;

use yii\validators\Validator;

class DateTodayPlusRule extends Validator
{
    public function validateAttribute($model, $attribute)
    {
        // сравнение даты, которую ввел пользователь, со сегодняшней датой
        $dayByUser = strtotime($model->$attribute); // дата, которую ввел пользователь преобразована в timestamp

        $today = strtotime('today midnight'); // timestamp сегодняшней даты в полночь

        if ($dayByUser < $today){
            $model->addError($attribute, "Нельзя назначить событие на прошедшую дату");
        }
    }
}