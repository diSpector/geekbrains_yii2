<?php

namespace app\components;


use yii\base\Component;
use yii\mail\MailerInterface;
use app\models\Activity;

class NotificationComponent extends Component
{
    /** @var MailerInterface */
    public $mailer;

    /** $activities Activity[]
     * @return \Generator
     */
    public function sendTodayNotification($activities)
    {
        foreach ($activities as $activity) {
            $result = $this->mailer->compose('notification', ['model' => $activity])
                ->setFrom('dmitry_mailer@mail.ru')
//                ->setTo(['dmitry_proekt@mail.ru'])
                ->setTo(['dmitry_proekt@mail.ru',$activity->user->email])
                ->setSubject('Событие сегодня')
//                ->setReplyTo()
                ->setCharset('utf-8')
//                ->attach(\Yii::getAlias('@app/web/images/Livello26.png'))
                ->send();

            yield['result'=>$result, 'email'=>$activity->user->email];
        }
    }

    public function composeEmail($activities, $email, $subject){
//        if($activities){
            return $this->mailer->compose('emailbody', ['activities' => $activities])
                ->setFrom('dmitry_mailer@mail.ru')
                ->setTo(['dmitry_proekt@mail.ru', $email])
                ->setSubject($subject)
                ->setCharset('utf-8')
                ->send();
//        }
//        return false;
    }

//    public function sendNotification($activity){
//        $this->mailer->compose('notification', ['model' => $activity])
//            ->setFrom('dmitry_mailer@mail.ru')
//            ->setTo(['dmitry_proekt@mail.ru',$activity->user->email])
//            ->setSubject('Ваши события')
//            ->setCharset('utf-8')
//            ->send();
//    }

}