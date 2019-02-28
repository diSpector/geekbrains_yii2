<?php

namespace app\models;


use yii\base\Model;

class Day extends Model
{
    public $dayName; // день из календаря
    public $is_dayoff; // флаг выходного дня
    public $activities;
//    public $activities = [ // заглушка для массива событий
//        '0' => 'Встреча',
//        '1' => 'Тренировка',
//        '2' => 'Обучение'
//    ];
    public $params = [
        'prompt' => 'Выберите активность',
    ];

    public function rules()
    {
        return [
            [['dayName', 'activities'], 'required'],
            ['is_dayoff', 'boolean'],
        ];
    }
//
//    public function rules()
//    {
//        return [
//            ['title', 'string', 'max' => 150, 'min' => 2],
//            [['title', 'description'], 'required'],
//            ['is_blocked' , 'boolean'],
//            ['is_repeated' , 'boolean'],
//
//        ];
//    }
    public function attributeLabels()
    {
        return [
            'dayName' => 'Выберите день',
            'is_dayoff' => 'Выходной',
            'activities' => 'События',
        ];
    }
}

