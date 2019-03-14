<?php

namespace app\commands;


use app\commands\actions\NotificationAddAction;
use app\commands\actions\NotificationUserAction;
use app\components\ActivityComponent;
use app\components\NotificationComponent;
use app\components\UsersAuthComponent;
use app\jobs\NotificationEmailJob;
use app\models\Activity;
use app\models\Users;
use yii\console\Controller;
use yii\helpers\Console;

class NotificationController extends Controller
{

    public $param;
    public $userid; // параметр экшена для отправки писем конкретному юзеру

    function actions()
    {
        return [
            'user' => [
                'class' => NotificationUserAction::class
            ],
            'add' => [
                'class' => NotificationAddAction::class,
            ],
        ];
    }

    function options($actionID)
    {
        switch ($actionID) { // вернуть поле объекта в зависимости от экшена
            case 'params':
                return ['param'];
            case 'user':
                return ['userid'];
        }
    }

    public function optionAliases()
    {
        return [
            'p' => 'param',
            'u' => 'userid'
        ];
    }

//    // если нужно передать неизвестное кол-во параметров
//    public function actionIndex(...$args)
//    {
//        echo $this->ansiFormat("this is console" . PHP_EOL, Console::BG_GREEN);
//        echo 'param ' . print_r($args) . PHP_EOL;
//    }
//
//    public function actionParams()
//    {
//        echo 'param=' . $this->param . PHP_EOL;
//    }

//    // добавление задания в очередь
//    public function actionAdd(){
//        $activity = \Yii::$container->get(Activity::class);
//        $activity->title = 'test ' . uniqid();
//        $id = \Yii::$app->queue->push(new NotificationEmailJob(['activity' => $activity]));
//        echo 'job id ' . $id. PHP_EOL;
//    }

    public function actionNotification()
    {
        $activities = \Yii::$app->activity->getActivityToday();

        /** @var NotificationComponent $notif_comp */
        // старая версия
//        $notif_comp = \Yii::createObject(['class' => NotificationComponent::class,
//            'mailer' => \Yii::$app->mailer]);
// версия с Dependency Injection
//        \Yii::$container->set(\yii\mail\MailerInterface::class, function(){
//            return \Yii::$app->mailer;
//        });
        $notif_comp = \Yii::$container->get('app\components\notification\NotificationInterface');
//        print_r($notif_comp);
//        exit;

        foreach ($notif_comp->sendTodayNotification($activities) as $result) {
            if ($result['result']) {
                echo $this->ansiFormat('Успешно отправлено письмо' . $result['email'], Console::FG_GREEN);
            } else {
                echo $this->ansiFormat('Ошибка отправки письма' . $result['email'], Console::FG_RED);

            }

        }
    }

//    public function actionUser($marker = null)
//    {
//        // $marker по умолчанию - письмо со всеми событиями с уведомлениями,
//        // $marker = all - письмо со ВСЕМИ событий (с уведомл. и без уведомл.),
//        // $marker = today - письмо со всеми событиями с уведомл. на сегодня
//
//        /** @var NotificationComponent $notif_comp */
//        $notif_comp = \Yii::createObject(['class' => NotificationComponent::class,
//            'mailer' => \Yii::$app->mailer]);
//        /** @var ActivityComponent $activity_comp */
//        $activity_comp = \Yii::$app->activity;
//        /** @var UsersAuthComponent $user_comp */
//        $user_comp = \Yii::$app->auth;
//        /** @var Users $user */
//        $user = $user_comp->getUserById($this->userid);
//        // если пользователь с указанным id существует, получить его email
//        // и выполнить действия в зависимости от параметра $marker
//        if ($user){
//            $email = $user->email;
//            switch($marker){
//                case 'all': // найти все события пользователя с уведомл и без них
//                    $activities = $activity_comp->getAllActivitiesForUser($this->userid);
//                    $subject = 'Все ваши события';
//                    break;
//                case 'today': // найти все события пользователя на сегодня с уведомл
//                    $activities = $activity_comp->getAllActivitiesForUserByToday($this->userid);
//                    $subject = 'Все ваши события на сегодня';
//                    break;
//                default: // по умолчанию получить все события пользователя с уведомл
//                    $activities = $activity_comp->getAllActivitiesWithNotificationsForUser($this->userid);
//                    $subject = 'Все ваши события с уведомлениями';
//                    break;
//            }
//
//            // отправка писем
//            if($notif_comp->composeEmail($activities, $email, $subject)){
//                echo "Письмо отправлено успешно" . PHP_EOL;
//            } else {
//                echo "Ошибка при отправке письма" . PHP_EOL;
//            }
//        } else {
//            echo $this->ansiFormat("ОШИБКА Пользователя с таким id не существует.". PHP_EOL, Console::FG_RED);
//        }
//    }
}