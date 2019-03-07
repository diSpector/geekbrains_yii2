<?php

namespace app\behaviors;


use app\models\Activity;
use yii\base\Behavior;

class SetActivityUpdate extends Behavior
{
    public $attribute_name;

    public function events()
    { // перед update модели Activity будет вызываться метод updateActivityDate()
        return [
            Activity::EVENT_BEFORE_UPDATE => 'updateActivityDate', // перед update модели Activity будет вызываться
        ];
    }
    public function updateActivityDate(){ // получает текущую дату/время и записывает их в date_updated модели
        $dateOfUpdate = date('Y-m-d H:i:s', strtotime("+3 hours"));
        $this->owner->{$this->attribute_name} = $dateOfUpdate;
    }


}