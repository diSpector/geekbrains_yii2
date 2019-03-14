<?php
/**
 * Created by PhpStorm.
 * User: Ирина
 * Date: 06.03.2019
 * Time: 23:16
 */

namespace app\behaviors;


use app\models\Users;
use yii\base\Behavior;

class SendEmailAfterAdminCreateUser extends Behavior
{
    public $attribute_name;

    public function events()
    { // на собыие ADMIN_CREATE_USER модели Users повешен метод sendEmailWithPassword
        return [
            Users::ADMIN_CREATE_USER => 'sendEmailWithPassword', // перед update модели Activity будет вызываться
        ];
    }
    public function sendEmailWithPassword(){
        // генерация случайного числа от 6 до 8 цифр в качестве пароля - грубо, но в качестве учебного задания подойдет
        $randomPassword = random_int(100000, 99999999);
        \Yii::$app->mailer->compose()
            ->setFrom('from@domain.com')
            ->setTo($this->owner->{$this->attribute_name})
            ->setSubject('Subject')
            ->setTextBody('Message Text')
            ->setHtmlBody("<b>Your password - $randomPassword</b>")
            ->send();
    }
}