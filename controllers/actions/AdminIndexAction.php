<?php

namespace app\controllers\actions;


use yii\base\Action;
use yii\web\HttpException;

class AdminIndexAction extends Action
{

    public function run(){

        if (!\Yii::$app->rbac->canViewEditAll()) {
            throw new HttpException(403, 'У вас нет прав на просмотр этого раздела');
        }

        return $this->controller->render('index');
    }
}