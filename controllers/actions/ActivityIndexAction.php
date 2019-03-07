<?php

namespace app\controllers\actions;


use app\components\ActivityComponent;
use yii\base\Action;

class ActivityIndexAction extends Action
{

    public function run()
    {
        /** @var ActivityComponent $comp */
        $comp = \Yii::$app->activity;
        $dataprovider = $comp->getSearchProvider(\Yii::$app->request->queryParams);
//        \Yii::$app->request->logMeHere();
        \Yii::$app->logMeHere();

        return $this->controller->render('index', ['provider' => $dataprovider]);
    }
}