<?php

namespace app\models\rules;

class CorrectTimeStart extends TimeConversionTools
{
    public function validateAttribute($model, $attribute)
    {
        // сравнение времени начала события и текущего времени
        $timestampNow = time() + 3*60*60; // timestamp время сейчас + 3 часа
        $dateNow = date('d-m-Y', $timestampNow); // дата сейчас из $timestampNow
        $timeNow = date('H:i', $timestampNow); // время сейчас из $timestampNow

        $timestampOfUserDate = strtotime($model->dateAct);
        $userDate = date('d-m-Y', $timestampOfUserDate); // дата, введенная пользователем
        $userTime = $model->$attribute; // время, введенное пользователем

        $times = $this->getNormalTimesArray($timeNow, $userTime); // [текущее время, время начала от пользователя]
        // $times[0] - текущее время, $times[1] - время timeStart, выбранное пользователем
        if (($times[0] >= $times[1]) && ($dateNow == $userDate)){
            $model->addError($attribute, "Время начала события на сегодня должно быть больше текущего времени");
        }

    }
}