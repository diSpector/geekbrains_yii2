<?php

namespace app\jobs;


use yii\base\BaseObject;
use yii\queue\JobInterface;
use yii\queue\Queue;

class NotificationEmailJob extends BaseObject implements JobInterface
{
    public $activity;
    /**
     * @param Queue $queue which pushed and is handling the job
     */
    public function execute($queue)
    {
        echo "Отправили email" . $this->activity->title;
//        $activities = \Yii::$app->activity->getActivityToday();
//
//        /** @var NotificationComponent $notif_comp */
//        // старая версия
////        $notif_comp = \Yii::createObject(['class' => NotificationComponent::class,
////            'mailer' => \Yii::$app->mailer]);
//// версия с Dependency Injection
////        \Yii::$container->set(\yii\mail\MailerInterface::class, function(){
////            return \Yii::$app->mailer;
////        });
//        $notif_comp = \Yii::$container->get('app\components\notification\NotificationInterface');
////        print_r($notif_comp);
////        exit;
//
//        foreach ($notif_comp->sendTodayNotification($activities) as $result) {
//            if ($result['result']) {
//                echo 'Успешно отправлено письмо' . $result['email'];
//            } else {
//                echo 'Ошибка отправки письма' . $result['email'];
//
//            }
//
//        }
    }
}