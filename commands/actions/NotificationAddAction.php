<?php

namespace app\commands\actions;


use app\jobs\NotificationEmailJob;
use yii\base\Action;

class NotificationAddAction extends Action
{
    // добавление задания в очередь
    public function run(){
        $activity = \Yii::$container->get('ActivityEntity');
        $activity->title = 'test ' . uniqid();
        $id = \Yii::$app->queue->push(new NotificationEmailJob(['activity' => $activity]));
        echo 'job id ' . $id. PHP_EOL;
    }
}