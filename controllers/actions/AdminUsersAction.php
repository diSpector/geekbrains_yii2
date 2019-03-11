<?php

namespace app\controllers\actions;

use app\components\AdminComponent;
use yii\base\Action;
use yii\web\HttpException;

class AdminUsersAction extends Action
{
    public function run(){

        if (!\Yii::$app->rbac->canViewEditAll()) {
            throw new HttpException(403, 'У вас нет прав на просмотр этого раздела');
        }

        /** @var AdminComponent $comp */
        $comp = \Yii::$app->admin;
        $dataprovider = $comp->getSearchProvider();

        return $this->controller->render('users', ['provider' => $dataprovider]);
    }
}