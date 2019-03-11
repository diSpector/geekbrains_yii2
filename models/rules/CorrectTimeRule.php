<?php

namespace app\models\rules;

use app\models\Activity;

class CorrectTimeRule extends TimeConversionTools
{
    /**
     * @param Activity $model
     * @param string $attribute
     */
    public function validateAttribute($model, $attribute)
    {
        // сравнение времени начала и конца события, которые ввёл пользователь
        // получить массив из 2 значений времени, преобразованных в числа
        $times = $this->getNormalTimesArray($model->timeStart, $model->$attribute);

        if ($times[0] >= $times[1]){
            $model->addError($attribute, "Время окончания события должно быть больше времени начала");
        }
    }
}