<?php

namespace app\controllers\actions;

use app\components\ActivityComponent;
use yii\base\Action;
use yii\web\HttpException;

class AdminActivitiesAction extends Action
{
    public function run(){
        if (!\Yii::$app->rbac->canViewEditAll()) {
            throw new HttpException(403, 'У вас нет прав на просмотр этого раздела');
        }

        /** @var ActivityComponent $comp */
//        $comp = \Yii::$app->activity;
        // DI
        $comp = \Yii::$container->get('app\components\activity\ActivityInterface');

        $dataprovider = $comp->getSearchProvider(\Yii::$app->request->queryParams);

        return $this->controller->render('activities', ['provider' => $dataprovider]);
    }
}