<?php

namespace app\models;

//use app\models\rules\NotAdminRule;
use app\behaviors\GetDateFunctionFormatBehavior;
use app\behaviors\LogMyBehavior;
use app\behaviors\SetActivityUpdate;
use yii\base\Model;
use yii\web\UploadedFile;
use app\models\rules\CorrectTimeRule;
use app\models\rules\CorrectTimeStart;
use app\models\rules\DateTodayPlusRule;


class Activity extends ActivityBase
{
    const EVENT_MY_EVENT = 'my event';

    public function behaviors()
    {
        return [
            [
                'class' => GetDateFunctionFormatBehavior::class,
                'attribute_name' => 'date_created', // какое значение из БД будет выводиться
//                'attribute_name' => 'dateAct',

            ],
            [ // поведение, описываемое классом SetActivityUpdate (обновляет date_updated)
                'class' => SetActivityUpdate::class,
                'attribute_name' => 'date_updated', // какое значение из БД будет обновляться
            ],
            LogMyBehavior::class,
        ];
    }

//    public $images; // картинки для события
//    public $imagesNewNames; // массив картинок с новыми именами (после сохранения)

//    /** @var UploadedFile */
//    public $image;
//
//    const SCENARIO_CUSTOM = 'custom_sc';

    public function fields()
    {
        return [
            'id',
            'title',
            'description',
            'user_email' => function ($model) {
                return $model->user->email;
            }
        ];
    }

    public function extraFields()
    {
        return [
            'user_id',
            'email',
            'timeStart',
            'use_notification' => function ($model) {
                return $model->use_notification ? 'Да' : 'Нет';
            },
        ];
    }

    public function rules()
    {
        // после наследования от ActivityBase объединим массивы правил
        return array_merge([
//            [['images'], 'file', 'extensions' => 'jpg, png', 'maxFiles' => 4],
//            [['images'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg', 'maxFiles' => 4],
//            ['dateAct', 'date', 'format' => 'php:d-m-Y', 'timestampAttribute' => 'dateAct'],
//            ['dateAct', 'date', 'format' => 'php:d-m-Y'],
            ['dateAct', 'date', 'format' => \Yii::$app->params['date_format']['date_format_backend']],
            ['timeStart', CorrectTimeStart::class], // время начала события д.б. больше текущего времени
            ['timeEnd', CorrectTimeRule::class], // время окончания события д.б. больше времени начала
            ['dateAct', DateTodayPlusRule::class], // новое событие нельзя назначить на прошедшую дату
        ], parent::rules());
    }

    // дата, введенная пользователем, будет преобразовываться в формат timestamp для БД перед сохранением в БД
    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }
//        echo 'Отрабатывает BeforeSave ';
        $userDate = $this->dateAct; // дата, полученная от пользователя
        $this->dateAct = date(\Yii::$app->params['date_format']['date_database'], strtotime($userDate));
        return true;
    }


    public function attributeLabels()
    {
        return array_merge([
            'title' => 'Название',
            'dateAct' => 'Дата',
            'timeStart' => 'Время начала',
            'timeEnd' => 'Время окончания',
            'use_notification' => 'Уведомление',
//            'images' => 'Прикрепить файлы (макс. 4 шт.)',
            'description' => 'Описание',
            'is_blocked' => 'Блокирующее',
            'is_repeated' => 'Повторяющееся',
        ], parent::attributeLabels());

//        return [
//            'title' => 'Название',
//            'dateAct' => 'Дата',
//            'timeStart' => 'Время начала',
//            'timeEnd' => 'Время окончания',
//            'use_notification' => 'Уведомление',
////            'images' => 'Прикрепить файлы (макс. 4 шт.)',
//            'description' => 'Описание',
//            'is_blocked' => 'Блокирующее',
//            'is_repeated' => 'Повторяющееся',
//        ];
    }

//    public function rules()
//    {
//        return [
//            ['title', 'string', 'max' => 150, 'min' => 2],
//            [['title', 'description'], 'required'],
//            // правило выполнится, если будет выполнен сценарий, объявленный в контроллере
//            ['title', NotAdminRule::class, 'on' => self::SCENARIO_CUSTOM],
////            ['title', 'notAdmin'], // собственная функция, потом вынесли в отдельный класс models\rules\NotAdminRule
//            [['is_blocked', 'is_repeated', 'use_notification' ], 'boolean'],
//            [['email', 'email_repeat'], 'email'],
//            // если пользователь хочет получать уведомления, то поле email - обязательно, иначе - нет
//            ['email', 'required', 'when' => function($model){
//                return $model->use_notification ? true : false;
//            }],
//            ['email_repeat', 'compare', 'compareAttribute' => 'email'],
//            ['date_start', 'date', 'format' => 'php:d-m-Y', 'message' => 'Формат даты должен быть ДД-ММ-ГГГГ'],
//            ['image', 'file', 'extensions' => ['jpg', 'png']],
//        ];
//    }
//
//    public function notAdmin($attribute, $value){
//        if ($this->$attribute == 'admin'){
//            $this->addError($attribute, "Атрибут не может называться " . $this->$attribute);
//        }
//    }
//
//    public function attributeLabels()
//    {
//        return [
//            'title' => 'Заголовок активности',
//            'description' => 'Описание',
//            'is_blocked' => 'Блокирующее',
//            'is_repeated' => 'Повторяющееся',
//            'email' => 'Email',
//            'email_repeat' => 'Повторите Email',
//            'date_start' => 'Дата начала',
//            'use_notification' => 'Использовать уведомление',
//        ];
//    }
//
//    public function beforeValidate()
//    {
//        $this->loadFile();
//        return parent::beforeValidate(); // TODO: Change the autogenerated stub
//    }
//
//    public function loadFile(){
//        /** @var UploadedFile image */
//        $this->image = UploadedFile::getInstance($this, 'image');
//
//    }

}