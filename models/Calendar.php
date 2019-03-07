<?php

namespace app\models;

use yii\base\Model;

class Calendar extends Model
{
    public $dateAct; // дата из календаря
    public $activities; // массив ВСЕХ событий из БД (пока только 1 событие из сессии)

    public function rules(){
        return [
            ['dateAct', 'required'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'dateAct' => 'Выберите дату',
        ];
    }
}