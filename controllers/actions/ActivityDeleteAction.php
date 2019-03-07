<?php

namespace app\controllers\actions;


use app\components\ActivityComponent;
use yii\base\Action;
use yii\web\HttpException;

class ActivityDeleteAction extends Action
{
    public function run($id)
    {

        /** @var ActivityComponent $comp */
        $comp = \Yii::$app->activity;
        // получить id события из адресной строки
//        $id = \Yii::$app->request->get('id');
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
//        if (!\Yii::$app->rbac->canViewEditAll()) {
//            return $this->controller->redirect(['/auth/sign-in']);
            throw new HttpException(403, 'У вас нет прав на удаление этой активности');
        }

        $comp->deleteActivity($id);
        \Yii::$app->session->addFlash('success', 'Событие удалено');

        if (\Yii::$app->rbac->canViewEditAll()){
            return $this->controller->redirect(['/admin/activities']);
        }
        return $this->controller->redirect(['/calendar/view']);

    }
}