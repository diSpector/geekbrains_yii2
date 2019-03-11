<?php

namespace app\commands\actions;

use app\components\ActivityComponent;
use app\components\NotificationComponent;
use app\components\UsersAuthComponent;
use app\models\Users;
use yii\base\Action;
use yii\helpers\Console;

class NotificationUserAction extends Action
{
    public function run($marker = null)
    {
        // $marker по умолчанию - письмо со всеми событиями с уведомлениями,
        // $marker = all - письмо со ВСЕМИ событий (с уведомл. и без уведомл.),
        // $marker = today - письмо со всеми событиями с уведомл. на сегодня

        /** @var NotificationComponent $notif_comp */
        $notif_comp = \Yii::createObject(['class' => NotificationComponent::class,
            'mailer' => \Yii::$app->mailer]);
        /** @var ActivityComponent $activity_comp */
        $activity_comp = \Yii::$app->activity;
        /** @var UsersAuthComponent $user_comp */
        $user_comp = \Yii::$app->auth;
        /** @var Users $user */
        $user = $user_comp->getUserById($this->controller->userid);
        // если пользователь с указанным id существует, получить его email
        // и выполнить действия в зависимости от параметра $marker
        if ($user){
            $email = $user->email;
            switch($marker){
                case 'all': // найти все события пользователя с уведомл и без них
                    $activities = $activity_comp->getAllActivitiesForUser($this->controller->userid);
                    $subject = 'Все ваши события';
                    break;
                case 'today': // найти все события пользователя на сегодня с уведомл
                    $activities = $activity_comp->getAllActivitiesForUserByToday($this->controller->userid);
                    $subject = 'Все ваши события на сегодня';
                    break;
                default: // по умолчанию получить все события пользователя с уведомл
                    $activities = $activity_comp->getAllActivitiesWithNotificationsForUser($this->controller->userid);
                    $subject = 'Все ваши события с уведомлениями';
                    break;
            }

            // отправка писем
            if($notif_comp->composeEmail($activities, $email, $subject)){
                echo "Письмо отправлено успешно" . PHP_EOL;
            } else {
                echo "Ошибка при отправке письма" . PHP_EOL;
            }
        } else {
            echo $this->controller->ansiFormat("ОШИБКА: Не указан id или пользователя с таким id не существует.". PHP_EOL, Console::FG_RED);
        }
    }
}