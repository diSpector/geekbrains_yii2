<?php

namespace app\controllers\actions;

use yii\base\Action;

class CalendarViewAction extends Action
{
    public function run()
    {
        $comp = \Yii::$app->calendar;
//        $session = \Yii::$app->session;
        /** @var \app\components\DaoComponent $dao */
        $dao = \Yii::$app->dao;

        // если пришел post-запрос (пользователь выбрал день и нажал на кнопку отправки формы)
        if (\Yii::$app->request->isPost) {
            $calendar = $comp->getModel(\Yii::$app->request->post());
            $day = $calendar['dateAct']; // день, который выбрал пользователь

            if ($comp->createCalendar($calendar)) { // если валидация прошла успешно
                $allActivitiesByDay = $dao->getActivitiesByDay($day); // отобрать события за день
                $calendar['activities'] = $allActivitiesByDay;
                return $this->controller->render('view', ['calendar' => $calendar]);
            }
        } else { // если запроса не было, отображаются все события
            $calendar = $comp->getModel();
            $allActivities = $dao->getAllActivities();
            $calendar['activities'] = $allActivities;
            return $this->controller->render('view', ['calendar' => $calendar]);
        }

    }

    // пока не подключена БД данные загружаются из сессии
    // данные попадают в сессию при добавлении/редактировании нового события
//            $calendar['activities'] = [
//                'title' => $session['title'],
//                'dateAct' => $session['dateAct'],
//                'timeStart' => $session['timeStart'],
//                'timeEnd' => $session['timeEnd'],
//                'description' => $session['description'],
//            ];
}