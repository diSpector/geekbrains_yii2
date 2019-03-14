<?php

namespace app\controllers\actions;


use app\components\ActivityComponent;
use app\components\CalendarComponent;
use yii\base\Action;

class CalendarIndexAction extends Action
{
    public function run(){

        if (\Yii::$app->user->isGuest) {
            \Yii::$app->session->addFlash('success', 'Для просмотра этого раздела нужно авторизоваться');
            return $this->controller->redirect(['/auth/sign-in']);
        }

        $id = \Yii::$app->user->id;
        /** @var ActivityComponent $comp */
//        $activity_comp = \Yii::$app->activity;

        // DI
        $activity_comp = \Yii::$container->get('app\components\activity\ActivityInterface');
        // получаем все активности для залогиненного пользователя
        $activities = $activity_comp->getAllActivitiesForUser($id);
        /** @var CalendarComponent $calendar_comp */
        $calendar_comp = \Yii::$app->calendar;

        // формируем массив событий для календаря
        $events = $calendar_comp->getEventsForCalendarWidget($activities);

        return $this->controller->render('index', ['events' => $events]);
    }
}