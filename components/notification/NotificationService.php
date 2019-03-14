<?php

namespace app\components\notification;


use yii\mail\MailerInterface;

class NotificationService implements NotificationInterface{
    /** @var  MailerInterface*/
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer=$mailer;
    }

    public function composeEmail($activities, $email, $subject){
        return $this->mailer->compose('emailbody', ['activities' => $activities])
            ->setFrom('dmitry_mailer@mail.ru')
            ->setTo(['dmitry_proekt@mail.ru', $email])
            ->setSubject($subject)
            ->setCharset('utf-8')
            ->send();
    }

    /**
     * @param $activities
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


}