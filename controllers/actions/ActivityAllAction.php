<?php

namespace app\controllers\actions;


use app\components\ActivityComponent;
use yii\base\Action;

class ActivityAllAction extends Action
{
    public function run()
    {
//        \Yii::$app->cache->flush();
        if (\Yii::$app->user->isGuest) {
            \Yii::$app->session->addFlash('success', 'Для просмотра этого раздела нужно авторизоваться');
            return $this->controller->redirect(['/auth/sign-in']);
        }
        $id = \Yii::$app->user->id;
        /** @var ActivityComponent $comp */
        $comp = \Yii::$app->activity;
//        $activities = $comp->getAllActivitiesForUser($id);

        $provider = $comp->getSearchProviderWithQuery(['user_id'=>$id]);

        return $this->controller->render('all', ['provider' => $provider]);
    }
}