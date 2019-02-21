<?php

namespace app\models;

use app\models\rules\NotAdminRule;
use yii\base\Model;
use yii\web\UploadedFile;

class Activity extends Model
{
    public $title;
    public $description;
    public $date_start;
    public $is_blocked;
    public $is_repeated; // флаг повторяющегося события

    public $as_repeat;
    public $use_notification;

    public $email;
    public $email_repeat;

    /** @var UploadedFile */
    public $image;

    const SCENARIO_CUSTOM='custom_sc';

    public function beforeValidate()
    {
        $this->loadFile();
        if(!empty($this->date_start)){
            $this->date_start=\DateTime::createFromFormat('d.m.Y',$this->date_start);
            if($this->date_start){
                $this->date_start=$this->date_start->format('Y-m-d');
            }
        }
        return parent::beforeValidate();
    }

    public function loadFile(){
        /** @var UploadedFile image */
        $this->image=UploadedFile::getInstance($this,'image');
    }



    public function rules()
    {
        return [
            ['title', 'string', 'max' => 150, 'min' => 2],
            [['title', 'description'], 'required'],
            ['title','trim'],
            ['image','file','extensions' => ['png','jpg']],
            ['title',NotAdminRule::class],
//            ['title','notAdmin'],
//            ['email','match','pattern' => '/[a-Z]{3,}/'],
//            ['description','strtolower'],
            [['is_blocked','use_notification'] , 'boolean'],
            ['date_start','date','format' => 'php:Y-m-d','message' => 'Формат даты должен быть dd.mm.yyyy'],
            ['email','email'],
            ['email','required','when' => function($model){
                return $model->use_notification?true:false;
            }],
            ['email_repeat','compare','compareAttribute'=>'email'] ,
            ['as_repeat','in','range' => [0,1,2,3]],
//            ['title','double'],
            ['is_repeated' , 'boolean'],

        ];
    }

    public function notAdmin($attribute,$value){
        if($this->$attribute=='admin'){
            $this->addError($attribute,
                'Заголовок события не должен быть '.$this->$attribute);
        }
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