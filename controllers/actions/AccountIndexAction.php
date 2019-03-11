<?php

namespace app\controllers\actions;


use yii\base\Action;

class AccountIndexAction extends Action
{
    public function run(){
        if(\Yii::$app->user->isGuest){
            \Yii::$app->session->addFlash('success', 'Для просмотра этого раздела нужно авторизоваться');
            return $this->controller->redirect(['/auth/sign-in']);
        }

        return $this->controller->render('index');
    }
}