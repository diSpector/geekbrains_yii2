<?php

namespace app\controllers\actions;

use yii\base\Action;

class CalendarViewAction extends Action
{
    public function run()
    {
        $comp = \Yii::$app->calendar;
        $session = \Yii::$app->session;

        if (\Yii::$app->request->isPost) {
            $calendar = $comp->getModel(\Yii::$app->request->post());
            // пока не подключена БД данные загружаются из сессии
            // данные попадают в сессию при добавлении/редактировании нового события
            $calendar['activities'] = [
                'title' => $session['title'],
                'dateAct' => $session['dateAct'],
                'timeStart' => $session['timeStart'],
                'timeEnd' => $session['timeEnd'],
                'description' => $session['description'],
            ];

            if ($comp->createCalendar($calendar)) {
                return $this->controller->render('view', ['calendar' => $calendar]);
            }
        } else {
            $calendar = $comp->getModel();
            $calendar['activities'] = [
                'title' => $session['title'],
                'dateAct' => $session['dateAct'],
                'timeStart' => $session['timeStart'],
                'timeEnd' => $session['timeEnd'],
                'description' => $session['description'],
            ];
            return $this->controller->render('view', ['calendar' => $calendar]);
        }

    }
}