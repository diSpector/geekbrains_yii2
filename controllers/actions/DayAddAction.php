<?php

namespace app\controllers\actions;

use yii\base\Action;

class DayAddAction extends Action
{
    public function run(){
        $comp = \Yii::$app->day;
        $activitiesList = ['Встреча', 'Тренировка', 'Обучение']; // заглушка для массива событий из БД
        if(\Yii::$app->request->isPost){ // пришел POST-запрос
            $day = $comp->getModel(\Yii::$app->request->post());
            $comp->createDay($day);
            $day['is_dayoff'] = ($day['is_dayoff'] === '0') ? 'Нет' : 'Да'; // преобразование флага в "Да"/"Нет" для вьюхи
            $day['activities'] = $activitiesList[$day['activities']]; // преобразование номера option в название активности
            return $this->controller->render('add-confirm', ['day' => $day]);
        } else { // первичное открытие
            $day = $comp->getModel();
            $day['activities'] = $activitiesList;
            return $this->controller->render('add', ['day' => $day]);
        }
    }
}