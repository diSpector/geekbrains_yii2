<?php
//
//namespace app\models;
//
////use app\models\rules\NotAdminRule;
//use yii\base\Model;
//use yii\web\UploadedFile;
//use app\models\rules\CorrectTimeRule;
//use app\models\rules\CorrectTimeStart;
//use app\models\rules\DateTodayPlusRule;
//
//
//
//class Activity extends ActivityBase
////class Activity extends Model
//
//{
//    // нужно закомментировать св-ва, т.к. теперь мы наследуемся от ActivityBase,
//    // а там все св-ва уже определены
////    public $title; // название
////    public $dateAct; // дата события
////    public $timeStart; // начало события
////    public $timeEnd; // конец события
////    public $use_notification; // оповещение о событии
////    public $description; // описание
////    public $is_blocked; // блокирующее событие
////    public $is_repeated; // флаг повторяющегося события
////    public $images; // картинки для события
////    public $imagesNewNames; // массив картинок с новыми именами (после сохранения)
//
//// старые данные
////    public $date_start;
////    public $email;
////    public $email_repeat;
////
////    /** @var UploadedFile */
////    public $image;
////
////    const SCENARIO_CUSTOM = 'custom_sc';
//
//    public function rules()
//    {
//        // после наследования от ActivityBase объединим массивы правил
//        return array_merge([
//            [['title', 'description', 'timeStart', 'timeEnd', 'dateAct'], 'required'],
//            [['is_blocked', 'is_repeated', 'use_notification'], 'boolean'],
////            [['images'], 'file', 'extensions' => 'jpg, png', 'maxFiles' => 4],
////            [['images'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg', 'maxFiles' => 4],
////            ['dateAct', 'date', 'format' => 'php:d-m-Y', 'timestampAttribute' => 'dateAct'],
//            ['dateAct', 'date', 'format' => 'php:d-m-Y'],
//            ['timeStart', CorrectTimeStart::class], // время начала события д.б. больше текущего времени
//            ['timeEnd', CorrectTimeRule::class], // время окончания события д.б. больше времени начала
//            ['dateAct', DateTodayPlusRule::class], // новое событие нельзя назначить на прошедшую дату
//        ], parent::rules());
//
////        return [
////            [['title', 'description', 'timeStart', 'timeEnd', 'dateAct'], 'required'],
////            [['is_blocked', 'is_repeated', 'use_notification'], 'boolean'],
////            [['images'], 'file', 'extensions' => 'jpg, png', 'maxFiles' => 4],
//////            [['images'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg', 'maxFiles' => 4],
//////            ['dateAct', 'date', 'format' => 'php:d-m-Y', 'timestampAttribute' => 'dateAct'],
////            ['dateAct', 'date', 'format' => 'php:d-m-Y'],
////            ['timeStart', CorrectTimeStart::class], // время начала события д.б. больше текущего времени
////            ['timeEnd', CorrectTimeRule::class], // время окончания события д.б. больше времени начала
////            ['dateAct', DateTodayPlusRule::class], // новое событие нельзя назначить на прошедшую дату
////        ];
//    }
//
//    public function attributeLabels()
//    {
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
//    }
//
////    public function rules()
////    {
////        return [
////            ['title', 'string', 'max' => 150, 'min' => 2],
////            [['title', 'description'], 'required'],
////            // правило выполнится, если будет выполнен сценарий, объявленный в контроллере
////            ['title', NotAdminRule::class, 'on' => self::SCENARIO_CUSTOM],
//////            ['title', 'notAdmin'], // собственная функция, потом вынесли в отдельный класс models\rules\NotAdminRule
////            [['is_blocked', 'is_repeated', 'use_notification' ], 'boolean'],
////            [['email', 'email_repeat'], 'email'],
////            // если пользователь хочет получать уведомления, то поле email - обязательно, иначе - нет
////            ['email', 'required', 'when' => function($model){
////                return $model->use_notification ? true : false;
////            }],
////            ['email_repeat', 'compare', 'compareAttribute' => 'email'],
////            ['date_start', 'date', 'format' => 'php:d-m-Y', 'message' => 'Формат даты должен быть ДД-ММ-ГГГГ'],
////            ['image', 'file', 'extensions' => ['jpg', 'png']],
////        ];
////    }
////
////    public function notAdmin($attribute, $value){
////        if ($this->$attribute == 'admin'){
////            $this->addError($attribute, "Атрибут не может называться " . $this->$attribute);
////        }
////    }
////
////    public function attributeLabels()
////    {
////        return [
////            'title' => 'Заголовок активности',
////            'description' => 'Описание',
////            'is_blocked' => 'Блокирующее',
////            'is_repeated' => 'Повторяющееся',
////            'email' => 'Email',
////            'email_repeat' => 'Повторите Email',
////            'date_start' => 'Дата начала',
////            'use_notification' => 'Использовать уведомление',
////        ];
////    }
////
////    public function beforeValidate()
////    {
////        $this->loadFile();
////        return parent::beforeValidate(); // TODO: Change the autogenerated stub
////    }
////
////    public function loadFile(){
////        /** @var UploadedFile image */
////        $this->image = UploadedFile::getInstance($this, 'image');
////
////    }
//
//}