<?php

namespace app\controllers\actions;


use app\components\UsersAuthComponent;
use yii\base\Action;
use yii\web\HttpException;

class AdminUserDeleteAction extends Action
{
    public function run($id)
    {
        /** @var UsersAuthComponent $comp */
        $comp = \Yii::$app->auth;

        if (!isset($id)) {
            throw new HttpException(400, 'Не указан id пользователя');
        }
        // получить запись (ActiveRecord) пользователя
        $user = $comp->getUserById($id);
        if (!$user) {
            throw new HttpException(400, 'Пользователя с таким id не существует');
        }
        // проверка на админа
        if (!\Yii::$app->rbac->canViewEditAll()) {
            throw new HttpException(403, 'У вас нет прав на просмотр этого раздела');
        }

        if($comp->deleteUser($id)){
            \Yii::$app->session->addFlash('success', 'Удален пользователь и все его события');
            return $this->controller->redirect(['/admin/users']);
        }

    }
}