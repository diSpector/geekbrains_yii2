<?php

namespace app\models\rules;

use yii\validators\Validator;

class TimeConversionTools extends Validator{

    // вернуть массив целых чисел после преобразования и удаления двоеточий из каждого элемента
    public function getNormalTimesArray($timeStart, $timeEnd){
        return array_map('intval', $this->deleteSemiColonFromTime([$timeStart, $timeEnd]));
    }

    // удалить двоеточия из каждого элемента массива
    public function deleteSemiColonFromTime($timesArr){
        return preg_replace('/:/', '', $timesArr);
    }
}