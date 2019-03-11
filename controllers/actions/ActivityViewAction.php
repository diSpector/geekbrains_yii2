<?php

namespace app\controllers\actions;


use app\components\ActivityComponent;
use yii\base\Action;
use yii\web\HttpException;

class ActivityViewAction extends Action
{
    public function run($id){
        /** @var ActivityComponent $comp */
        $comp = \Yii::$app->activity;
        if (!isset($id)) {
            throw new HttpException(400, 'Не указан id активности');
        }
        // получить запись (ActiveRecord) события
        $activity = $comp->getActivity($id);
        if (!$activity) {
            throw new HttpException(400, 'Активности с таким id не существует');
        }

        // проверка, что пользователь не является создателем активности (может его просматривать) и админом
        if (!\Yii::$app->rbac->canViewActivity($activity) && !\Yii::$app->rbac->canViewEditAll()) {
            throw new HttpException(403, 'У вас нет прав на редактирование этой активности');
        }

        return $this->controller->render('view', ['activity'=>$activity]);
    }
}