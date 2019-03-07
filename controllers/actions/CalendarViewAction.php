<?php

namespace app\controllers\actions;

use app\components\CalendarComponent;
use yii\base\Action;

class CalendarViewAction extends Action
{
    // экшен просмотра календаря через Active Record
    public function run()
    {
        // если нет прав на добавление событий, редирект на форму авторизации
        if (!\Yii::$app->rbac->canCreateActivity()) {
            return $this->controller->redirect(['/auth/sign-in']);
        }

        /** @var CalendarComponent $comp */
        $comp = \Yii::$app->calendar;
        $calendar = $comp->getModel(\Yii::$app->request->post());


        // если есть админские права (просмотр и правка всех событий), взять все события
        if (\Yii::$app->rbac->canViewEditAll()) {
            $activities = $comp->getAllActivities();
        } else { // иначе - только события пользователя
            $activities = $comp->getActivities();
        }


        // если пришел post-запрос (пользователь выбрал день и нажал на кнопку отправки формы)
        if (\Yii::$app->request->isPost) {
            $calendar = $comp->getModel(\Yii::$app->request->post());
            $day = $calendar['dateAct']; // день, который выбрал пользователь
            // преобразовать дату из БД в формат даты для БД
            $correctDate = date(\Yii::$app->params['date_format']['date_database'], strtotime($day));
            if ($comp->createCalendar($calendar)) { // если валидация прошла успешно
                if (\Yii::$app->rbac->canViewEditAll()) {
                    $allActivitiesByDay = $comp->getAllActivitiesByDay($correctDate);
                } else {
                    $allActivitiesByDay = $comp->getActivitiesByDay($correctDate); // отобрать события за день
                }

                $calendar['activities'] = $allActivitiesByDay;
                return $this->controller->render('view', ['calendar' => $calendar]);
            }
        } else { // если запроса не было, отображаются все события
            $calendar['activities'] = $activities;
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
// экшен просмотра календаря через dao
//    public function run()
//    {
//        if(!\Yii::$app->rbac->canCreateActivity()){
//            return $this->controller->redirect(['/auth/sign-in']);
//        }
//        $comp = \Yii::$app->calendar;
//        /** @var \app\components\DaoComponent $dao */
//        $dao = \Yii::$app->dao;
//
//        // если пришел post-запрос (пользователь выбрал день и нажал на кнопку отправки формы)
//        if (\Yii::$app->request->isPost) {
//            $calendar = $comp->getModel(\Yii::$app->request->post());
//            $day = $calendar['dateAct']; // день, который выбрал пользователь
//
//            if ($comp->createCalendar($calendar)) { // если валидация прошла успешно
//                $allActivitiesByDay = $dao->getActivitiesByDay($day); // отобрать события за день
//                $calendar['activities'] = $allActivitiesByDay;
//                return $this->controller->render('view', ['calendar' => $calendar]);
//            }
//        } else { // если запроса не было, отображаются все события
//            $calendar = $comp->getModel();
//            $allActivities = $dao->getAllActivities();
//            $calendar['activities'] = $allActivities;
//            return $this->controller->render('view', ['calendar' => $calendar]);
//        }
//
//    }
}