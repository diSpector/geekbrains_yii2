<?php

namespace app\models\rules;

class CorrectTimeStart extends TimeConversionTools
{
    public function validateAttribute($model, $attribute)
    {
        // сравнение времени начала события и текущего времени
        $timeNow = time() + 3*60*60; // время + 3 часа
        $timeNow1 = date('d-m-Y', $timeNow); // дата (ДД-ММ-ГГГГ) с учетом времени +3 часа
        $timeNowFinal = strtotime($timeNow1); // таймстамп ПРАВИЛЬНОЙ ДАТЫ
        $userTime = strtotime($model->dateAct); // timestamp числа, введенного пользователем
        $timeForCompare = date('h:i', $timeNow); // текущее время в формате ЧЧ:ММ

        $times = $this->getNormalTimesArray($timeForCompare, $model->$attribute); // [текущее время, время начала от пользователя]
        // $times[0] - текущее время, $times[1] - время timeStart, выбранное пользователем
        if (($times[0] >= $times[1]) && ($userTime == $timeNowFinal)){
            $model->addError($attribute, "Время начала события на сегодня должно быть больше текущего времени");
        }
    }
}