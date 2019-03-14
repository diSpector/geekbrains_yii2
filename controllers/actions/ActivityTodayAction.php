<?php

namespace app\controllers\actions;


use app\components\ActivityComponent;
use yii\base\Action;

class ActivityTodayAction extends Action
{
    public function run(){
//        \Yii::$app->cache->flush();
        if (\Yii::$app->user->isGuest) {
            \Yii::$app->session->addFlash('success', 'Для просмотра этого раздела нужно авторизоваться');
            return $this->controller->redirect(['/auth/sign-in']);
        }

        $id = \Yii::$app->user->id;
        /** @var ActivityComponent $comp */
//        $comp = \Yii::$app->activity;

//        DI
        $comp = \Yii::$container->get('app\components\activity\ActivityInterface');

        $provider = $comp->getSearchProviderWithQuery(['user_id'=>$id, 'dateAct'=>date('Y-m-d', strtotime("+3 hours"))]);

        return $this->controller->render('today', ['provider' => $provider]);
    }
}