<?php

namespace app\models;

use yii\base\Model;

class Activity extends Model
{
    public $title;
    public $description;
    public $date_start;
    public $is_blocked;
    public $is_repeated; // флаг повторяющегося события

    public function rules()
    {
        return [
            ['title', 'string', 'max' => 150, 'min' => 2],
            [['title', 'description'], 'required'],
            ['is_blocked' , 'boolean'],
            ['is_repeated' , 'boolean'],

        ];
    }

    public function attributeLabels()
    {
        return [
            'title' => 'Заголовок активности',
            'description' => 'Описание',
            'is_blocked' => 'Блокирующее',
            'is_repeated' => 'Повторяющееся',
        ];
    }

}